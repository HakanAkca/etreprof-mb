<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Contenu;
use App\Vote;

use Auth;
use App\User;
use Taxonomy;
use Date;

use Devfactory\Taxonomy\Models\Vocabulary;
use Devfactory\Taxonomy\Models\Term;

class MembresController extends Controller
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

    public function index()
    {
        $membres = User::where('public', 1)
            ->orderBy('nb_contributions', 'desc')
            ->orderBy('updated_at', 'desc')
            ->get()
            ->map(function ($m) {
                $m->url = $m->urlPublique();
                return $m;
            });

        $contacts = Auth::user()->contacts()->get()->pluck('id')->all();

        return view('membres.index', ['membres' => $membres, 'contacts' => $contacts]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function voir($id)
    {
        $membre = User::where('id', $id)->where('public', 1)->first();

        if (!$membre) {
            return 'Aucun profil de ce type';
        }


        $contact = (Auth::user()->contacts()->where('contact_id', $id)->first()) ? 1 : 0;
        return view('membres.voir', [
            'membre' => $membre,
            'contact' => $contact
        ]);
    }

    public function ajouterContact(Request $request)
    {
        $contact_id = $request->input('id');

        //Auth::user()->contacts()->sync([$contact_id]);

        if (Auth::user()->contacts()->where('contact_id', $contact_id)->first()) return "Deja";
        Auth::user()->contacts()->attach($contact_id);
    }

    public function supprimerContact(Request $request)
    {
        $contact_id = $request->input('id');

        //Auth::user()->contacts()->sync([$contact_id]);

        if (Auth::user()->contacts()->where('contact_id', $contact_id)->first()) {
            Auth::user()->contacts()->detach($contact_id);
        }
    }

    public function listeContactsJson()
    {
        $contacts = Auth::user()
            ->contacts()
            ->get()
            ->map(function ($u) {
                $contact = new User([
                    'name' => $u->name,
                    'id' => $u->id,
                    'image' => $u->image
                ]);
                return $contact;
            });
        return response()->json(['contacts' => $contacts]);
    }
}
