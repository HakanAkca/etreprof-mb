<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Auth;
use App\Profil;
use Devfactory\Taxonomy\Models\Term;
class AnalyticsComposer {

	public function __construct()
	{

	}

	function compose(View $view)
	{
        $termes = '';
        $dominante = Profil::dominanteUser(Auth::user());
        if (!empty($dominante->reponse))
        {
                $termes = Term::whereIn('id', explode(',', $dominante->reponse))->pluck('name')->implode('+');
        }
		$view->with('profil', $termes);
	}

}