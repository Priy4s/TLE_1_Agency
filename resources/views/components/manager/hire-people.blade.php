@extends('layouts.app')

@section('content')
    <div class="bg-[#FBFCF6] text-[#2E342A] min-h-screen p-8">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-4xl font-semibold text-gray-800 mb-6">Hire People for {{ $job->position }}</h1>

            <p class="text-gray-700 text-xl mb-4">Hier kun je kandidaten selecteren om aan te nemen voor de functie "{{ $job->position }}".</p>

            <!-- Logica om kandidaten te tonen of filters toe te voegen -->
            <div class="candidates bg-white shadow-md rounded-lg p-6">
                <p class="text-gray-500">Er zijn op dit moment geen kandidaten beschikbaar.</p>
            </div>

            <div class="mt-6 text-center">
                <a href="{{ route('manager.dashboard') }}" class="bg-[#7C1A51] hover:bg-[#681740] text-white py-2 px-4 rounded-lg">
                    Terug naar Dashboard
                </a>
            </div>
        </div>
    </div>
@endsection
