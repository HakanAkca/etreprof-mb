<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;

use Auth;
use App\Article;

class IndexDossierComposer {

	public function __construct()
	{
		
	}

	function compose(View $view)
	{
		
		$dossier = Article::where('status', 'published')
						  ->where('type', 'theme')
						  ->where('featured', 1)
						  ->orderBy('date', 'desc')
						  ->first();
		if ($dossier)
		{
	        $view->with('dossier_une', $dossier);
		}
		
	}

}