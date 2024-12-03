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
<form method="POST" action="{{ route('quiz.save', ['questionIndex' => $questionIndex]) }}">
    @csrf
    <div class="question">
        <h2>{{ $currentQuestion->question }}</h2>

        @foreach($currentQuestion->options as $option)
            <div>
                <input type="radio" id="option_{{ $option->id }}" name="answer" value="{{ $option->id }}" required>
                <label for="option_{{ $option->id }}">{{ $option->option_text }}</label>
            </div>
        @endforeach
    </div>

    <button type="submit">Next</button>
</form>

</body>
</html>
