@extends('layouts.app')

<div class="min-h-screen flex items-center justify-center bg-blue-50">
    <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-6 sm:p-8 md:max-w-2xl lg:max-w-3xl">
        <!-- Welkomstsectie -->
        <div class="text-center mb-6">
            <h1 class="text-2xl sm:text-3xl font-bold text-[#30332C]">
                <span
                    class="speaker-icon ml-5"
                    aria-label="Click to hear what's next after getting signing up"
                    role="button"
                    tabindex="0"
                    data-text="{{ "Congratulations! You're One Step Closer! You're now on the waiting list and closer than ever to your next job opportunity. Stay tuned! You're on the waitlist You have successfully signed up. Here's what happens next: 1, It can take some time. 2, If you're number 1, the employer will message you about your start date. 3, Start working!" }}">
    </span>
                Congratulations! You're One Step Closer!</h1>
            <p class="text-base sm:text-lg text-gray-600 mt-2">You're now on the waiting list and closer than ever to your next job opportunity. Stay tuned!</p>
        </div>

        <!-- Statusbericht -->
        <div class="flex items-center justify-start mb-4 space-x-2">
            <div class="text-yellow-500 font-bold text-xl">✅</div>
            <h2 class="text-xl sm:text-2xl font-semibold text-green-600">You're on the waiting list!</h2>
        </div>

        <!-- Informatie over de volgende stappen -->
        <p class="text-sm sm:text-base text-gray-700 mb-6">You have successfully signed up. Here's what happens next:</p>
        <ol class="list-decimal pl-5 space-y-2 text-gray-800 text-sm sm:text-base">
            <li>It can take some time.</li>
            <li>If you're number 1, the employer will message you about your start date.</li>
            <li>Start working!</li>
        </ol>

        <!-- Call-to-action button -->
        <a href="{{ route('job_listings.my') }}" class="block mt-6 bg-[#AA0160] text-wite text-center py-3 rounded-lg shadow-md hover:bg-[#7A0040] transition ease-in-out duration-300">
            View My Job Listings
        </a>
    </div>
</div>
