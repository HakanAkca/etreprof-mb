<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;

class AdminDemandeRechercheMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($requete, $url, User $user)
    {
        $this->requete = $requete;
        $this->url = $url;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Demande de ressources par ' . $this->user->name)
        			->view('emails.admin-demande-recherche', ['requete' => $this->requete, 'url' => $this->url, 'user' => $this->user]);
    }
}
