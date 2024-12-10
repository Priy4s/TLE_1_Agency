@extends('layouts.app')

<div class="container mx-auto py-8">
    <h2 class="text-3xl font-semibold text-gray-800 mb-4">Chats</h2>

    @if($users->isEmpty())
        <p class="text-lg text-gray-600">No users found to chat with.</p>
    @else
        <ul class="space-y-4">
            @foreach ($users as $user)
                <li class="flex items-center justify-between p-4 bg-white rounded-lg shadow-md hover:bg-gray-50 transition duration-200">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gray-300 rounded-full mr-4">
                            <!-- Optionally, you can add a user avatar here -->
                        </div>
                        <span class="text-lg font-medium text-gray-800">{{ $user->username }}</span>
                    </div>

                    <div class="flex items-center space-x-2">
                        @if($user->unreadMessagesCount > 0)
                            <span class="text-xs font-bold text-white bg-red-500 px-2 py-1 rounded-full">
                                {{ $user->unreadMessagesCount }} unread
                            </span>
                        @endif
                        <a href="{{ route('chat.show', $user->id) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                            Start Chat
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
