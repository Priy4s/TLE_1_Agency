@extends('layouts.app')

    <div class="bg-[#FBFCF6] text-[#2E342A] min-h-screen p-4">
        <x-navbar-layout></x-navbar-layout>

        <!-- Heading -->
        <h1 class="text-4xl font-semibold text-center mb-6">My Job Listings</h1>

        <!-- Job Listings -->
        <div class="space-y-6">
            @foreach ($jobListings as $waitlist)
                <div class="bg-white shadow-md rounded-lg p-4 max-w-[20rem] mx-auto border border-black">
                    <h3 class="text-2xl font-semibold text-gray-800">
                        {{ $waitlist->job->position }} - {{ $waitlist->job->company->name ?? 'No company available' }}
                    </h3>

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
            @endforeach
        </div>

    </div>
