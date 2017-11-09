<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Menu;
use App\Droit;

class MenusController extends Controller
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
    	$menus = Menu::orderBy('ordre')->get();
    	$droits = Droit::all();

        return view('admin.menus.index', [
        	'menus' => $menus,
        	'droits' => $droits
        ]);
    }

    public function postEnregistrer(Request $request)
    {
        foreach ($request->input('tree') as $lien)
        {
            if (empty($lien['parent_id'])) $lien['parent_id'] = null;
            if ($lien['id'])
            {

                Menu::where('id', $lien['id'])->update($lien);
            }
            else
            {
                unset($lien['id']);
                unset($lien['i']);
                Menu::insert($lien);
            }
        }
        $menus = Menu::orderBy('ordre')->get();
        return response()->json($menus);
    }

    public function postSupprimer(Request $request)
    {
        Menu::where('id', $request->input('id'))->delete();
		return response()->json('ok');
	}

}
