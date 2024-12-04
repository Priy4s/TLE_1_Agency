@extends('layouts.app')

<div class="flex flex-col min-h-screen overflow-hidden">
    <!-- Navbar -->
    <x-navbar-layout></x-navbar-layout>

    <!-- Main Content -->
    <main class="flex-grow">
        <h1 class="text-4xl font-semibold mb-6 text-center font-radical">Job Listings</h1>

        <!-- Zoekbalk -->
        <div class="max-w-3xl mx-auto mb-8">
            <input
                type="text"
                id="job-search"
                placeholder="Search jobs..."
                class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-indigo-200"
            />
        </div>

        <!-- Job Listings -->
        <ul class="space-y-6 mb-[2rem]">
            @foreach($jobListings as $job)
                <li class="bg-white shadow-md rounded-lg p-[1rem] max-w-[20rem] w-full border border-black mx-auto font-radical">
                    <h3 class="text-2xl font-semibold text-gray-800 flex items-center">
                        {{ $job->position }} -
                        {{ $job->company ? $job->company->name : 'No company available' }}

                        <!-- Rijbewijs-icoon -->
                        @if($job->driver_license === 1)
                            <span class="ml-1">
    <img src="{{ asset('images/auto.png') }}" alt="Auto Icon" class="h-18 w-12">
</span>

                        @endif
                    </h3>
                    <div class="mt-4 border-t border-black pt-[1rem]">
                        <p class="text-xl font-medium text-gray-700"><strong>Location:</strong>
                            {{ $job->location ? $job->location->name : 'No location available' }}
                        </p>
                        <p class="text-xl font-medium text-gray-700"><strong>Salary:</strong> €{{ number_format($job->salary, 2) }}</p>
                    </div>
                    <div class="mt-4 flex justify-center">
                        <form action="" method="get">
                            <button type="submit" class="w-[9rem] bg-[#AA0160] text-white py-2 px-6 rounded-full hover:bg-[#8D0052] transition font-bold text-xl font-radical">
                                Details
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </main>

    <!-- Footer -->
    <footer>
        <x-footer-layout></x-footer-layout>
    </footer>
</div>
