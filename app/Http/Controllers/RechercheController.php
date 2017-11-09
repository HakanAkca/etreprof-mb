<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Contenu;
use App\Search;
use App\SearchRewriter;
use App\Article;

use Auth;

use Taxonomy;
use Devfactory\Taxonomy\Models\Vocabulary;
use Devfactory\Taxonomy\Models\Term;

use App\Events\DemandeRechercheEvent;

class RechercheController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function requete(Request $request)
    {
    	$q = $request->input('recherche');

    	//dump($request->all());
		$search = new Search;
		$syntax = new SearchRewriter($q);
		$filters = $syntax->filters;
		$categories = Vocabulary::all()->keyBy('shortname');

		foreach (['niveau', 'thematique','discipline', 'format', 'usage', 'theorique_pratique', 'groupe_individuel'] as $key)
		{
			//print $key;
			if ($val = $request->input($key))
			{
				$filters[$key] = Term::whereIn('id', $val)->get()->pluck('name')->toArray();
			}
		}

		if ($duree = $request->input('duree'))
		{
			$duree = explode('-', $duree);
			$filters['duree_minutes'] = $duree;
		}
		//dump($filters);
		//$filters['etat'] = ['publie'];
		//dump($syntax);
		
		if (empty($q) && empty($filters))
		{
			$contenus = [];
		}
		else{

			$results = $search->queryContenu($syntax->query, $filters);
			$contenus = collect($results['hits']['hits'])->map(function($i) {
				$contenu = new Contenu($i['_source']);
				$contenu->id = $i['_source']['id'];
				$contenu->score = $i['_score'];
				return $contenu;
			});

		}
		
		return view('recherche.resultats', array_merge(
			['contenus' => $contenus], 
			$request->all())
		);
			
		

	}

	public function postRequete(Request $request)
	{
		dump($request->all());
		//return redirect(action('RechercheController@requete'))
	}

	public function postDemande(Request $request)
	{
		event(new DemandeRechercheEvent($request->input('recherche'), $request->input('url'), Auth::user()));
		return redirect('/page/demande-envoyee');
	}
}
