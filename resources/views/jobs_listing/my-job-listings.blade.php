@extends('layouts.app')

<div class="text-[#2E342A] min-h-screen p-4">
    <x-navbar-layout></x-navbar-layout>

    <!-- Heading -->
    <h1 class="text-4xl font-semibold text-center mb-6">My Job Listings <span
            class="speaker-icon"
            aria-label="Click to hear the header"
            role="button"
            tabindex="0"
            data-text="My job listings">
            </span>
    </h1>

    <!-- Job Listings -->
    <div class="space-y-6">
        @foreach ($jobListings as $waitlist)
            @if ($waitlist->status === 'hired')
                <div class="bg-yellow p-6 rounded-lg shadow-lg border-4 border-yellow-500 max-w-[22rem] mx-auto relative">
                    <h3 class="text-xl font-bold text-gray-800 text-center mb-4">
                        🎉You’ve been selected!🎉
                        <span
                            class="speaker-icon absolute top-2 right-2"
                            aria-label="Click to hear the status of this job listing"
                            role="button"
                            tabindex="0"
                            data-text="You’ve been selected for {{ $waitlist->job->position }} - {{ $waitlist->job->company->name ?? 'No company available' }}! The employer will message you to agree on a starting date!">
                    </span>
                    </h3>
                    <p class="text-center font-semibold text-gray-700 mb-2">
                        {{ $waitlist->job->position }} - {{ $waitlist->job->company->name ?? 'No company available' }}
                    </p>
                    <p class="text-center text-gray-800">
                        The employer will message you to agree on a starting date!
                    </p>
                </div>

            @else
                <div class="bg-white shadow-md rounded-lg p-4 max-w-[20rem] mx-auto border border-black relative">
                    <h3 class="text-2xl font-semibold text-gray-800">
                        {{ $waitlist->job->position }} - {{ $waitlist->job->company->name ?? 'No company available' }}
                    </h3>

                    <!-- Speaker Icon positioned at the top-right corner -->
                    <span
                        class="speaker-icon absolute top-2 right-2"
                        aria-label="Click to hear the status of this job listing"
                        role="button"
                        tabindex="0"
                        data-text="{{ $waitlist->job->position }} at {{ $waitlist->job->company->name ?? 'No company available' }}. Your position is {{ $waitlist->position }}. Total waitlist is {{ $waitlist->waitlist_count }}.">
    </span>

                    <div class="mt-4 flex justify-between">
                        <p><strong>Your Position:</strong> {{ $waitlist->position }}</p>
                        <p><strong>Waitinglist:</strong> {{ $waitlist->waitlist_count }}</p>
                    </div>

                    <div class="mt-4 flex justify-center">
                        <form action="{{ route('job.show', ['id' => $waitlist->job->id]) }}" method="get">
                            <button type="submit" class="cta-button bg-[#AA0160] text-white py-2 px-6 rounded-full hover:bg-[#8D0052] transition font-bold">
                                See Details
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

</div>
