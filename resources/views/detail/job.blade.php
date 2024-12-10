@extends('layouts.app')
<div class="bg-[#FBFCF6] text-[#2E342A] min-h-screen p-4">
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
    <div class="job-header bg-white shadow-md rounded-lg p-6 mb-6">
        <img
            src="{{ asset('images/post_nl.jpg') }}"
            alt="{{ $job->posistion }}"
            class="w-full h-48 object-cover rounded-lg">
        <h1 class="text-3xl font-semibold text-gray-800 mt-4">{{ $job->posistion }}</h1>
        <h2 class="job-type text-lg text-purple-600 font-medium">{{ $job->position }}</h2>
        <p class="text-gray-600 mt-2"><strong>Location:</strong> Rotterdam</p>
        <!-- Display the count of people on the waitlist -->
        <p class="text-gray-600 mt-2"><strong>Waiting List Size:</strong> {{ $waitlistCount }} people</p>
    </div>

    <!-- Job Details -->
    <div class="job-details bg-white shadow-md rounded-lg p-6 mb-6">
        <h3 class="text-2xl font-bold text-gray-800 mb-4">Job Details</h3>
        <div class="grid grid-cols-2 gap-4 text-gray-700">
            <p><strong>Salary:</strong> € {{ $job->salary }}</p>
            <p><strong>Job:</strong> {{ $job->position }}</p>
            <p><strong>Type:</strong> {{ $job->type }}</p>
            <p><strong>Length:</strong> {{ $job->length }}</p>
            <p><strong>Hours:</strong> {{ $job->hours }}</p>
            <p><strong>Avg. Salary:</strong> € {{ $job->avg_salary }}</p>
        </div>
    </div>

    <!-- Job Information -->
    <div class="job-info bg-white shadow-md rounded-lg p-6 mb-6">
        <h3 class="text-2xl font-bold text-gray-800 mb-4">Job Information</h3>
        <p class="text-gray-700">{{ $job->description }}</p>
    </div>

    <!-- Call to Action Buttons -->
    <div class="text-center mb-4">
        <!-- Join the Waitlist Form -->
        <form action="{{ route('job.joinWaitlist', $job->id) }}" method="POST">
            @csrf
            <button type="submit" class="cta-button bg-[#E2ECC8] hover:bg-[#D1E0A9] text-[#2E342A] py-3 px-6 rounded-lg font-semibold shadow-md">
                Join the waiting list
            </button>
        </form>
    </div>

    <div class="text-center">
        <a href="{{ route('job_listings.index') }}">
            <button class="cta-button bg-[#7C1A51] hover:bg-[#7C1A51] text-[#FFFFFF] py-3 px-6 rounded-lg font-semibold shadow-md">
                Back to Joblistings
            </button>
        </a>
    </div>

</div>
