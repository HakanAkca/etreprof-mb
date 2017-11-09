<?php

namespace App\Listeners\Notifier;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Events\DemandeRechercheEvent as Event;
use App\Mail\AdminDemandeRechercheMail as Mailable;

use App\User;

use Mail;

class AdminDemandeRecherche
{
    /**
     * Handle the event.
     *
     * @param  DossierDemande  $event
     * @return void
     */
    public function handle(Event $event)
    {

		$toUsers = User::where('role_id', 5)->get();

		//dd($toUsers->toArray());
		Mail::to($toUsers)
			  ->send(new Mailable($event->requete, $event->url, $event->user));

    }
}
