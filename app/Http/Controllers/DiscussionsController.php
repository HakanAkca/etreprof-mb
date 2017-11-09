<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Discussion;
use App\DiscussionMessage;
use Auth;

use App\Events\Discussion\NewMessageEvent;

class DiscussionsController extends Controller
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

    public function index($id = null)
    {
        
        //$latest = DiscussionMessage::

        return view('discussions.index', [
            'discussion_id' => $id,
        ]);

    }

    public function postDemarrer(Request $request) 
    {
        $user_id = $request->input('user_id');
        $discussion = Discussion::orWhere(function($q) use ($user_id) {
            $q->where('from_user_id', $user_id)
              ->where('to_user_id', Auth::user()->id);
          })
          ->orWhere(function($q) use ($user_id) {
            $q->where('to_user_id', $user_id)
              ->where('from_user_id', Auth::user()->id);
          })
          ->first();
        if (!$discussion) {
            $discussion = Discussion::create([
                'from_user_id' => Auth::user()->id,
                'to_user_id' => $user_id
            ]);
        }
        return response()->json([
            'discussion_url' => action('DiscussionsController@index', [$discussion->id]),
            'discussion_id' => $discussion->id
        ]);

    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function discussionJson($id)
    {
        $discussions = Discussion::where('from_user_id', Auth::user()->id)
                                 ->orWhere('to_user_id', Auth::user()->id)
                                 ->with('from')
                                 ->with('to')
                                 ->with('lastmessage')
                                 ->orderBy('updated_at', 'desc')
                                 ->get()
                                 ;
        if (is_numeric($id)) {
            $discussion = $discussions->where('id', $id)->first();
        } else {
            $discussion = $discussions->first();
        }                            

        $messages = [];
        if ($discussion)
        {
            $user = Auth::user();
            $other = $discussion->other($user);
        	$messages = $discussion->messages()
                                   ->with('from')
                                   ->get()
                                   ->map(function($i) use ($user, $other) {
                                        $i->name = $i->fromName($user);
                                        $i->image = $i->from->image;
                                        return $i;
                                   });
            $discussion->isRead(Auth::user());
            $discussion->save();
        }

        $discussions = $discussions->map(function($d) {
                                    $other = $d->other(Auth::user());
                                    $d->other = $other->name;
                                    $d->image = $other->image;
                                    $d->nonlus = $d->unread(Auth::user());
                                    return $d;
                                 });

        return response()->json(['messages' => $messages, 'discussions' => $discussions]);
    }

    public function postEcrire(Request $request, $id)
    {
        $discussion = Discussion::find($id);
        $from = Auth::user();
        $to = $discussion->other($from);
        $message = DiscussionMessage::create([
            'discussion_id' => $discussion->id,
            'from_user_id' => $from->id,
            'to_user_id' => $to->id,
            'message' => $request->input('message')
        ]);
        $discussion->last_message_id = $message->id;
        $discussion->setUnread($to, $discussion->unread($to) + 1);
        $discussion->save();
        event(new NewMessageEvent($message, $discussion, $from, $to));
        return $this->discussionJson($discussion->id);
    }
}
