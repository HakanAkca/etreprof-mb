<?php

namespace App\Listeners\Notifier;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Events\Discussion\NewMessageEvent as Event;
use App\Jobs\NotifyUnreadMessages;

use Date;

use App\User;

use Mail;

class NewMessages
{
    /**
     * Handle the event.
     *
     * @param  DossierDemande  $event
     * @return void
     */
    public function handle(Event $event)
    {
        $delai = Date::now()->addMinutes(1);
        $delai = Date::now()->addSeconds(10);
        // On attend 1 minute avant d'envoyer la notification pour ne pas notifier les utilisateurs actuellement */en ligne
        $job = (new NotifyUnreadMessages($event->message))
                    ->delay($delai);

        dispatch($job);


    }
}
