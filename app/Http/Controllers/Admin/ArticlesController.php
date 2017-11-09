<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Article;
use App\Droit;

use Auth;
use Date;
use Cache;

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


    public function index($type)
    {

        return view('admin.articles.liste',
        [
        	'type' => $type,
        	'titre' => Article::$_typeNames[$type]
        ]);
    }


    public function listeJson(Request $request, $type)
    {
		$articles = Article::where('status', '<>', 'trash')
						   ->where('type', $type);

		if ($limit = $request->input('limit'))
		{
			$page = $request->input('page');
			//\DB::enableQueryLog();
			$count = clone $articles;
			$count = $count->count();
			//print $count;
			//dd(\DB::getQueryLog());
			$articles->limit($limit)
				 	 ->skip($limit * ($page-1));
		}

		if ($orderBy = $request->input('orderBy'))
		{
			$dir = (!$request->input('ascending')) ? 'desc' : 'asc';
			$articles->orderBy($orderBy, $dir);
		}

		$articles = $articles->get()
			->map(function($a) {
				$a->link = $a->getUrl();
				$a->text = html_entity_decode(strip_tags($a->content));
				return $a;
			});

		if ($request->input('limit'))
		{

			return  response()->json([
				'count' => $count,
				'data' => $articles
			]);
		}

		return response()->json([
			'nb' => count($articles),
			'contenus' => $articles
		]);
	}


    public function modifier($type, $id = null)
    {
        $article = ($id) ? Article::find($id) : new Article(['type' => $type]);

        //dd($article);
        return view('admin.articles.modifier',array(
            'article' => $article
        ));
    }


    public function postModifier(Request $request, $type, $id = null)
    {
        $article = ($id) ? Article::find($id) : new Article(['type' => $type]);
		$article->excerpt = '';
        $article->thumbnail = '';

        $rules = [
			'type' => 'required',
			'title' => 'required'
        ];

        $this->validate($request, $rules);

        $article->fill($request->all());
        $article->url = ($request->input('url')) ? $request->input('url') : str_slug($article->title);
        $article->author_id = ($article->author_id) ? $article->author_id : Auth::user()->id ;
        $article->date = ($article->date) ? $article->date : Date::now() ;


        $article->save();

        if ($type == 'block') 
        {
            Cache::forget('blocs');
        }

        return redirect(action('Admin\ArticlesController@index', $article->type));
    }


}
