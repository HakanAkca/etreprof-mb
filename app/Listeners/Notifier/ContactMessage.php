<?php

namespace App\Listeners\Notifier;

use App\Option;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Events\ContactMessageEvent as Event;
use App\Mail\ContactMessageMail as Mailable;

use Mail;

class ContactMessage
{
    /**
     * Handle the event.
     *
     * @param  DossierDemande  $event
     * @return void
     */
    public function handle(Event $event)
    {
        $tos = explode(',', Option::get('contact_destinataires'));

        //dd($toUsers->toArray());
        foreach ($tos as $to) {

            Mail::to($to)
                ->send(new Mailable($event->user, $event->valeurs));
        }

    }
}