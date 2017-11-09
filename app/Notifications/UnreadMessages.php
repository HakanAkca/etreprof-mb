<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Notifications\Messages\MailMessage;

use App\DiscussionMessage;

class UnreadMessages extends Notification implements ShouldQueue 
{
    use Queueable;

    public $message;
    public $nb;

    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct(DiscussionMessage $message)
    {
        $this->message = $message;
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
        /*$nb = DiscussionMessage::where('status', 'unread')
                                   ->where('to_user_id', $this->message->to_user_id)
                                   ->count();

        if (!$nb) 
        {
            return;
        }*/


        $notification = (new MailMessage)
            ->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'))
            ->subject($this->message->from->name . ' vous a envoyé un message')
            ->line($this->message->from->name . ' vous a envoyé un message : ')
            //->line($this->message->message)
            ->action('Voir la discussion', url('discussions/' . $this->message->discussion_id));
            //->action('Voir mes discussions', url('discussions'));

        /*if ($nb > 1)
        {
            $notification->line('Vous avez ' . $nb . ' messages non lus');
        }*/

        return $notification
            ->view('emails.unread-messages')
            ;
    }
}
