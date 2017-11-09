<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;

use Devfactory\Taxonomy\Models\Vocabulary;
use Devfactory\Taxonomy\Models\Term;

class CategoriesComposer {

	public function __construct()
	{

	}

	function compose(View $view)
	{
		$view->with('categories', $this->categories());
	}


    public function categories()
    {

    	if (!($categories = cache('categories')))
    	{
    		//dd('not cached');
            $categories = Term::with('vocabulary')
                            ->where('parent', 0)
                            ->with('childrens')
                            ->get()
                            ->groupBy(function($i) {
                                return $i->vocabulary->shortname;
                            });
                            
            //dd($categories);

			/*$thematiques = Vocabulary::find(12)
    			->terms;

			$format = Vocabulary::where('shortname', 'format')
							->first()
							->terms;

    		$niveaux = Vocabulary::find(13)
    						->terms()
    						->where('parent', 0)
    						->with('childrens')
    						->get();
*/
    		$niveaux_aplatis = [];
    		foreach ($categories['niveau'] as $niveau)
    		{
    			$niveaux_aplatis[$niveau->id] = $niveau;
    			foreach ($niveau->childrens as $child)
    			{
    				$niveaux_aplatis[$child->id] = $child;
    			}
    		}

    		/*$disciplines = Vocabulary::find(11)
    			->terms;
*/
    		/*$categories = [
    	     'thematiques' => $thematiques,
    			'format' => $format,
    			'niveaux' => $niveaux,
    			'niveaux_aplatis' => collect($niveaux_aplatis),
    			'disciplines' => $disciplines,
    		];*/
            $categories['niveaux_aplatis'] = collect($niveaux_aplatis);
    		cache(['categories' => $categories], 1);
		}
		//dd($categories);
		return $categories;

	}

}