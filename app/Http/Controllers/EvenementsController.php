<?php

namespace App\Http\Controllers;

use App\Evenement;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;


class EvenementsController extends Controller
{
    public function index()
    {
        //date fin > a DB::raw('NOW()');
        $evenements = Evenement::where('statut', 'brouillon')->get();

        return view('evenements.index', ['evenements' => $evenements]);
    }

    public function voir($id)
    {
        $evenement = Evenement::find($id);

        $interesse = Auth::user()->interesseParEvenements()->where('evenement_id', $id)->first();
        return view('evenements.voir', [
            'evenement' => $evenement,
            'interesse' => $interesse ? 1 : 0
        ]);
    }

    public function postInteresse(Request $request, $id)
    {


        if (Auth::user()->interesseParEvenements()->where('evenement_id', $id)->first()) return 'ok';

        Auth::user()->interesseParEvenements()->attach($id);
        $nb = Evenement::find($id)->majNbInteresses();
        Auth::user()->majNbScore();
        return response()->json(['nb' => $nb]);
    }

    public function postPlusInteresse(Request $request, $id)
    {
        if (Auth::user()->interesseParEvenements()->where('evenement_id', $id)->first()) {

            Auth::user()->interesseParEvenements()->detach($id);
            $nb = Evenement::find($id)->majNbInteresses();
            Auth::user()->majNbScore();
            return response()->json(['nb' => $nb]);
        }
    }
}
