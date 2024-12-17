@extends('layouts.app')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Company Profile</title>
</head>

<body class="bg-gray-50 text-gray-700">

    <x-navbar-layout></x-navbar-layout>

    <div class="flex flex-col items-center justify-center min-h-screen px-4 py-8">
        @if (Auth::check())
            <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
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
