<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;

use Auth;
use App\Contenu;
use App\Profil;
use App\Option;

class RecommandationsComposer {

	public function __construct()
	{
		
	}

	function compose(View $view)
	{
		$tag = 'reco:' . ((Auth::user()) ? Auth::user()->id : 0);

		$nb = 3;
		if (! ($contenus = cache($tag)))
		{
			if (env('APP_ENV') == 'development') print $tag . ' -> NOCACHE';

			
			$dominante = Profil::dominanteUser(Auth::user());
			$contenus = [];
			if ($dominante)
			{
				$contenus = $this->contenusParTerme($dominante->reponse,2);
			}

			if (count($contenus) < $nb)
			{
				$contenus = array_merge($contenus, $this->contenusParTerme(200, $nb - count($contenus)));
			}
			cache([$tag => $contenus], Option::get('cache_recommandations', null, 4, 'Durée de cache des recommandations', 'number'));
		}
	    $view->with('contenus', $contenus);
	}

	function contenusParTerme($term_id, $nb)
	{
		$contenus = Contenu::where('etat', 'publie')
			->where(function($query) use ($term_id) {
				$query->whereHas('related', function($q) use ($term_id) {
					$terms = explode(',', $term_id);
					//dump($terms);
					$q->whereIn('term_id', $terms);
					
				});
			})
			->take($nb)
			->inRandomOrder()
			->get()
			->all();

		return $contenus;
	}

}