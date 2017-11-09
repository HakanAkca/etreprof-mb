<?php

namespace App\Listeners\Notifier;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Events\SosMessageEvent as Event;
use App\Mail\SosMessageMail as Mailable;

use App\Option;
use App\User;

use Mail;

class SosMessage
{
    /**
     * Handle the event.
     *
     * @param  DossierDemande $event
     * @return void
     */
    public function handle(Event $event)
    {

        $tos = explode(',', Option::get('sos_destinataires'));


        //dd($toUsers->toArray());
        foreach ($tos as $to) {
            Mail::to($to)
                ->send(new Mailable($event->user, $event->donnees));

        }
    }
}