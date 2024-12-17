@extends('layouts.app')

<div class="w-[90%] mx-[5%] mb-5">
    <x-navbar-layout></x-navbar-layout>

    <!-- Flash Messages -->
    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-500 text-white p-4 rounded-md mb-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Job Header -->
    <div class="">
        <img src="{{ asset('storage/' . $job->image) }}" alt="{{ $job->position }}"
             class="col-span-1 w-full h-48 object-cover rounded-lg">
        <h1 class="text-4xl font-semibold text-gray-800 mt-4 ml-3">
            <span
                class="speaker-icon"
                aria-label="Click to hear the job title, location, waitlist, and needed people read aloud"
                role="button"
                tabindex="0"
                data-text="{{ $job->position }}. Location, {{ $job->location ? $job->location->name : 'No location available' }}. People waiting, {{ $waitlistCount }}. People needed, {{ $job->needed }}">
            </span>
            {{ $job->position }}</h1>
        <div class="flex justify-between items-center mt-2 mx-3">
            <div class="text-center">
                <p class="font-extrabold"> {{ $job->location ? $job->location->name : 'No location available' }}</p>
                <p class="">Location</p>
            </div>
            <div class="text-center">
                <p class="font-extrabold">{{ $waitlistCount }}</p>
                <p class="">Waiting</p>
            </div>
            <div class="text-center">
                <p class="font-extrabold">{{ $job->needed }}</p>
                <p class="">Needed</p>
            </div>
        </div>
    </div>

    <!-- Job Details -->
    <div class="job-details mb-6">
        <h3 class="text-3xl mt-5 font-bold mb-3 ml-1">
            <span
                class="speaker-icon ml-2"
                aria-label="Click to hear the job details read aloud"
                role="button"
                tabindex="0"
                data-text="Job details. Salary: €{{ number_format($job->salary, 2) }} per month, Job length: {{ $job->length ?? 'Not specified' }}, Job hours: {{ $job->hours ?? 'Not specified' }}, Job type: {{ $job->type ?? 'Not specified' }}">
                    </span>
            Job Details</h3>
        <div class="grid grid-cols-2 gap-4 text-[1.1rem] bg-mosslight border-b-4 border-r-4 border-mossmedium rounded-[16px] py-3 pl-12">
            <p><span class="font-black pr-2">Salary:</span> €{{ $job->salary }}</p>
            <p><span class="font-black pr-2">Length:</span> {{ $job->length }}</p>
            <p><span class="font-black pr-2">Job:</span> {{ $job->position }}</p>
            <p><span class="font-black pr-2">Hours:</span> {{ $job->hours }}</p>
            <p><span class="font-black pr-2">Type:</span> {{ $job->type }}</p>
            <p><span class="font-black pr-2">Avg.(€):</span> €{{ $job->avg_salary }}</p>
            <p><span class="font-black pr-2">Starting Date:</span>{{ $job->starting_date }}</p>
        </div>
    </div>

    <!-- Job Information -->
    <div class="job-info mb-6 ml-1">
        <h3 class="text-3xl mt-5 font-bold mb-3">
            <span
                class="speaker-icon ml-2"
                aria-label="Click to hear the job description read aloud"
                role="button"
                tabindex="0"
                data-text="Job information: {{ $job->description }}">
                    </span>
            Job Information</h3>
        <p class="text-gray-700 text-sm">{{ $job->description }}</p>
    </div>

    <!-- Call to Action Buttons -->
    <div class="text-center mb-4">
        @if ($isOnWaitlist)
            <!-- Leave Waitlist Form -->
            <button type="button" onclick="openLeaveModal()"
                    class="cta-button bg-green hover:bg-mossdark text-white py-3 px-6 rounded-lg font-semibold shadow-md">
                Leave the Waitlist
            </button>
        @else
            <!-- Button to Open Join Modal -->
            <button type="button" onclick="openJoinModal()"
                    class="cta-button bg-mosslight hover:bg-mossmedium text-black py-3 px-6 rounded-lg font-semibold shadow-md">
                Join the waiting list
            </button>
        @endif
    </div>

    <div class="text-center">
        <a href="{{ str_contains(url()->previous(), '/my-job-listings') ? '/my-job-listings' : '/joblistings' }}">
            <button class="cta-button bg-[#7C1A51] hover:bg-[#7C1A51] text-[#FFFFFF] py-3 px-6 rounded-lg font-semibold shadow-md">
                Back to {{ str_contains(url()->previous(), '/my-job-listings') ? 'My Job Listings' : 'Job Listings' }}
            </button>
        </a>
    </div>

    <!-- Join Modal -->
    <div id="confirmationModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-mosslight rounded-lg shadow-lg p-6 w-96 relative">
            <!-- Sluitknop -->
            <button onclick="closeJoinModal()"
                    class="absolute top-2 right-2 text-gray-600 hover:text-gray-900 text-4xl font-bold">&times;</button>

            <h2 class="text-2xl font-bold mt-3 mb-4 text-center text-black">Join the waiting list for {{ $job->position }}</h2>


            {{--            <div class="mb-6 text-[#000000]-700">--}}
            {{--                <p><strong>Salary:</strong> €{{ $job->salary }}</p>--}}
            {{--                <p><strong>Length:</strong> {{ $job->length }} months</p>--}}
            {{--                <p><strong>Hours:</strong> {{ $job->hours }} p/w</p>--}}
            {{--                <p><strong>Type:</strong> {{ $job->type }}</p>--}}
            {{--            </div>--}}

            <div class="grid grid-cols-2 gap-4 text-[1.1rem] bg-mosslight py-3 pl-12">
                <p><span class="font-black pr-2">Salary:</span> €{{ $job->salary }}</p>
                <p><span class="font-black pr-2">Length:</span> {{ $job->length }}</p>
                <p><span class="font-black pr-2">Job:</span> {{ $job->position }}</p>
                <p><span class="font-black pr-2">Hours:</span> {{ $job->hours }}</p>
                <p><span class="font-black pr-2">Type:</span> {{ $job->type }}</p>
                <p><span class="font-black pr-2">Avg.(€):</span> €{{ $job->avg_salary }}</p>
            </div>


            <div class="flex justify-between mt-4 h-10">
                <!-- Ja knop -->
                <form action="{{ route('job.joinWaitlist', $job->id) }}" method="POST" class="h-full">
                    @csrf
                    <button type="submit" class="bg-green text-white h-full px-6 rounded hover:bg-mossdark">Yes, join the waitlist</button>
                </form>

                <!-- Nee knop -->
                <button onclick="closeJoinModal()"
                        class="text-white bg-violet leading-none rounded h-full px-6 hover:bg- violet">No</button>
            </div>
        </div>
    </div>

    <!-- Leave Modal -->
    <div id="leaveModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-mosslight rounded-lg shadow-lg p-6 w-96 relative">
            <!-- Sluitknop -->
            <button onclick="closeLeaveModal()"
                    class="absolute top-2 right-2 text-gray-600 hover:text-gray-900 text-4xl font-bold">&times;</button>

            <h2 class="text-2xl font-bold mt-3 mb-4 text-center text-black">Leave the waitlist for  {{ $job->position }}?</h2>

            {{--            <div class="mb-6 text-[#000000]-700">--}}
            {{--                <p><strong>Salary:</strong> €{{ $job->salary }}</p>--}}
            {{--                <p><strong>Length:</strong> {{ $job->length }} months</p>--}}
            {{--                <p><strong>Hours:</strong> {{ $job->hours }} p/w</p>--}}
            {{--                <p><strong>Type:</strong> {{ $job->type }}</p>--}}
            {{--            </div>--}}

            <div class="grid grid-cols-2 gap-4 text-[1.1rem] bg-mosslight py-3 pl-12">
                <p><span class="font-black pr-2">Salary:</span> €{{ $job->salary }}</p>
                <p><span class="font-black pr-2">Length:</span> {{ $job->length }}</p>
                <p><span class="font-black pr-2">Job:</span> {{ $job->position }}</p>
                <p><span class="font-black pr-2">Hours:</span> {{ $job->hours }}</p>
                <p><span class="font-black pr-2">Type:</span> {{ $job->type }}</p>
                <p><span class="font-black pr-2">Avg.(€):</span> €{{ $job->avg_salary }}</p>
            </div>

            <div class="flex justify-between mt-4 h-10">
                <!-- Ja knop -->
                <form action="{{ route('job.leaveWaitlist', $job->id) }}" method="POST" class="h-full">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-green text-white h-full px-6 rounded hover:bg-mossdark">Yes, leave the waitlist</button>
                </form>

                <!-- Nee knop -->
                <button onclick="closeLeaveModal()"
                        class="text-white bg-violet leading-none rounded h-full px-6 hover:bg- violet">No</button>
            </div>
        </div>
    </div>


    <script>
        // Open the Join Modal
        function openJoinModal() {
            document.getElementById('confirmationModal').classList.remove('hidden');
        }

        // Close the Join Modal
        function closeJoinModal() {
            document.getElementById('confirmationModal').classList.add('hidden');
        }

        // Open the Leave Modal
        function openLeaveModal() {
            document.getElementById('leaveModal').classList.remove('hidden');
        }

        // Close the Leave Modal
        function closeLeaveModal() {
            document.getElementById('leaveModal').classList.add('hidden');
        }
    </script>



</div>
<x-footer-layout></x-footer-layout>
