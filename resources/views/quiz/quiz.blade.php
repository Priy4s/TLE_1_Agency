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

    <h1>Question {{ $questionIndex + 1 }}</h1>
    <p>{{ $currentQuestion->question }}</p>

    <form action="{{ route('quiz.save', ['questionIndex' => $questionIndex]) }}" method="POST">
        @csrf
            <input type="hidden" name="question_id" value="{{ $currentQuestion->id }}">
            @foreach ($currentQuestion->options as $option)
                <label>
                    <input type="radio" name="answer" value="{{ $option->id }}"> {{ $option->option }}
                </label><br>
            @endforeach

            <button type="submit">
                {{ $questionIndex + 1 < count($questions) ? 'Next' : 'See results' }}
            </button>
        </form>


{{--    <form action="{{ route('quiz.save', $questionIndex) }}" method="POST">--}}
{{--        @csrf--}}
{{--        <input type="hidden" name="question_id" value="{{ $currentQuestion->id }}">--}}
{{--        @foreach ($currentQuestion->options as $option)--}}
{{--            <label>--}}
{{--                <input type="radio" name="answer" value="{{ $option->id }}"> {{ $option->option }}--}}
{{--            </label><br>--}}
{{--        @endforeach--}}

{{--        <button type="submit">--}}
{{--            {{ $questionIndex + 1 < count($questions) ? 'Next' : 'See results' }}--}}
{{--        </button>--}}
{{--    </form>--}}


</body>
</html>
