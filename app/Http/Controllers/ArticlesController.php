<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;


class ArticlesController extends Controller
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

    public function dossiers()
    {
        $dossiers = Article::where('status', 'published')
                      ->where('type', 'theme')
                      //->where('featured', 1)
                      ->orderBy('date', 'desc')
                      ->get();

        return view('articles.dossiers', [
                'dossiers' => $dossiers]
        );

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function voir($url)
    {
    	$article = Article::where('url', $url)->first();
    	if (!$article)
    	{
			abort(404);
		}
        return view('articles.' . $article->type, [
			'article' => $article
        ]);
    }
}
