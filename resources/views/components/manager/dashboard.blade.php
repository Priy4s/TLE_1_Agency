@extends('layouts.app')

<div class="flex flex-col min-h-screen overflow-hidden">
    <!-- Navbar -->
    <x-navbar-layout></x-navbar-layout>

    <!-- Main Content -->
    <main class="flex-grow">
        <h1 class="text-5xl font-semibold mb-10 text-center font-radical text-[#333]">Manage Vacancies</h1>

        <!-- Search bar -->
        <div class="flex justify-center items-center mb-12">
            <div class="max-w-lg w-full">
                <form action="{{ route('manager.dashboard') }}" method="GET" class="flex items-center">
                    <input
                        type="text"
                        id="search-query"
                        name="query"
                        placeholder="Search Jobs..."
                        class="p-4 rounded-l-full bg-gray-200 text-gray-800 placeholder-gray-500 placeholder:text-lg placeholder:font-bold focus:outline-none border-none w-full"
                        value="{{ request('query') }}"
                    >
                    <button type="submit"
                            class="ml-[-1px] bg-[#AA0160] text-white py-3.5 px-6 rounded-r-full hover:bg-[#8D0052] transition font-bold text-lg font-radical">
                        Search
                    </button>
                </form>
            </div>
        </div>

        <!-- Create Job Listing button -->
        <div class="flex justify-center mb-14">
            <a href="{{ route('job_listings.create') }}"
               class="bg-[#AA0160] text-white py-4 px-8 rounded-full hover:bg-[#8D0052] transition font-bold text-lg font-radical">
                Create Job Listing
            </a>
        </div>

        <!-- Job Listings -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 px-10">
            @foreach($jobListings as $job)
                <ul class="bg-white shadow-lg rounded-lg p-6 border border-gray-200">
                    <h3 class="text-2xl font-semibold text-gray-800 flex items-center mb-4">
                        {{ $job->position }} -
                        {{ $job->company ? $job->company->name : 'No company available' }}

                        @if($job->drivers_license === true)
                            <img src="{{ asset('images/auto.png') }}" alt="Driver's License Required" class="h-20 w-25 ml-4">
                        @endif
                    </h3>
                    <div class="border-t border-gray-300 pt-4">
                        <p class="text-lg font-medium text-gray-700"><strong>Location:</strong>
                            {{ $job->location ? $job->location->name : 'No location available' }}
                        </p>
                        <p class="text-lg font-medium text-gray-700"><strong>Salary:</strong>
                            €{{ number_format($job->salary, 2) }} p/m</p>
                    </div>
                    <div class="mt-6 flex justify-center">
                        <form action="" method="get">
                            <button type="submit"
                                    class="w-full bg-[#AA0160] text-white py-2 px-6 rounded-full hover:bg-[#8D0052] transition font-bold text-lg">
                                Manage
                            </button>
                        </form>
                    </div>
                </ul>
            @endforeach
        </div>
    </main>

    <!-- Footer -->
    <footer class="mt-14">
        <x-footer-layout></x-footer-layout>
    </footer>
</div>
