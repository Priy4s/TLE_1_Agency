@extends('layouts.app')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body class="bg-gray-50 text-gray-700">

    <x-navbar-layout></x-navbar-layout>

    <div class="flex flex-col items-center justify-center min-h-screen px-4 py-8">
        @if (Auth::check())
            <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
                @if (Auth::user()->company && Auth::user()->company->image)
                    <div class="flex justify-center mb-4">
                        <img src="{{ asset('storage/' . Auth::user()->company->image) }}" alt="Company Picture"
                            class="w-32 h-32 rounded-full object-cover">
                    </div>
                @endif
                <h1 class="text-2xl font-bold text-gray-900 text-center mb-4">
                    {{ Auth::user()->name ?? Auth::user()->username }}
                </h1>
                <p class="text-gray-600 text-sm text-center mb-6">
                    Email: <span class="font-medium">{{ Auth::user()->email }}</span>
                </p>

                @if (Auth::user()->company_id)
                    <div class="text-center">
                        <h2 class="text-lg font-semibold text-green-600 mb-2">
                            Company: {{ Auth::user()->company->name }}
                        </h2>
                    </div>
                    <div class="mt-6">
                        <form action="{{ route('company.addMember') }}" method="POST"
                            class="flex flex-col items-center">
                            @csrf
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Add Member by
                                Email:</label>
                            <input type="email" name="email" id="email" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300 mb-4">
                            <button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                Add Member
                            </button>
                        </form>
                    </div>
                @else
                    <p class="text-center text-red-500 mb-4">
                        You don't have a company yet.
                    </p>
                    <div class="text-center">
                        <a href="{{ route('company.create') }}" class="text-blue-500 hover:underline">
                            Create a company
                        </a>
                    </div>
                @endif

                <p class="text-sm text-gray-500 text-center mt-4">
                    Joined on {{ Auth::user()->created_at->format('d M Y') }}
                </p>
            </div>
        @else
            <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-sm text-center">
                <p class="text-red-500 font-medium mb-4">
                    Please Login to see your profile.
                </p>
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline">
                    Login Here
                </a>
            </div>
        @endif
    </div>

    <x-footer-layout></x-footer-layout>

</body>

</html>
