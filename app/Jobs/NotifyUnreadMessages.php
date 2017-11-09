<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\UnreadMessages;

class NotifyUnreadMessages implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $message;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $message = $this->message;
        $to = $message->to;
        $discussion = $message->discussion;
        if ($discussion->notified($to) OR $discussion->unread($to) == 0)
        {
            //print "Déjà notifié";
            //dd($discussion);
            return;
        }
        //dd(['d' => $discussion]);
        //$when = Date::now()->addMinutes(1);
        //$user->notify((new UnreadMessages($event->message))->delay($when));
        $to->notify(new UnreadMessages($message));
        $discussion->isNotified($to);
        $discussion->save();
        //dd($toUsers->toArray());
    }
}
