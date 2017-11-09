<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Feedback;
use App\User;

class ContactMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $valeurs)
    {
        $this->user = $user;
        $this->valeurs = $valeurs;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('[Contact] ' . $this->valeurs['objet'])
            ->from($this->donnees['email'], $this->donnees['nom'])
            ->view('emails.contact-message', ['user' => $this->user, 'valeurs' => $this->valeurs]);
    }
}