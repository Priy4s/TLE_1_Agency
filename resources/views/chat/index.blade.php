@extends('layouts.app')
<x-navbar-layout></x-navbar-layout>
<div class="container mx-auto py-8 flex flex-col items-center">
    <h2 class="text-3xl font-semibold text-gray-800 mb-4 text-center">Chats</h2>

    @if ($users->isEmpty())
        <p class="text-lg text-gray-600 text-center">No users found to chat with.</p>
    @else
        <ul class="space-y-4 w-full">
            @foreach ($users as $user)
                <li
                    class="flex items-center justify-between p-4 bg-white rounded-lg shadow-md hover:bg-gray-50 transition duration-200">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gray-300 rounded-full mr-4">
                            <!-- Optionally, you can add a user avatar here -->
                        </div>
                        @if ($user->name)
                            <span class="text-md font-medium text-gray-800">{{ $user->name }}</span>
                        @else
                            <span class="text-md font-medium text-gray-800">{{ $user->username }}</span>
                        @endif
                    </div>

                    <div class="flex items-center space-x-2">
                        @if ($user->unreadMessagesCount > 0)
                            <span class="text-xs font-bold text-white bg-red-500 px-2 py-1 rounded-full">
                                {{ $user->unreadMessagesCount }} NEW
                            </span>
                        @endif
                        <a href="{{ route('chat.show', $user->id) }}"
                            class="text-black hover:text-gray-800 font-medium flex items-center">
                            Start Chat
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black hover:text-gray-800 ml-1"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M2 3a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V5a2 2 0 00-2-2H2zm0 2h16v.01L10 10 2 5.01V5zm0 2.03L10 12l8-4.97V15H2V7.03z" />
                            </svg>
                        </a>
                    </div>
                </li>
            @endforeach
    @endif
    <div class="mt-8 flex justify-center">
        <a href="{{ route('home') }}" class="text-white bg-blue-600 hover:bg-blue-800 font-medium py-2 px-4 rounded">
            Back to Home
        </a>
    </div>
    </ul>
</div>
<footer>
    <x-footer-layout></x-footer-layout>
</footer>
