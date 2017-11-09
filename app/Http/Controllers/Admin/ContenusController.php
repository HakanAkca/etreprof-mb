<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Contenu;
use App\Avis;
use App\Historique;
use App\RemoteUrl\Fetcher;
use App\RemoteUrl\Parser;

use Option;

use App\Events\ContenuModifieEvent;
use App\Events\ContenuProposeEvent;
use App\Events\ContenuEvalueEvent;
use App\Events\ContenuPublieEvent;
use App\Events\ContenuDepublieEvent;
use App\Events\ContenuSupprimeEvent;
//use App\Lien;
use Auth;
use Taxonomy;
use Devfactory\Taxonomy\Models\Vocabulary;
use Devfactory\Taxonomy\Models\Term;


class ContenusController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		//$this->middleware('droit:acces_admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$categories = Vocabulary::with('terms')->get();
        return view('admin.contenus.liste', [
        	'onglets' => $this->onglets(),
        	'categories' => $categories

        ]);

    }

    public function onglets()
    {
		$onglets = [
    		'aevaluer' => 'A évaluer',
    		'publies' => 'Publiés',
    		'mespropositions' => 'Mes propositions',
    		'mesavis' => 'Mes avis',
    	];

	    if (Auth::user()->possedeDroit('publier_contenu'))
		{
			$onglets = ['tous' => 'Tous'] + $onglets;
			$onglets = ['apublier' => 'A publier'] + $onglets;

		}

    	if (Auth::user()->possedeDroit('voir_contenus_supprimes'))
    	{
			$onglets['corbeille'] = 'Corbeille';
		}

        return $onglets;
	}

    public function listeJson(Request $request)
    {
		$contenus = Contenu::where('etat', '<>', 'efface');

		$etat = $request->input('etat');
		switch ($etat) {

			case 'apublier' :
				$contenus->where('etat', 'evalue');
	            break;


			case 'atraiter' :

				if (Auth::user()->possedeDroit('publier_contenu'))
				{
					$contenus->where(function ($query) {
						$query->whereIn('etat', ['propose', 'evalue']);
					})
							 ->orWhere(function($query) {
							 	$query->where('propose_par_id', '<>', Auth::user()->id)
	                		  	  	  ->where('etat', 'propose');


							 });
				}
				else
				{
					$contenus->where(function ($query) {
	                	$query->where(function($query) {
	                		$query->where('propose_par_id', Auth::user()->id)
	                		  	  ->where('etat', 'en_construction');
						})
	                      	  ->orWhere('etat', 'propose');
	            	});
				}
	            break;

	        case 'publies' :
	        	$contenus->where('etat', 'publie');
	        	break;

	        case 'corbeille' :
	        	$contenus->where('etat', 'corbeille');
	        	break;

	        case 'mespropositions' :
	        	$contenus->where('propose_par_id', Auth::user()->id);
	        	break;

	        case 'mesavis' :
	        	$contenus->whereHas('avis', function ($query) {
				    $query->where('evaluateur_id', Auth::user()->id);
				});
	        	break;

			case 'tous' :
	            break;

	        case 'aevaluer' :
	        default :
				$contenus->where('etat', 'propose');
	            break;


		}

		if ($query = $request->input('query'))
		{
			$contenus->where(function($q) use ($query){
				$q->where('titre', 'LIKE', '%' . $query . '%')
					  ->orWhere('tags', 'LIKE', '%' . $query . '%');
			});
		}

		if ($etat != 'corbeille')
		{
			$contenus->where('etat', '<>', 'corbeille');
		}

		if ($terms = $request->input('terms'))
		{
			foreach ($terms as $term)
			{
				$contenus->whereHas('related', function($query) use ($term) {
					$query->where('term_id', $term);
				});
			}
		}

		$contenus->where('etat', '<>', 'efface');

		$utilisateur_peut_publier = Auth::user()->possedeDroit('publier_contenu');

		if ($limit = $request->input('limit'))
		{
			$page = $request->input('page');
			//\DB::enableQueryLog();
			$count = clone $contenus;
			$count = $count->count();
			//print $count;
			//dd(\DB::getQueryLog());
			$contenus->limit($limit)
				 	 ->skip($limit * ($page-1));
		}

		if ($orderBy = $request->input('orderBy'))
		{
			$dir = (!$request->input('ascending')) ? 'desc' : 'asc';
			$contenus->orderBy($orderBy, $dir);
		}

		// OBJETS JOINTS
		$contenus = $contenus
			->with('proposePar')
			->with(['related.term' => function($q) {
				//$q->columns(['term_id','vocabulary_id']);
			}])
			->orderBy('etat')
			->orderBy('id', 'desc');


		$contenus = $contenus
			->get()
			->map(function($i) use($utilisateur_peut_publier) {
				$o = new Contenu([
					'titre' => $i->titre,
					'url' => $i->url,
					'etat' => $i->etat,
					'propose_par_name' => ($i->proposePar) ? $i->proposePar->name : '-',
					'publier' => ($i->etat == 'evalue' AND $utilisateur_peut_publier),
					'created_at' => (!empty($i->created_at)) ? $i->created_at : '2016-12-31 00:00:00',
					'updated_at' => $i->updated_at,
					'termes' => $i->related->map(function($r) {
						return $r->term->name;
					})
				]);
				$o->id = $i->id;
				//unset($i->proposePar);
				return $o;
			});

		if ($request->input('limit'))
		{

			return  response()->json([
				'count' => $count,
				'data' => $contenus
			]);
		}

		return response()->json([
			'nb' => count($contenus),
			'contenus' => $contenus
		]);
	}

	public function lien($id = null)
	{
		$contenu = ($id) ? Contenu::find($id) : new Contenu(['titre' => '', 'url' => '']);

		if (!Auth::user()->peutModifierContenu($contenu)) return view('admin.contenus.restreint', ['contenu' => $contenu]);
		//$liens = $contenu->liens;
		$contenu->player = $contenu->player(400,250);


		return view('admin.contenus.lien', [
			'contenu' => $contenu,
			//'liens' => $liens
		]);
	}

	public function postLien(Request $request, $id = null)
	{
		$contenu = ($id) ? Contenu::find($id) : new Contenu();
		if (!Auth::user()->peutModifierContenu($contenu)) return view('admin.contenus.restreint', ['contenu' => $contenu]);
		$data = $request->all();
		$data['duree_secondes'] = (is_numeric($data['duree_secondes'])) ? $data['duree_secondes'] : null;
		$data['lien_description'] = substr($data['lien_description'], 0, 512);
		//dd($data);
		$max = 1000;
		$longueur = 0;
		if (!empty($data['images']))
		{

			if ($data['image'])
			{
				$data['images'] = array_merge([$data['image']], $data['images']);
			}
			foreach ($data['images'] as $i => $image)
			{
				$longueur += strlen($image) + 1;
				//print $longueur . ',';
				if ($longueur > $max)
				{
					unset($data['images'][$i]);
				}
			}
			$data['images'] = join(',', $data['images']);

		}
		if (isset($data['image']))
		{
			unset($data['image']);
		}



		if ($contenu->tags)
		{
			$data['tags'] = $contenu->tags . ',' . $data['tags'];
			$data['tags'] = join(',', array_unique(array_map('trim', explode(',', $data['tags']))));
		}
		if ($data['duree_secondes'])
		{
			$data['duree_minutes'] = max(1, round($data['duree_secondes']/60));
		}
		$contenu->fill($data);
		if (!$contenu->etat)
		{
			$contenu->etat = 'en_construction';
			$contenu->titre = "";
			$contenu->description = '';
			$contenu->propose_par_id = Auth::user()->id;
		}
		$contenu->save();
		if ($contenu->etat == 'publie')
		{
			event(new ContenuModifieEvent($contenu));
		}
		if ($contenu->id)
		{
			$contenu->historique('Lien mis à jour : ' . $contenu->url);
		}
		else
		{
			$contenu->historique('Lien ajouté : ' . $contenu->url);
		}

		$contenu->sauverImage();
		//$user->save();
		return redirect('/admin/contenus/identite/' . $contenu->id);
	}

	public function fetchUrl(Request $request)
	{
		$url = $request->input('url');

		if (substr($url, 0, 4) != 'http')
		{
			$url = 'http://' . $url;
		}


		$deja = Contenu::where('url', $url)->whereNotIn('etat', ['efface','corbeille']);
		if ($id = $request->input('id'))
		{
			$deja->where('id', '<>', $id);
		}
		$deja = $deja->first();
		if ($deja)
		{
			return response()->json([
				'error' => 'existe_deja',
				'contenu' => $deja
			]);
		}

		$data = Fetcher::parseUrl($url);

		if (empty($data))
		{
			throw new \Exception('Réponse vide à la requête Fetcher::parseUrl(' . $url . ')');
			return 'EmptyResponse';
		}
		if (!empty($data['error']))
		{

			return response()->json([
				//'response' => $response->getHeaders(),
				'data' => $data
			]);
		}
		$lien = new Contenu($data);
		$lien->url = $url;
		$lien->titre = (empty($lien->titre)) ? '-' : $lien->titre;
		$images = (is_array($lien->images)) ? $lien->images : [];
		//$images[] = '/img/defaut.png';
		$lien->images = $images;
		$lien->player = $lien->player(400,250);

		return response()->json([
			//'response' => $response->getHeaders(),
			'data' => $lien
		]);

	}

	public function identite($id = null)
	{
		$contenu = Contenu::find($id);
		if (!Auth::user()->peutModifierContenu($contenu)) return view('admin.contenus.restreint', ['contenu' => $contenu]);

		if (!$contenu)
		{
			return redirect('/admin/contenus/lien');
		}

		return view('admin.contenus.identite', [
			'contenu' => $contenu,
			'categories' => $this->categories(Contenu::$catIdentite)
		]);
	}

	public function categories($shortnames)
	{
		$categories = Vocabulary::whereIn('shortname', $shortnames)
								->with(['terms' => function ($q) {
									$q->orderBy('weight');
								}])
								->orderBy(\DB::raw('FIND_IN_SET(shortname, "' . join(',', $shortnames) . '")'))
								->get()
								->values();
		return $categories;
	}

	public function postIdentite(Request $request, $id = null)
	{
		$contenu = Contenu::find($id);
		if (!Auth::user()->peutModifierContenu($contenu)) return view('admin.contenus.restreint', ['contenu' => $contenu]);
		$before = clone $contenu;

		if (!$contenu)
		{
			return redirect('/admin/contenus/lien');
		}
		$contenu->fill($request->except('vocabulary'));
		$contenu->duree_minutes = ($contenu->duree_minutes) ? $contenu->duree_minutes : null;

		if ($contenu->etat == 'en_construction')
		{
			$contenu->etat = 'propose';
			$contenu->save();
			event(new ContenuProposeEvent($contenu));
		}

		foreach ($this->categories(Contenu::$catIdentite) as $categorie)
		{
			$contenu->deleteTermsByVocabularyId($categorie->id);
		}
		$vocab = $request->input('vocabulary');
		$vocab = ($vocab) ? $vocab : [];
		foreach ($vocab as $voc)
		{
			foreach ($voc as $term)
			{
				//dd($term);
				$contenu->addTerm($term);
			}
		}
		$contenu->save();
		if ($contenu->etat == 'publie')
		{
			event(new ContenuModifieEvent($contenu));
		}

		$modifs = [];
		foreach ($before->toArray() as $prop => $val)
		{
			if (Auth::user()->id == 1)
			{
				print $prop;

			}
			if ($before->$prop != $contenu->$prop AND !in_array($prop, ['id','updated_at']))
			{
				$modifs[] = $prop . ' (' . json_encode($before->$prop) . ' -> ' . json_encode($contenu->$prop) . ')';
			}
		}

		$contenu->historique('Fiche d\'identité modifiée : ' . join(', ', $modifs));
		return redirect('/admin/contenus/termine/' . $contenu->id);
	}

	public function publier($id = null)
	{
		$contenu = Contenu::find($id);
		if (!Auth::user()->peutPublierContenu($contenu)) return view('admin.contenus.restreint', ['contenu' => $contenu]);

		if (!$contenu)
		{
			return redirect('/admin/contenus/lien');
		}

		if ($contenu->etat == 'publie')
		{
			return redirect('/admin/contenus/publie/' . $id);
		}

		if ($contenu->getTerms('thematique')->count() > 0)
		{
			$categories = $this->categories(Contenu::$catSiThematique);
			//dd($categories);
		}
		else
		{
			$categories = [];
		}

		return view('admin.contenus.publier', [
			'contenu' => $contenu,
			'categories' => $categories
		]);
	}

	public function postPublier(Request $request, $id = null)
	{
		$contenu = Contenu::find($id);
		$before = clone $contenu;

		if (!$contenu)
		{
			return redirect('/admin/contenus/lien');
		}

		if ($contenu->etat != 'publie')
		{
			$contenu->etat = 'publie';
			$contenu->save();
			event(new ContenuPublieEvent($contenu));
		}

		//$contenu->removeAllTerms();
		foreach ($this->categories(Contenu::$catSiThematique) as $categorie)
		{
			$contenu->deleteTermsByVocabularyId($categorie->id);
		}
		$vocab = $request->input('vocabulary');
		$vocab = ($vocab) ? $vocab : [];
		foreach ($vocab as $voc)
		{
			foreach ($voc as $term)
			{
				//dd($term);
				$contenu->addTerm($term);
			}
		}
		$contenu->save();
		if ($contenu->etat == 'publie')
		{
			event(new ContenuModifieEvent($contenu));
		}

		$modifs = [];
		foreach ($before->toArray() as $prop => $val)
		{
			if (Auth::user()->id == 1)
			{
				print $prop;

			}
			if ($before->$prop != $contenu->$prop AND !in_array($prop, ['id','updated_at']))
			{
				$modifs[] = $prop . ' (' . json_encode($before->$prop) . ' -> ' . json_encode($contenu->$prop) . ')';
			}
		}

		$contenu->historique('Contenu publié : ' . join(', ', $modifs));
        Auth::user()->majNbScore();
		return redirect('/admin/contenus/publie/' . $contenu->id);
	}

	public function publie($id = null)
	{
		$contenu = Contenu::find($id);

		if (!$contenu)
		{
			return redirect('/admin/contenus/lien');
		}

		if ($contenu->etat != 'publie')
		{
			return redirect('/admin/contenus/publier/' . $id);
		}

		return view('admin.contenus.publie', [
			'contenu' => $contenu
		]);
	}

	public function postDepublier(Request $request, $id = null)
	{
		$contenu = Contenu::find($id);
		$before = clone $contenu;

		if (!$contenu)
		{
			return redirect('/admin/contenus/lien');
		}

		if ($contenu->etat == 'publie')
		{
			$contenu->etat = 'evalue';
			$contenu->save();
			event(new ContenuDepublieEvent($contenu));
		}

		$contenu->save();

		$contenu->historique('Contenu dépublié : ' . $contenu->id . ' - ' . $contenu->titre);
        Auth::user()->majNbScore();
		return redirect('/admin/contenus/publie/' . $contenu->id);
	}


	public function termine($id = null)
	{
		$contenu = Contenu::find($id);

		return view('admin.contenus.termine', [
			'contenu' => $contenu
			//'liens' => $liens
		]);
	}


	public function avis($id = null,$avis_id = null)
	{
		$contenu = Contenu::find($id);

		if (!$contenu)
		{
			return redirect('/admin/contenus');
		}

		$avis = $contenu->avis()->with('evaluateur')->get();

		$categories = Vocabulary::with('terms')->get();

		if ($avis_id AND Auth::user()->possedeDroit('modifier_tous_avis'))
		{
			$mon_avis = $avis->filter(function($i) use ($avis_id) { return $i->id == $avis_id ; })->first();
			$liste_avis = $avis;
		}
		else
		{
			$mon_avis = $avis->filter(function($i) { return $i->evaluateur_id == Auth::user()->id ; })->first();
			$liste_avis = $avis->filter(function($i) { return $i->evaluateur_id != Auth::user()->id ; });

		}

		//print_r($mon_avis);

		return view('admin.contenus.avis', [
			'contenu' => $contenu,
			'mon_avis' => $mon_avis,
			'categories' => $categories,
			'liste_avis' => $liste_avis
			//'liens' => $liens
		]);
	}

	public function postAvis(Request $request, $id = null, $avis_id = null)
	{
		$contenu = Contenu::find($id);

		if ($avis_id  AND Auth::user()->possedeDroit('modifier_tous_avis'))
		{
			$avis = Avis::find($avis_id);
		}
		else
		{
			$avis = $contenu->avis()->firstOrNew(['evaluateur_id' => Auth::user()->id]);
		}
		if (!$contenu)
		{
			return redirect('/admin/contenus');
		}
		$rules = [
			'note_fond' => 'required',
			'note_forme' => 'required',
			'note_accessibilite' => 'required',
			'waouh' => 'required',
		];
		$this->validate($request, $rules);
		//$avis->evaluateur_id = Auth::user()->id;
		$avis->fill($request->all());
		$avis->save();
		if ($contenu->etat == 'propose')
		{
			$contenu->etat = 'evalue';
			$contenu->save();
			event(new ContenuEvalueEvent($contenu, $avis));
		}

		$contenu->historique('Nouvel avis sur le contenu');
		$contenu->recalculerVotes();

		if ($contenu->etat == 'publie')
		{
			event(new ContenuModifieEvent($contenu));
		}

		return redirect('/admin/contenus/termine/' . $contenu->id);
	}


	public function postSupprimer(Request $request)
	{
		$contenu = Contenu::find($request->input('id'));
		if (Auth::user()->peutSupprimerContenu($contenu))
		{
			event(new ContenuSupprimeEvent($contenu));
			$contenu->etat = ($contenu->etat == 'corbeille') ? 'efface' : 'corbeille';
			$contenu->save();
		}
        Auth::user()->majNbScore();
		return redirect('/admin/contenus');
	}

	public function listeParTermeJson($terme_id)
	{
		$contenus = Contenu::getAllByTermId($terme_id)->get();
		return response()->json($contenus);
	}

	function historique($id)
	{
		$contenu = Contenu::find($id);
		$historique = $contenu->historiques()->with('auteur')->get()->map(function($i) {
			$i->auteurNom = $i->auteur->name;
			$i->auteur = null;
			return $i;
		});
		return view('admin.contenus.historique', [
			'historique' => $historique,
			'contenu' => $contenu
		]);
	}

	function historiqueGlobal($date = null)
	{
		$date = (!$date) ? date('Y-m-d') : $date;
		$historique = Historique::whereRaw('To_DAYS(date) = TO_DAYS("' . $date . '")')->with('auteur')->with('contenu')->get()->map(function($i) {
			$i->auteurNom = $i->auteur->name;
			$i->auteur = null;
			return $i;
		});
		return view('admin.contenus.historique-global', [
			'historique' => $historique,
			'date' => $date
		]);
	}
}
