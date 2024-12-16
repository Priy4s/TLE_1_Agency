@extends('layouts.app')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Company Profile</title>
</head>

<body>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
        @if (Auth::check())
            <h1>{{ Auth::user()->name }}</h1>
            <p>Email: {{ Auth::user()->email }}</p>
            @if (Auth::user()->company)
                <p>Company: {{ Auth::user()->company->name }}</p>
            @else
                <p class="text-red-500">You don't have a company yet.</p>
                <a href="{{ route('company.create') }}" class="text-blue-500">Create a company</a>
            @endif
            <p>Joined: {{ Auth::user()->created_at->format('d M Y') }}</p>
        @else
            <p class="text-red-500">Please Login to see your profile. </p>
        @endif
    </div>
</body>

</html>
