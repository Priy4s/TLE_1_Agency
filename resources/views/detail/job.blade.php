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
            alt="{{ $job->position }}"
            class="w-full h-48 object-cover rounded-lg">
        <h1 class="text-3xl font-semibold text-gray-800 mt-4">{{ $job->position }}</h1>
        <p class="text-gray-600 mt-2"><strong>Location:</strong> Rotterdam</p>
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
        <!-- Button to Open Modal -->
        <button
            onclick="openModal()"
            class="cta-button bg-[#E2ECC8] hover:bg-[#D1E0A9] text-[#2E342A] py-3 px-6 rounded-lg font-semibold shadow-md">
            Join the waiting list
        </button>
    </div>

    <div class="text-center">
        <a href="{{ route('job_listings.index') }}">
            <button class="cta-button bg-[#7C1A51] hover:bg-[#7C1A51] text-[#FFFFFF] py-3 px-6 rounded-lg font-semibold shadow-md">
                Back to Joblistings
            </button>
        </a>
    </div>
</div>

<!-- Modal -->
<div id="confirmationModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-[#91AA83] rounded-lg shadow-lg p-6 w-96 relative">
        <!-- Grote Sluitknop -->
        <button
            onclick="closeModal()"
            class="absolute top-2 right-2 text-gray-600 hover:text-gray-900 text-4xl font-bold">
            &times;
        </button>

        <!-- Modal Content -->
        <h2 class="text-xl font-bold mb-4 text-center">Join the waiting list for {{ $job->position }}</h2>
        <div class="mb-6 text-[#000000]-700">
            <p><strong>Salary:</strong> €{{ $job->salary }}</p>
            <p><strong>Length:</strong> {{ $job->length }} months</p>
            <p><strong>Hours:</strong> {{ $job->hours }} p/w</p>
            <p><strong>Type:</strong> {{ $job->type }}</p>
        </div>

        <!-- Actieknoppen -->
        <div class="flex justify-between mt-4">

            <!-- Ja knop -->
            <form action="{{ route('job.joinWaitlist', $job->id) }}" method="POST">
                @csrf
                <button
                    type="submit"
                    style="background-color: #AA0160;"
                    class="hover:opacity-90 text-white py-2 px-4 rounded focus:outline-none">
                    Yes, join the waitlist
                </button>

            <!-- Nee knop -->
            <button
                onclick="closeModal()"
                class="bg-white hover:bg-gray-200 text-black py-2 px-4 rounded border border-black focus:outline-none">
                No
            </button>

            </form>
        </div>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('confirmationModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('confirmationModal').classList.add('hidden');
    }
</script>
