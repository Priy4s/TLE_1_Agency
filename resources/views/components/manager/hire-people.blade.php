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

            <!-- "Hire" Button with Dropdown (Weergegeven als er kandidaten zijn) -->
            @php
                $maxCandidates = min($waitlistUsers->where('status', 'waiting')->count(), 5); // Maximaal 5 of het aantal beschikbare kandidaten
            @endphp

                <!-- Dropdown Menu voor het selecteren van het aantal kandidaten -->
            @if($maxCandidates > 0)
                <div class="relative">
                    <button onclick="toggleDropdown()" class="bg-[#E2ECC8] hover:bg-[#D1E0A9] text-black text-lg py-3 px-6 rounded-lg font-semibold shadow-md transform transition duration-200 ease-in-out hover:scale-105 focus:outline-none">
                        Hire People
                    </button>

                    <!-- Dropdown (Modal) Menu -->
                    <div id="hire-dropdown" class="dropdown-content hidden fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 z-50">
                        <div class="bg-white shadow-lg rounded-lg p-6 w-96">
                            <form action="{{ route('job.confirmHire', $job->id) }}" method="POST" class="space-y-4">
                                @csrf
                                <input type="hidden" name="job_id" value="{{ $job->id }}">
                                <label for="num_candidates" class="text-lg font-medium text-gray-800 block">Select Number of Candidates:</label>
                                <select name="num_candidates" id="num_candidates" class="block w-full p-2 border rounded-lg">
                                    @for ($i = 1; $i <= $maxCandidates; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                <div class="flex justify-between gap-4 mt-4">
                                    <button type="button" onclick="toggleDropdown()" class="bg-[#7C1A51] hover:bg-[#681740] text-white py-2 px-4 rounded-lg">Cancel</button>
                                    <div class="flex gap-2">
                                        <button type="submit" class="bg-green-500 hover:bg-green-400 text-white py-2 px-4 rounded-lg">Confirm</button>
                                        <button type="button" onclick="showConfirmation()" class="bg-[#E2ECC8] hover:bg-[#D1E0A9] text-black py-2 px-4 rounded-lg">Hire</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

        </div>

        <!-- Wachtende Kandidaten -->
        <div class="waiting-candidates bg-white shadow-md rounded-lg p-6 mb-6">
            @if($waitlistUsers->where('status', 'waiting')->isEmpty())
                <p class="text-gray-500">No candidates waiting for hiring.</p>
            @else
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Waiting Candidates</h2>
                <table class="table-auto w-full">
                    <thead>
                    <tr class="bg-gray-100 text-gray-800">
                        <th class="px-4 py-2 text-left">Candidate</th>
                        <th class="px-4 py-2 text-left">Status</th>
                        <th class="px-4 py-2 text-left">Joined At</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($waitlistUsers->where('status', 'waiting') as $index => $waitlist)
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

        <!-- Hired Kandidaten -->
        <div class="hired-candidates bg-white shadow-md rounded-lg p-6">
            @if($waitlistUsers->where('status', 'hired')->isEmpty())
                <p class="text-gray-500">No hired candidates yet.</p>
            @else
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Hired Candidates</h2>
                <table class="table-auto w-full">
                    <thead>
                    <tr class="bg-gray-100 text-gray-800">
                        <th class="px-4 py-2 text-left">Candidate</th>
                        <th class="px-4 py-2 text-left">Status</th>
                        <th class="px-4 py-2 text-left">Message</th>
                        <th class="px-4 py-2 text-left">Process</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($waitlistUsers->where('status', 'hired') as $index => $waitlist)
                        <tr>
                            <td class="border px-4 py-2">
                                Candidate {{ $index + 1 }} - {{ $waitlist->user->username ?? 'Unknown' }}
                            </td>
                            <td class="border px-4 py-2">{{ $waitlist->status }}</td>
                            <td class="border px-4 py-2 text-center">
                                <button class="bg-[#E2ECC8] hover:bg-[#D1E0A9] text-black font-bold py-2 px-4 rounded shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-opacity-50 transition duration-300 inline-block">
                                    Message
                                </button>
                            </td>
                            <td class="border px-4 py-2 text-center">
                                <form action="{{ route('waitlist.updateProcess', $waitlist->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="process" onchange="this.form.submit()" class="w-48 p-2 border rounded-lg mt-4"> <!-- mt-2 toegevoegd -->
                                        <option value="Need to invite" {{ $waitlist->process === 'Need to invite' ? 'selected' : '' }}>Need to invite</option>
                                        <option value="Waiting for response" {{ $waitlist->process === 'Waiting for response' ? 'selected' : '' }}>Waiting for response</option>
                                        <option value="Done" {{ $waitlist->process === 'Done' ? 'selected' : '' }}>Done</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>

<!-- Bevestigings Popup -->
<div id="confirmation-popup" class="hidden fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 z-50">
    <div class="bg-white shadow-lg rounded-lg p-6 w-96">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Confirm Hiring</h2>
        <p id="confirmation-message" class="text-gray-700 mb-4">Are you sure you want to hire these candidate(s)?</p>
        <div class="flex justify-center gap-4">
            <button onclick="closeConfirmation()" class="bg-[#7C1A51] hover:bg-[#681740] text-white py-2 px-4 rounded-lg">Cancel</button>
            <button onclick="confirmHire()" class="bg-[#E2ECC8] hover:bg-[#D1E0A9] text-black py-2 px-4 rounded-lg">Confirm</button>
        </div>
    </div>
</div>

<script>
    // Function to toggle the visibility of the dropdown (popup)
    function toggleDropdown() {
        const dropdown = document.getElementById('hire-dropdown');
        dropdown.classList.toggle('hidden');
    }

    // Function to show the confirmation popup
    function showConfirmation() {
        const numCandidates = document.getElementById('num_candidates').value;
        const confirmationMessage = document.getElementById('confirmation-message');
        confirmationMessage.textContent = `Are you sure you want to hire ${numCandidates} candidate(s)?`;

        const confirmationPopup = document.getElementById('confirmation-popup');
        confirmationPopup.classList.remove('hidden');
    }

    // Function to close the confirmation popup
    function closeConfirmation() {
        const confirmationPopup = document.getElementById('confirmation-popup');
        confirmationPopup.classList.add('hidden');
    }

    // Function to handle the hire action after confirmation
    function confirmHire() {
        // Haal het formulier op en dien het in
        const form = document.querySelector('form');
        form.submit(); // Dit zorgt ervoor dat het formulier wordt ingediend
        closeConfirmation();  // Sluit de bevestigingspopup na bevestiging
    }
</script>
