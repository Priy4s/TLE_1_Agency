<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Display all users the authenticated user can chat with
    public function index()
    {
        // Get users that have received a message from the authenticated user
        $users = User::whereIn('id', function ($query) {
            $query->select('receiver_id')
                ->from('messages')
                ->where('sender_id', Auth::id())
                ->distinct();
        })->get();

        // Add unread messages count for each user
        foreach ($users as $user) {
            $user->unreadMessagesCount = Message::where('receiver_id', Auth::id())
                ->where('sender_id', $user->id)
                ->whereNull('read_at')
                ->count();
        }

        return view('chat.index', compact('users'));
    }



    // Show the chat between the authenticated user and a specific user
    public function show(User $user)
    {
        $authUserId = Auth::id();

        // Retrieve messages between the authenticated user and the specified user
        $messages = Message::where(function ($query) use ($user, $authUserId) {
            $query->where('sender_id', $authUserId)->where('receiver_id', $user->id);
        })->orWhere(function ($query) use ($user, $authUserId) {
            $query->where('sender_id', $user->id)->where('receiver_id', $authUserId);
        })->orderBy('created_at')->get();

        // Mark unread messages as read
        Message::where('receiver_id', $authUserId)
            ->where('sender_id', $user->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        // Get unread messages count for the user (optional)
        $unreadMessagesCount = Message::where('receiver_id', $authUserId)
            ->where('sender_id', $user->id)
            ->whereNull('read_at')
            ->count();

        return view('chat.show', compact('messages', 'user', 'unreadMessagesCount'));
    }

    // Store a new message in the chat
    public function store(Request $request, User $user)
    {
        $authUserId = Auth::id();

        $request->validate([
            'content' => 'required|string|max:1000', // Validate message content
        ]);

        // Create the new message
        Message::create([
            'sender_id' => $authUserId,
            'receiver_id' => $user->id,
            'content' => $request->content,
        ]);

        // Redirect back to the chat page
        return redirect()->route('chat.show', $user->id)->with('success', 'Message sent!');
    }
}
