<?php

namespace App\Listeners\Notifier;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Events\UserFeedbackEvent as Event;
use App\Mail\AdminUserFeedbackMail as Mailable;

use App\Option;
use App\User;

use Mail;

class AdminUserFeedback
{
    /**
     * Handle the event.
     *
     * @param  DossierDemande  $event
     * @return void
     */
    public function handle(Event $event)
    {
        $feedback = $event->feedback;
        $user = $feedback->user;

        $tos = explode(',', Option::get('feedback_destinataires'));

        foreach ($tos as $to) {
            //dd($toUsers->toArray());
            Mail::to($to)
                ->send(new Mailable($feedback, $user));
        }
    }
}
