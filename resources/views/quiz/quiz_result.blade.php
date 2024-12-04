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
        <h2>Your Results</h2>
        <div>
            <p>Leader: {{ number_format($stylePercentages['Leader'], 2) }}%</p>
            <p>Supporter: {{ number_format($stylePercentages['Supporter'], 2) }}%</p>
            <p>Organizer: {{ number_format($stylePercentages['Organizer'], 2) }}%</p>
            <p>Creative: {{ number_format($stylePercentages['Creative'], 2) }}%</p>
        </div>
    </div>
@endsection
</body>
</html>
