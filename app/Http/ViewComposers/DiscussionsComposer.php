<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;

class DiscussionsComposer
{

    public function __construct()
    {

    }

    function compose(View $view)
    {
        $view->with('masquerChat', 1);
    }

}