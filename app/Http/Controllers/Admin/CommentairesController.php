<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Commentaire;

use App\Contenu;

use Option;

use Auth;
use function React\Promise\map;


class CommentairesController extends Controller
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
        return view('admin.commentaires.index');
    }

    public function listeJson(Request $request)
    {
        $commentaires = Commentaire::whereNull('deleted_at');

        if ($query = $request->input('query')) {
            $commentaires->where(function ($q) use ($query) {
                $q->where('commentaire', 'LIKE', '%' . $query . '%')
                    ->orWhere('tags', 'LIKE', '%' . $query . '%');
            });
        }


        if ($limit = $request->input('limit')) {
            $page = $request->input('page');
            //\DB::enableQueryLog();
            $count = clone $commentaires;
            $count = $count->count();
            //print $count;
            //dd(\DB::getQueryLog());
            $commentaires->limit($limit)
                ->skip($limit * ($page - 1));
        }

        if ($orderBy = $request->input('orderBy')) {
            $dir = (!$request->input('ascending')) ? 'desc' : 'asc';
            $commentaires->orderBy($orderBy, $dir);
        }

        // OBJETS JOINTS
        $commentaires = $commentaires
            ->with('contenu')
            ->with('auteur');


        $commentaires = $commentaires
            ->get()
            ->map(function ($i) {
                $o = new commentaire([
                    'commentaire' => $i->commentaire,
                    'url' => $i->url(),
                    'propose_par_name' => $i->auteur->name,
                    'created_at' => (!empty($i->created_at)) ? $i->created_at : '2016-12-31 00:00:00',
                    'contenu_titre' => $i->contenu->titre,
                ]);
                $o->id = $i->id;
                return $o;
            });

        /*->map(function($i) use($utilisateur_peut_publier) {
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
        });*/

        if ($request->input('limit')) {

            return response()->json([
                'count' => $count,
                'data' => $commentaires
            ]);
        }

        return response()->json([
            'nb' => count($commentaires),
            'contenus' => $commentaires
        ]);
    }

    public function postSupprimer(Request $request)
    {
        $id = $request->input('id');
        Commentaire::where('id', $id)->delete();

        if ($contenu_id = $request->input('contenu_id'))
        {
            $contenu = Contenu::find($contenu_id);
            //dd($contenu);
            return redirect($contenu->url());
        }
        else
        {
            return response()->json($id);
        }
    }


    public function modifier($id = null)
    {
        $commentaire = ($id) ? Commentaire::find($id) : new Commentaire;

        return view('admin.commentaires.modifier', ['commentaire' => $commentaire, '']);
    }

    public function postModifier(Request $request, $id = null)
    {
        $commentaire = ($id) ? Commentaire::find($id) : new Commentaire;

        $commentaire->commentaire = $request->input('commentaire');
        $commentaire->save();
        return redirect()->action('Admin\CommentairesController@index');

    }
}
