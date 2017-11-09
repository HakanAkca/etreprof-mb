<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Contenu;
use App\Article;

use Date;

use Taxonomy;
use Devfactory\Taxonomy\Models\Vocabulary;
use Devfactory\Taxonomy\Models\Term;

class IndexController extends Controller
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

    	$featured = $this->featured();    	

        return view('index.index', [
			'featured' => $featured
        ]);
    }


    public function featured()
    {

    	if (! $contenus = cache('home-featured'))
    	{
    		//print 'no cache';
    		//$date = date('y-m-d 00:00:00', strtotime('-1 month'));

            $jours_ecoules = '(TO_DAYS(CURDATE()) - TO_DAYS(created_at))';

            $upvotes = 'CAST(score_upvote AS SIGNED)';
            $downvotes = 'CAST(score_downvote AS SIGNED)';
            $score_avis = 'score_avis';
            //\DB::enableQueryLog();
    		$contenus = Contenu::where('etat', 'publie')
    				->orderBy(\DB::raw("($upvotes - $downvotes + $score_avis) - $jours_ecoules"), 'desc')
					->take(3)
                    ->get();
            //dump(\DB::getQueryLog());
    		cache(['home-featured' => $contenus], 2);
		}
    	return $contenus;
	}

    public function categorie($id)
    {
		$terme = Term::find($id);
		$contenus = Contenu::getAllByTermId($terme->id)->where('etat', 'publie')->get();
		return view ('index.categorie', [
			'contenus' => $contenus,
			'terme' => $terme
		]);

	}

	public function restreint()
	{
		return view('errors.restreint');
	}
}
