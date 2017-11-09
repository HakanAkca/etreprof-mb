<?php

namespace App\Listeners\Notifier;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Events\CommentairePublieEvent as Event;
use App\Mail\CommentairePublieMail as Mailable;

use App\User;

use Mail;

class CommentairePublie
{
    /**
     * Handle the event.
     *
     * @param  DossierDemande  $event
     * @return void
     */
    public function handle(Event $event)
    {
        $toUser = $event->contenu->proposePar;

        //dd($toUsers->toArray());
        Mail::to($toUser)
            ->send(new Mailable($event->commentaire, $event->contenu, $event->user));
    }
}