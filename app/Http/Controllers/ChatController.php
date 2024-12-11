<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use App\Events\MessageSent;


class ChatController extends Controller
{
    public function __construct()
    {
        // Ensure the user is authenticated before accessing any methods in the controller
        $this->middleware('auth');
    }

    /**
     * Display all users the authenticated user can chat with.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::whereIn('id', function ($query) {
            $query->select('receiver_id')
                ->from('messages')
                ->where('sender_id', Auth::id())
                ->distinct();
        })->orWhereIn('id', function ($query) {
            $query->select('sender_id')
                ->from('messages')
                ->where('receiver_id', Auth::id())
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

    /**
     * Show the chat between the authenticated user and a specific user.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\View\View
     */
    public function show(User $user)
    {
        $authUserId = Auth::id();

        // Retrieve messages between the authenticated user and the specified user
        $messages = Message::whereIn('sender_id', [$authUserId, $user->id])
            ->whereIn('receiver_id', [$authUserId, $user->id])
            ->orderBy('created_at')
            ->get();

        // Mark unread messages as read
        Message::where('receiver_id', $authUserId)
            ->where('sender_id', $user->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        // Get unread messages count for the user
        $unreadMessagesCount = Message::where('receiver_id', $authUserId)
            ->where('sender_id', $user->id)
            ->whereNull('read_at')
            ->count();

        return view('chat.show', compact('messages', 'user', 'unreadMessagesCount'));
    }

    /**
     * Store a new message in the chat.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, User $user)
    {
        $authUserId = Auth::id();

        // Validate the incoming request
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        // Create the new message and store it in the database
        $message = new Message();
        $message->sender_id = $authUserId;
        $message->receiver_id = $user->id;
        $message->content = $request->content;
        $message->save();

        // Load the sender relationship before broadcasting
        $message->load('sender');  // Eager load sender relationship

        // Broadcast the event
        broadcast(new MessageSent($message, $user));

        // Return a JSON response with the message data
        return response()->json([
            'sender' => $message->sender->name ? $message->sender->name : $message->sender->username,  // Ensure sender is loaded
            'content' => $message->content,
        ]);
    }
}
