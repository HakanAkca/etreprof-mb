<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Evenement;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;


class EvenementsController extends Controller
{
    public function index()
    {
        return view('admin.evenements.index');
    }

    /*
     * Systèmes de recherche selon les mots clé
     * Ordre d'affichage
     * Récupere les informations dans la base de données
     * Renvoie un JSON la réponse
     *
     */

    public function listeJson(Request $request)
    {
        $evenements = Evenement::query();

        if ($query = $request->input('query')) {
            $evenements->where(function ($q) use ($query) {
                $q->where('titre', 'like', '%' . $query . '%')
                    ->orWhere('description', 'like', '%' . $query . '%')
                    ->orWhereHas('auteur', function ($uq) use ($query) {
                        $uq->where('name', 'like', '%' . $query . '%');
                    });
            });
        }


        if ($limit = $request->input('limit')) {
            $page = $request->input('page');
            //\DB::enableQueryLog();
            $count = clone $evenements;
            $count = $count->count();
            //print $count;
            //dd(\DB::getQueryLog());
            $evenements->limit($limit)
                ->skip($limit * ($page - 1));
        }

        if ($orderBy = $request->input('orderBy')) {
            $dir = (!$request->input('ascending')) ? 'desc' : 'asc';
            $evenements->orderBy($orderBy, $dir);
        }

        // OBJETS JOINTS
        $evenements = $evenements
            ->with('auteur');



        $evenements = $evenements
            ->get()
            ->map(function ($e) {
                $o = new Evenement([
                    'date_debut' => $e->date_debut,
                    'titre' => $e->titre,
                    'description' => $e->description,
                    'auteur_id' => $e->auteur->name,
                    'url' => $e->url(),
                    'statut' => $e->statut,
                    'nb_interesses' => $e->nb_interesses
                ]);
                $o->id = $e->id;
                return $o;
            });

        if ($request->input('limit')) {

            return response()->json([
                'count' => $count,
                'data' => $evenements
            ]);
        }

        return response()->json([
            'nb' => count($evenements),
            'contenus' => $evenements
        ]);
    }

    public function modifier($id = null)
    {
        $evenement = ($id) ? Evenement::find($id) : new Evenement;

        return view('admin.evenements.modifier', ['evenement' => $evenement]);
    }

    public function postModifier(Request $request, $id = null)
    {
        $evenement = ($id) ? Evenement::find($id) : new Evenement;

        $evenement->fill($request->all());
        if (!$id)
        {
            $evenement->auteur_id = Auth::user()->id;
        }
        $evenement->save();
        return redirect()->action('Admin\EvenementsController@index');

    }
}