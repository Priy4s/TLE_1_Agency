@extends('layouts.app')

<div class="bg-[#FBFCF6] text-[#2E342A] min-h-screen p-8">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-4xl font-semibold text-gray-800 mb-6">Hire People for {{ $job->position }}</h1>

        <p class="text-gray-700 text-xl mb-4">Select candidates for "{{ $job->position }}".</p>

        <!-- Knoppen boven de tabel -->
        <div class="flex justify-between gap-4 items-center mb-6">
            <a href="{{ route('job_listings.manage', $job->id) }}">
                <button class="cta-button bg-[#7C1A51] hover:bg-[#681740] text-[#FFFFFF] text-lg py-3 px-6 rounded-lg font-semibold shadow-md">
                    Back to Dashboard
                </button>
            </a>

            <!-- "Hire" Button with Dropdown -->
            <div class="relative">
                <button onclick="toggleDropdown()" class="bg-[#E2ECC8] hover:bg-[#D1E0A9] text-black text-lg py-3 px-6 rounded-lg font-semibold shadow-md transform transition duration-200 ease-in-out hover:scale-105 focus:outline-none">
                    Hire People
                </button>

                <!-- Dropdown (Modal) Menu -->
                <div id="hire-dropdown" class="dropdown-content hidden fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 z-50">
                    <div class="bg-white shadow-lg rounded-lg p-6 w-96">
                        <form action="" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="job_id" value="{{ $job->id }}">
                            <label for="num_candidates" class="text-lg font-medium text-gray-800 block">Select Number of Candidates:</label>
                            <select name="num_candidates" id="num_candidates" class="block w-full p-2 border rounded-lg">
                                @php
                                    $maxCandidates = min(count($waitlistUsers), 5); // Maximaal 5 of het aantal beschikbare kandidaten
                                @endphp
                                @for ($i = 1; $i <= $maxCandidates; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            <div class="flex justify-end gap-4">
                                <button type="button" onclick="toggleDropdown()" class="bg-gray-500 text-white py-2 px-4 rounded-lg">Cancel</button>
                                <div class="flex gap-2">
                                    <button type="submit" class="bg-green-500 hover:bg-green-400 text-white py-2 px-4 rounded-lg">Confirm</button>
                                    <button type="button" onclick="hireCandidates()" class="bg-blue-500 hover:bg-blue-400 text-white py-2 px-4 rounded-lg">Hire</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kandidaten lijst met nummering -->
        <div class="candidates bg-white shadow-md rounded-lg p-6">
            @if($waitlistUsers->isEmpty())
                <p class="text-gray-500">No candidates available.</p>
            @else
                <table class="table-auto w-full">
                    <thead>
                    <tr class="bg-gray-100 text-gray-800">
                        <th class="px-4 py-2 text-left">Candidate</th>
                        <th class="px-4 py-2 text-left">Status</th>
                        <th class="px-4 py-2 text-left">Joined At</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($waitlistUsers as $index => $waitlist)
                        <tr>
                            <td class="border px-4 py-2">Candidate {{ $index + 1 }}</td>
                            <td class="border px-4 py-2">{{ $waitlist->status }}</td>
                            <td class="border px-4 py-2">{{ $waitlist->created_at->format('d-m-Y H:i') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>

<script>
    // Function to toggle the visibility of the dropdown (popup)
    function toggleDropdown() {
        const dropdown = document.getElementById('hire-dropdown');
        dropdown.classList.toggle('hidden');
    }

    // Function to handle the hire action (optional customization)
    function hireCandidates() {
        // Add any custom logic for hiring here (e.g., submitting a form or updating data)
        alert("Candidates hired!");
    }
</script>