<?php

use App\Models\Message;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('messages.{messageId}', function ($user, $messageId) {
    $message = Message::find($messageId);
    return $message && $message->sender_id === $user->id;
});


Broadcast::channel('messages.{userId}', function ($user, $userId) {
    return (int) $user->id === (int) $userId;
});
