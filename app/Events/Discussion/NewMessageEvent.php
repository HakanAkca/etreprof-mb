<?php

namespace App\Events\Discussion;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewMessageEvent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $message, $discussion;
    protected $other, $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message, $discussion, $user, $other)
    {
        $message->name = $message->fromName($user);
        $this->message = $message;

        $this->discussion = $discussion;
        $this->user = $user;
        $this->other = $other;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('discussion.' . $this->other->id);
    }

    public function broadcastAs()
{
    return 'discussion.message';
}
}
