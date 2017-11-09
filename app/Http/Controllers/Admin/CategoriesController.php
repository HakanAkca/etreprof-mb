<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Contenu;
use App\RemoteUrl\Fetcher;
use App\RemoteUrl\Parser;

use App\Lien;

use Taxonomy;
use Devfactory\Taxonomy\Models\Vocabulary;
use Devfactory\Taxonomy\Models\Term;

class CategoriesController extends Controller
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
    public function index()
    {
    	$vocabulaires = Vocabulary::all();

        return view('admin.categories.index', ['vocabulaires' => $vocabulaires]);
    }

    public function modifier($id = null)
    {
    	$vocabulaire = ($id) ? Vocabulary::find($id) : new Vocabulary;

        return view('admin.categories.modifier', ['vocabulaire' => $vocabulaire]);
    }

    public function postModifier(Request $request, $id = null)
    {
    	$vocabulaire = ($id) ? Vocabulary::find($id) : new Vocabulary;

		$vocabulaire->name = $request->input('name');
		$vocabulaire->save();

        return redirect()->action('Admin\CategoriesController@index');
    }

    public function termes($id = null)
    {
    	$vocabulaire = Vocabulary::find($id);
    	$termes = $vocabulaire
    		->terms
    		->sortBy(function($i) {
				$key = ($i->parent) ? $i->parent . '-' . ($i->weight+100) . '-' . $i->id : $i->id . '-0';
				//$key .= '-' . $i->weight;
				return $key;
			})
			;

        return view('admin.categories.termes', [
        	'vocabulaire' => $vocabulaire,
        	'termes' => $termes]);
    }

    public function terme($vocabulary_id, $term_id = null)
    {
    	$vocabulaire = Vocabulary::find($vocabulary_id);
    	$terme = ($term_id) ? Term::find($term_id) : new Term(['vocabulary_id' => $vocabulary_id]);

		$termes = Term::where('vocabulary_id', $vocabulary_id)
			->where('id','<>', $term_id)
			->get()
			->pluck('name','id')
			->toArray();

        return view('admin.categories.terme', [
        	'vocabulaire' => $vocabulaire,
        	'terme' => $terme,
        	'termes' => $termes

        ]);
    }


    public function postTerme(Request $request, $vocabulary_id, $term_id = null)
    {
    	$vocabulaire = Vocabulary::find($vocabulary_id);
    	$terme = ($term_id) ? Term::find($term_id) : new Term(['vocabulary_id' => $vocabulary_id]);

		$terme->name = $request->input('name');
		$terme->parent = ($request->input('parent')) ? $request->input('parent') : 0;
		$terme->weight = ($request->input('weight')) ? $request->input('weight') : $vocabulaire->terms()->count() + 1;
		$terme->save();

        return redirect()->action('Admin\CategoriesController@termes', ['vocabulary_id' => $vocabulary_id]);
    }

    public function postSupprimerTerme(Request $request)
    {
		$terme = Term::find($request->input('terme_id'));
		$contenus = Contenu::getAllByTermId($terme->id)->get();
		foreach ($contenus as $contenu)
		{

			//print $contenu->titre;
			$contenu->removeTerm($terme->id);
		}
		//die();
		$terme->delete();
		return response()->json('ok');
	}
}
