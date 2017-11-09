<?php

namespace App\Http\Controllers;

use App\Commentaire;
use App\Events\CommentairePublieEvent;
use App\Favori;
use Illuminate\Http\Request;

use App\Contenu;
use App\Vote;

use Auth;
use App\Search;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Taxonomy;
use Date;

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
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function voir($id)
    {

        $contenu = Contenu::with('proposePar')
            ->with('avis')
            ->where('id', $id);

        if (Auth::user() AND Auth::user()->possedeDroit('proposer_contenu')) {
            $contenu = $contenu->whereNotIn('etat', ['corbeille', 'efface']);
        } else {
            $contenu = $contenu->where('etat', 'publie');
        }
        $contenu = $contenu->first();

        if (!$contenu) {
            throw new \Illuminate\Database\Eloquent\ModelNotFoundException;
            //return redirect('/', 302);
        }

        if (Auth::check()) {
            Auth::user()->contenusParcourus()->attach($id);
        }

        $similaires = $this->similaires($contenu, 3);

        $catIds = Vocabulary::select('id')
            ->whereIn('shortname', Contenu::$catIdentite)
            ->get()
            ->pluck('id')
            ->toArray();
        //dd($catIds);
        $contenu->termes = $contenu->related()->whereIn('vocabulary_id', $catIds)->get();

        $commentaires = $contenu->commentaires;

        $favori = (Auth::user()->contenusFavoris()->where('contenu_id', $contenu->id)->first()) ? 1 : 0;

        //dd($favori);

        return view('contenus.voir', [
            'contenu' => $contenu,
            'similaires' => $similaires,
            'commentaires' => $commentaires,
            'favori' => $favori
        ]);
    }

    public function similaires($contenu, $nb)
    {
        if (!$contenus = cache('similaires:' . $contenu->id)) {
            $date = date('y-m-d 00:00:00', strtotime('-1 month'));
            $search = new Search;
            $termes = $contenu->related->map(function ($r) {
                return $r->term->name;
            })->implode(' ');
            $q = join(' ', [
                $contenu->titre,
                $contenu->tags,
                $termes]);
            //dump($q);
            try {
                $results = $search->queryContenu($q, null, null, 4);

                $filtrer_id = $contenu->id;

                $contenus = collect($results['hits']['hits'])
                    ->map(function ($i) {
                        $contenu = new Contenu($i['_source']);
                        $contenu->id = $i['_source']['id'];
                        return $contenu;
                    })->filter(function ($i) use ($filtrer_id) {
                        return $i->id !== $filtrer_id;
                    });
                //dd($contenus);
                cache(['similaires:' . $contenu->id => $contenus], Date::now()->addSeconds(10));
            } catch (\Exception $e) {
                $contenus = [];
            }
        }
        return $contenus;
    }

    public function voter(Request $request)
    {
        $id = $request->input('id');
        $vote = $request->input('vote');

        Vote::voter($id, $vote, Auth::user(), $request->server('HTTP_USER_AGENT'), $request->server('REMOTE_ADDR'));

        $contenu = Contenu::find($id);
        $contenu->recalculerVotes();
        Auth::user()->majNbScore();
        return response()->json([
            'avis' => $contenu->score_avis,
            'up' => $contenu->score_upvote,
            'down' => $contenu->score_downvote
        ]);
    }

    public function noter(Request $request)
    {
        $id = $request->input('id');
        $note = $request->input('note');

        Vote::noter($id, $note, Auth::user(), $request->server('HTTP_USER_AGENT'), $request->server('REMOTE_ADDR'));

        $contenu = Contenu::find($id);
        $contenu->recalculerVotes();
        Auth::user()->majNbScore();
        return response()->json([
            'note' => $contenu->note,
            'nb_votes' => $contenu->nb_votes
        ]);
    }

    public function postCommentaire(Request $request)
    {
        $rules = [
            'message' => 'required'
        ];

        $this->validate($request, $rules);
        $commentaire = Commentaire::create([
            'commentaire' => $request->input('message'),
            'contenu_id' => $request->input('contenu_id'),
            'auteur_id' => (Auth::user()->id),
        ]);

        $contenu = Contenu::find($request->input('contenu_id'));
        //dd($contenu);
        event(new CommentairePublieEvent($commentaire, $contenu, Auth::user()));
        Auth::user()->majNbScore();
        return redirect($contenu->url() . '#c' . $commentaire->id);

    }

    public function postFavori(Request $request)
    {
        $favori = $request->input('id');

        if (Auth::user()->contenusFavoris()->where('contenu_id', $favori)->first()) return "Deja";
        Auth::user()->contenusFavoris()->attach($favori);

        Auth::user()->majNbScore();
    }

    public function postSupprimerFavori(Request $request)
    {
        $favori = $request->input('id');

        if (Auth::user()->contenusFavoris()->where('contenu_id', $favori)->first()) {

            Auth::user()->contenusFavoris()->detach($favori);
            Auth::user()->majNbScore();
        }
    }

    public function favoris()
    {
        $favoris = Auth::user()->contenusFavoris()->orderBy('created_at', 'desk')->get();

        return view('contenus.favoris', ['favoris' => $favoris]);
    }
}
