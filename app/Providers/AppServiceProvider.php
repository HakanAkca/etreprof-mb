<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;

use Illuminate\Support\ServiceProvider;
use App\Contenu;
use App\Article;
use App\Menu;
use App\User;
use Auth;
use Option;

use Taxonomy;
use Devfactory\Taxonomy\Models\Vocabulary;
use Devfactory\Taxonomy\Models\Term;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    	view()->share('blocs', $this->getBlocs());

		view()->composer('contenus.recommandations', 'App\Http\ViewComposers\RecommandationsComposer'); 

		view()->composer(['index.categories','recherche.criteres'], 'App\Http\ViewComposers\CategoriesComposer');

		view()->composer('index.section-dossier', 'App\Http\ViewComposers\IndexDossierComposer');

		view()->composer('analytics', 'App\Http\ViewComposers\AnalyticsComposer');

		view()->composer('discussions.index', 'App\Http\ViewComposers\DiscussionsComposer');

    	$this->layoutComposer();

    	$this->adminLayoutComposer();

    	//$this->indexCategoriesComposer();

    	$this->blocsComposer();

    	//$this->indexDossierComposer();

        Blade::directive('datetime', function ($expression) {
            return "<?php echo ($expression)->format('m/d/Y H:i'); ?>";
        });

    }

	public function layoutComposer()
	{
		view()->composer('layout', function($view)
		{
		        $view->with('menuPrincipal', $this->menuWithChildren(400));
		        $view->with('menuHaut', $this->menuWithChildren(500));
		        $view->with('menusFooter', [
		        	$this->menuWithChildren(600),
		        	$this->menuWithChildren(700),
		        	$this->menuWithChildren(800),
		        ]);
	    		$view->with('user', Auth::user());
	    		$view->with('user', Auth::user());
	    		//$view->with('blocs', $this->getBlocs());
	    		//dd($this->getBlocs());
		});
	}

	public function adminLayoutComposer()
	{
		view()->composer('admin.layout', function($view)
		{
		        $view->with('menuPrincipal', $this->menuWithChildren(1));
		        $view->with('boutonsGauche', $this->menuWithChildren(300));
	    		$view->with('user', Auth::user());
		});
	}

	public function blocsComposer()
	{
		view()->composer('bloc', function($view)
		{
			$view->with('blocs', $this->getBlocs());
        });
	}

	public function getBlocs()
	{
		if (! ($blocs = cache('blocs')))
		{
			$blocs = Article::where('type', 'block')->get()->keyBy('url');
			cache(['blocs' => $blocs], 10);
		}
		return $blocs;
	}

    public function menuWithChildren($menu_id)
    {
    	$user = (Auth::user()) ? Auth::user() : new User;
    	$menu = Menu::where('parent_id', $menu_id)
	    			->whereIn('droit_id', $user->droitsIds())
	    			->with(['children' => function($query) use ($user) {
						$query->whereIn('droit_id', $user->droitsIds());
					}])
	    			->orderBy('ordre')
	    			->get();

		return $menu;
	}

	/*public function indexCategoriesComposer()
    {
		
	}*/


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
