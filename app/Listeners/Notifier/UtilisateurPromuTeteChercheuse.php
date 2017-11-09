<?php

namespace App\Listeners\Notifier;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Events\UtilisateurPromuTeteChercheuseEvent as Event;
use App\Mail\UtilisateurPromuTeteChercheuseMail as Mailable;
use App\User;

use Mail;

class UtilisateurPromuTeteChercheuse
{
    /**
     * Handle the event.
     *
     * @param  DossierDemande  $event
     * @return void
     */
    public function handle(Event $event)
    {
        $user = $event->user;

		//dd($toUsers->toArray());
		Mail::to($user)
			  ->send(new Mailable($user));

    }
}
