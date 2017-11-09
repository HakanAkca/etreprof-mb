<?php

namespace App\Listeners\Notifier;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Events\UtilisateurInscritEvent as Event;
use App\Mail\AdminNouvelUtilisateurMail as Mailable;
use App\User;

use Mail;

class AdminNouvelUtilisateur
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

		$toUsers = User::where('role_id', 5)->get();

		//dd($toUsers->toArray());
		Mail::to($toUsers)
			  ->send(new Mailable($user));

    }
}
