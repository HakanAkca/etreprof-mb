<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Feedback;
use App\User;
use Illuminate\Support\Facades\Auth;

class AdminUserFeedbackMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Feedback $feedback, User $user)
    {
        $this->feedback = $feedback;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $this->subject('Feedback par ' . $this->user->name)
        	 ->view('emails.admin-user-feedback', ['feedback' => $this->feedback, 'user' => $this->user]);
        if (!empty($this->user->email))
        {
            $this->from($this->user->email, $this->user->name);
        }
        return $this;
    }
}
