@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="max-w-md w-full bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-xl font-bold text-gray-800">Open Hiring</h1>
                <div class="text-yellow-500 font-bold">✅</div>
            </div>

            <h2 class="text-2xl font-semibold text-green-600 mb-4">{{ $user['status'] }}</h2>

            <p class="text-gray-700 mb-6">Hi {{ $user['name'] }},</p>
            <p class="text-gray-700 mb-6">You have successfully signed up for the waiting list. Here's what will happen next:</p>

            <ol class="list-decimal pl-5 space-y-2 text-gray-800">
                <li>It can take some time.</li>
                <li>If you're number 1, the employer will email you about your start date.</li>
                <li>Start working!</li>
            </ol>

            <a href="{{ route('job.listings') }}" class="block mt-6 bg-green-600 text-white text-center py-2 rounded-lg hover:bg-green-700">
                My Job Listings
            </a>
        </div>
    </div>
@endsection
