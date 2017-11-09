<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function setActiveMenu($url, $parentUrl = '')
    {
		view()->composer('admin.layout', function($view) use($url, $parentUrl)
	    {
	    	$view
	    		->with('activeMenu', $url)
	    		->with('activeMenuTrail', $parentUrl);
	    });
	}

}
