<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Events\ContactMessageEvent;
use App\Events\SosMessageEvent;

class ContactController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function contact()
    {
        return view('contact/contact');
    }

    public function postEnvoyer(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'objet' => 'required',
            'nom' => 'required',
            'message' => 'required',
        ];
;
        $this->validate($request, $rules);

        event(new ContactMessageEvent($request->all()));
        return redirect()->action('ContactController@merci');

    }

    public function merci()
    {
        return view('contact/merci');
    }

    public function sos()
    {
        return view('contact/sos');
    }

    public function postSos(Request $request)
    {
        $rules = [
            'select' => 'required',
            'email' => 'required|email',
            'objet' => 'required',
            'nom' => 'required',
            'message' => 'required',
        ];

        $this->validate($request, $rules);

        event(new SosMessageEvent($request->all()));
        return redirect()->action('ContactController@merci');

    }
}

