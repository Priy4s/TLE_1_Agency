@extends('layouts.app')

<h1 class="text-2xl font-bold mb-4 text-center">Chat with {{ $user->username }}</h1>    

<div class="chat-container bg-gray-100 p-4 rounded-lg shadow-md mb-4 mx-auto max-w-3xl">
    @foreach($messages as $message)
    @if($message->sender->name)
        <p class="mb-2"><strong>{{ $message->sender->name }}:</strong> {{ $message->content }}</p>
    @else
        <p class="mb-2"><strong>{{ $message->sender->username }}:</strong> {{ $message->content }}</p>
    @endif
    @endforeach
</div>
<form action="{{ route('chat.store', ['user' => $user->id]) }}" method="POST" class="flex flex-col space-y-4 mx-auto max-w-3xl">
    @csrf
    <textarea name="content" rows="3" required class="p-2 border rounded-lg w-full"></textarea>
    <button type="submit" class="bg-blue-500 text-black py-2 px-4 rounded-lg">Send</button>
</form>
<script>
    document.querySelector('form').addEventListener('submit', function(event) {
        // custom code
    });
    document.addEventListener('DOMContentLoaded', function() {
        const chatContainer = document.querySelector('.chat-container');
        chatContainer.scrollTop = chatContainer.scrollHeight;
    });
</script>
