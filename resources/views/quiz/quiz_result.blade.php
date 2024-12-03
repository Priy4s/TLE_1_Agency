<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Your Work Style Results</h1>
        <div class="result">
            @foreach ($stylePercentages as $style => $percentage)
                <div class="result-item">
                    <h3>{{ $style }}</h3>
                    <p>{{ round($percentage, 2) }}% fit with this style</p>
                    <div class="progress-bar" style="width: {{ $percentage }}%"></div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
</body>
</html>
