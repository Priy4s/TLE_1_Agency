<?php

namespace App\Events;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Broadcasting\Channel;

class MessageSent implements ShouldBroadcast
{
    public $message;
    public $user;

    public function __construct($message, $user)
    {
        $this->message = $message->load('sender');  // Ensure sender relationship is loaded
        $this->user = $user;
    }

    public function broadcastOn()
    {
        return ['messages'];
    }

    public function broadcastAs()
    {
        return 'chat';
    }

    public function broadcastWith()
    {
        // Ensure the sender relationship is properly loaded

        return [
            'message' => $this->message->content,
            'sender' => $this->message->sender ? $this->message->sender->username : 'Unknown',
        ];
    }
}
