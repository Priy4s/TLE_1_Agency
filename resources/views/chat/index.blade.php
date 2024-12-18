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
                    class="flex items-center justify-between p-4 bg-gray-50 rounded-lg shadow-md w-[90%] mx-[5%] hover:bg-gray-150 transition duration-200">
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
                            class="text-black hover:text-gray-800 font-medium flex items-center underline">
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

 @if(auth()->check() && auth()->user()->role == 'admin')
    <div class="mt-8 flex justify-center">
        <a href="{{ route('manager.dashboard') }}" class="cta-button bg-violet hover:bg- violet text-white py-3 px-6 rounded-lg font-semibold shadow-md">
            Back to Dashboard
        </a>
    </div>
                @else
                <div class="mt-8 flex justify-center">
                    <a href="{{ route('job_listings.index') }}" class="cta-button bg-violet hover:bg- violet text-white py-3 px-6 rounded-lg font-semibold shadow-md">
                        Back to Job Openings
                    </a>
                </div>
                @endif
    </ul>
</div>
<p class="mx-[5%] my-4 text-md bg-mosslight border-b-4 border-r-4 border-mossmedium rounded-[16px] py-4 px-12 flex items-center pb-[-5px] text-left leading-tight">
    &#x1F6C8 When you start chatting with someone, your name will appear if you've provided
    one. But don't worry—you're already hired! This is Open Hiring, where we focus
    on opportunities, not interviews.</p>

<footer>
    <x-footer-layout></x-footer-layout>
</footer>
