<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification
{
    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail()
    {
        return (new MailMessage)
        	->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'))
        	->subject('Réinitialisation de mot de passe')
            ->line('Vous recevez ce message car nous avons enregistré une demande de réinitialisation du mot de passe pour votre compte.')
            ->action('Réinitialiser le mot de passe', url('password/reset', $this->token))
            ->line('Si vous n\'avez pas effectué la demande de réinitialisation, vous pouvez ignorer ce message.')
            ->view('emails.reset-password')
            ;
    }
}
