<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Commentaire;
use App\Contenu;
use App\User;

class CommentairePublieMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Commentaire $commentaire, Contenu $contenu, User $user)
    {
        $this->commentaire = $commentaire;
        $this->contenu = $contenu;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Nouveau commentaire sur la ressource ' . $this->contenu->titre)
            ->view('emails.commentaire-publie-message', [
                'user' => $this->user,
                'commentaire' => $this->commentaire,
                'contenu' => $this->contenu
                ]);
    }
}