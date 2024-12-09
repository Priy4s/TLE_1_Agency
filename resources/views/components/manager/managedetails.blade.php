@extends('layouts.app')
<div class="bg-[#FBFCF6] text-[#2E342A] min-h-screen p-8">
    <!-- Main Container -->
    <div class="max-w-6xl mx-auto">
        <!-- Job Header -->
        <div class="job-header bg-white shadow-md rounded-lg p-6 mb-6 grid grid-cols-3 gap-6">
            <img
                src="{{ asset('images/post_nl.jpg') }}"
                alt="{{ $job->position }}"
                class="col-span-1 w-full h-48 object-cover rounded-lg">
            <div class="col-span-2">
                <h1 class="text-5xl font-semibold text-gray-800">{{ $job->position }}</h1>
                <h2 class="job-type text-3xl text-purple-600 font-medium">{{ $job->type }}</h2>
                <p class="text-gray-600 text-xl mt-4"><strong>Location:</strong> Rotterdam</p>
            </div>
        </div>

        <!-- Job Details -->
        <div class="job-details bg-white shadow-md rounded-lg p-6 mb-6">
            <h3 class="text-4xl font-bold text-gray-800 mb-4">Job Details</h3>
            <div class="grid grid-cols-2 gap-4 text-gray-700 text-xl">
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
            <h3 class="text-4xl font-bold text-gray-800 mb-4">Job Information</h3>
            <p class="text-gray-700 text-xl">{{ $job->description }}</p>
        </div>

        <!-- Call to Action Buttons -->
        <div class="text-center flex justify-between gap-4">
            <a href="{{ route('manager.dashboard') }}">
            <button class="cta-button bg-[#7C1A51] hover:bg-[#681740] text-[#FFFFFF] text-lg py-3 px-6 rounded-lg font-semibold shadow-md">
                Back to Dashboard
            </button>
            </a>
                <button class="cta-button bg-[#E2ECC8] hover:bg-[#D1E0A9] text-[#2E342A] text-lg py-3 px-6 rounded-lg font-semibold shadow-md">
                    Hire people
                </button>
        </div>
    </div>
</div>
