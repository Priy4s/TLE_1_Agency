@extends('layouts.app')

<div class="flex flex-col min-h-screen overflow-hidden">
    <!-- Navbar -->
    <x-navbar-layout></x-navbar-layout>

    <!-- Main Content -->
    <main class="flex-grow">
        <h1 class="text-4xl font-semibold mb-6 text-center font-radical">Job Openings</h1>

        <div class="flex justify-center items-center mb-8"> <!-- Removed min-h-screen here -->
            <div class="max-w-3xl mx-auto">
                <form action="{{ route('job_listings.index') }}" method="GET" class="flex items-center">
                    <input
                        type="text"
                        id="search-query"
                        name="query"
                        placeholder="Search Jobs..."
                        class="p-4 rounded-l-full bg-gray-200 text-gray-800 placeholder-gray-500 placeholder:text-lg placeholder:font-bold focus:outline-none border-none w-64"
                        value="{{ request('query') }}"
                    >
                    <button type="submit"
                            class="ml-[-1px] bg-[#AA0160] text-white py-3.5 px-6 rounded-r-full hover:bg-[#8D0052] transition font-bold text-xl font-radical">
                        Search
                    </button>
                </form>
            </div>
        </div>

        <!-- Job Listings -->
        <ul class="space-y-6 mb-[2rem]">
            @foreach($jobListings as $job)
                <li class="bg-white shadow-md rounded-lg p-[1rem] max-w-[20rem] w-full border border-black mx-auto font-radical">
                    <h3 class="text-2xl font-semibold text-gray-800 flex items-center">
                        {{ $job->position }} -
                        {{ $job->company ? $job->company->name : 'No company available' }}

                        <!-- Rijbewijs-icoon -->
                        @if($job->drivers_license === 1)
                            <span class="ml-1">
                                <img src="{{ asset('images/auto.png') }}" alt="Auto Icon" class="h-30 w-36">
                            </span>
                        @endif
                    </h3>
                    <div class="mt-4 border-t border-black pt-[1rem]">
                        <p class="text-xl font-medium text-gray-700"><strong>Location:</strong>
                            {{ $job->location ? $job->location->name : 'No location available' }}
                        </p>
                        <p class="text-xl font-medium text-gray-700"><strong>Salary:</strong>
                            €{{ number_format($job->salary, 2) }} p/m</p>
                    </div>
                    <div class="mt-4 flex justify-center">
                        <form action="" method="get">
                            <button type="submit"
                                    class="w-[9rem] bg-[#AA0160] text-white py-2 px-6 rounded-full hover:bg-[#8D0052] transition font-bold text-xl font-radical">
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
