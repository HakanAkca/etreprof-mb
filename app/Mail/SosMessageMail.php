<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Feedback;
use App\User;

class SosMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $donnees)
    {
        $this->user = $user;
        $this->donnees = $donnees;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('[Urgent] ' . $this->donnees['objet'])
            ->from($this->donnees['email'], $this->donnees['nom'])
            ->view('emails.sos-contact', ['user' => $this->user, 'donnees' => $this->donnees]);
    }
}