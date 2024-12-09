<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; // Import the Auth facade
use Illuminate\Routing\Controller; // Import the Controller class
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;

class ChatController extends Controller
{
    // Ensure that only authenticated users can access the chat
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Show the chat page with messages
    public function index(User $user)
    {
        $authUserId = Auth::user()->id;  // Retrieve the authenticated user's ID

        $messages = Message::where(function ($query) use ($user, $authUserId) {
            $query->where('sender_id', $authUserId)
                ->where('receiver_id', $user->id);
        })->orWhere(function ($query) use ($user, $authUserId) {
            $query->where('sender_id', $user->id)
                ->where('receiver_id', $authUserId);
        })->orderBy('created_at')->get();

        // Mark messages as read when user opens the chat
        Message::where('receiver_id', $authUserId)
            ->where('sender_id', $user->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return view('chat.index', compact('messages', 'user'));
    }

    // Store a new message in the chat
    public function store(Request $request, User $user)
    {
        $authUserId = Auth::user()->id; // Retrieve the authenticated user's ID

        $request->validate([
            'content' => 'required|string|max:1000', // Content validation
        ]);

        // Create the new message
        Message::create([
            'sender_id' => $authUserId,
            'receiver_id' => $user->id,
            'content' => $request->content,
        ]);

        // Redirect back to the chat page with a success message
        return redirect()->route('chat.index', ['user' => $user->id])->with('success', 'Message sent successfully.');
    }
}
