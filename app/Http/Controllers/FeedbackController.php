<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Feedback;
use App\Events\UserFeedbackEvent;

use Auth;


class FeedbackController extends Controller
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
    public function postFeedback(Request $request)
    {
		
		$user_id = (Auth::user()) ? Auth::user()->id : null;
		
		$feedback = Feedback::create([
			'user_id' => $user_id,
			'feedback' => $request->input('feedback'),
		]);
		event(new UserFeedbackEvent($feedback));
		return response()->json('ok');
	}
}
