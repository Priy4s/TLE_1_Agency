@extends('layouts.app')
<x-navbar-layout></x-navbar-layout>
<h1 class="text-2xl font-bold mb-4 text-center">Chat with {{ $user->username }}</h1>

<div class="chat-container bg-gray-100 p-4 rounded-lg shadow-md mb-4 mx-auto max-w-3xl">
    @foreach ($messages as $message)
        <div class="chat-message flex items-center mb-2">
            @if ($message->sender->name)
                <p class="flex-1"><strong>{{ $message->sender->name }}:</strong> {{ $message->content }}</p>
            @else
                <p class="flex-1"><strong>{{ $message->sender->username }}:</strong> {{ $message->content }}</p>
            @endif

            <!-- Speaker icon to read the message aloud -->
            <span
                class="speaker-icon cursor-pointer ml-2"
                aria-label="Click to hear this chat message"
                role="button"
                tabindex="0"
                data-text="{{ $message->content }}"
            >
            </span>
        </div>
    @endforeach
</div>


<!-- Chat form to send messages -->
<form id="chat-form" class="flex flex-col space-y-4 mx-auto max-w-3xl">
    @csrf
    <textarea id="message-content" name="content" rows="3" required class="p-2 border rounded-lg w-full"></textarea>
    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg">Send</button>
</form>
<button onclick="window.location.href='{{ route('chat.index') }}'"
    class="bg-gray-500 text-white py-2 px-4 rounded-lg mt-4 mx-auto block text-center">Back to Chats</button>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.10.0/dist/echo.iife.js"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

<script>
    Pusher.logToConsole = true;

    var pusher = new Pusher('1329641be032028eff5c', {
        cluster: 'eu' // Replace with your cluster
    });

    const channel = pusher.subscribe('chat-channel'); // Make sure this matches the channel you're broadcasting to

    channel.bind('chat', function(data) {
        // Check if the sender and message are available
        if (data.sender && data.sender.username) {
            // Append the new message to the chat container
            if (data.sender.name) {
                $('.chat-container').append(`
                <p class="mb-2"><strong>${data.sender.name}:</strong> ${data.message}</p>
            `);
            } else {
                $('.chat-container').append(`
                <p class="mb-2"><strong>${data.sender.username}:</strong> ${data.message}</p>
            `);
            }
        }
    });



    $('#chat-form').on('submit', function(e) {
        e.preventDefault();

        var messageContent = $('#message-content').val();

        $.ajax({
            url: '{{ route('chat.store', $user->id) }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                content: messageContent
            },
            success: function(response) {
                // Make sure the response contains the sender's username and content
                $('.chat-container').append(`
                <p class="mb-2"><strong>${response.sender}:</strong> ${response.content}</p>
            `);
                $('#message-content').val(''); // Clear the input field
            },
            error: function(xhr) {
                console.error('Error sending message:', xhr);
            }
        });
    });
</script>
