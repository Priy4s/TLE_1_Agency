@extends('layouts.app')

<div class="flex flex-col min-h-screen overflow-hidden">
    <!-- Navbar -->
    <x-navbar-layout></x-navbar-layout>

    <!-- Main Content -->
    <main class="flex-grow">
        <h1 class="text-4xl font-semibold mb-4 text-center font-radical">Job Openings
            <span
                class="speaker-icon ml-5"
                aria-label="Click to hear the header out loud"
                role="button"
                tabindex="0"
                data-text="{{ "Job Openings" }}">
            </span>
        </h1>

        <!-- Search and Sort Section -->
        <div class="flex justify-center items-center mb-8 w-full h-full">
            <form action="{{ route('job_listings.index') }}" method="GET" class="flex flex-col justify-center items-center w-full max-w-lg" id="search-sort-form">
                <!-- Search Field -->
                <div class="flex w-full max-w-[20rem] max-h-[12rem] mb-4">
                    <input
                        type="text"
                        id="search-query"
                        name="query"
                        placeholder="Search Jobs..."
                        class="flex-2 py-[1rem] px-[0.75rem] rounded-l-lg bg-gray-200 text-gray-800 placeholder-gray-500 placeholder:text-[1.1rem] placeholder:font-medium focus:outline-none border-none w-[80%]"
                        value="{{ request('query') }}"
                    >
                    <button type="submit"
                            class="flex-1 ml-[-1px] bg-[#AA0160] text-white py-[1rem] px-[1.25rem] rounded-r-lg hover:bg-[#8D0052] transition font-bold text-[1.1rem]">
                        Search
                    </button>
                </div>

                <!-- Sort Dropdown Underneath Search Field -->
                <div class="mt-4 w-full max-w-[20rem]">
                    <label for="sort-dropdown" class="sr-only">Sort job listings by salary</label>
                    <select name="sort" class="py-2 px-4 w-full bg-gray-200 text-gray-800 border border-[#AA0160] rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#AA0160] transition-all duration-200 ease-in-out" id="sort-dropdown" aria-labelledby="sort-dropdown">
                        <option value="" disabled selected class="text-gray-500">Sort by Salary</option>
                        <option value="salary_asc" {{ request('sort') === 'salary_asc' ? 'selected' : '' }} class="bg-white hover:bg-[#f3f3f3] transition-all">Salary Ascending</option>
                        <option value="salary_desc" {{ request('sort') === 'salary_desc' ? 'selected' : '' }} class="bg-white hover:bg-[#f3f3f3] transition-all">Salary Descending</option>
                    </select>

                </div>
            </form>
        </div>

        <!-- Job Listings -->
        <ul class="space-y-6 mb-[2rem]">
            @foreach($jobListings as $job)
                <li class="bg-white shadow-md rounded-[16px] px-[1rem] pt-[1rem] max-w-[20rem] w-full border border-black mx-auto font-radical relative">
                    <h3 class="text-2xl font-bold text-gray-800 flex items-center">
                        {{ $job->position }} -
                        {{ $job->company ? $job->company->name : 'No company available' }}

                        @if($job->drivers_license === true)
                            <span class="ml-1">
                                <img src="{{ asset('images/auto.png') }}" alt="Auto Icon" class="h-30 w-32">
                            </span>
                        @endif
                    </h3>

                    <!-- Speaker Icon Positioned in Top Right -->
                    <span
                        class="speaker-icon absolute top-2 right-2 cursor-pointer"
                        aria-label="Click to hear the job title read aloud"
                        role="button"
                        tabindex="0"
                        data-text="{{ $job->position }} at {{ $job->company ? $job->company->name : 'No company available' }}">
                    </span>

                    <div class="mt-4 border-green border-t-2 pt-[1rem]">
                        <p class="text-xl font-medium text-gray-700"><strong>Location:</strong>
                            {{ $job->location ? $job->location->name : 'No location available' }}
                        </p>
                        <p class="text-xl font-medium text-gray-700"><strong>Salary:</strong>
                            €{{ number_format($job->salary, 2) }} p/m
                        </p>
                    </div>

                    <div class="mt-4 flex justify-center">
                        <form action="{{ route('job.show', ['id' => $job->id]) }}" method="get">
                            <button type="submit"
                                    class="w-[11rem] bg-violet text-white py-2 px-6 rounded-lg hover:bg-darkviolet transition font-bold text-xl font-radical">
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

<!-- JavaScript to auto-submit form when sorting option changes -->
<script>
    document.getElementById('sort-dropdown').addEventListener('change', function() {
        // Submit the form when the sorting option is changed
        document.getElementById('search-sort-form').submit();
    });
</script>
