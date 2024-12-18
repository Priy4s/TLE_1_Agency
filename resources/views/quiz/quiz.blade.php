@extends('layouts.app')

<x-navbar-layout></x-navbar-layout>

<img class="w-[90%] mx-[5%]" src="{{ asset('images/quiz-worker.jpg') }}" alt="A woman sitting at a desk">

<h1 class="text-4xl font-semibold mb-8 mt-10 text-center font-radical">Discover Your Talent</h1>

<div class="w-auto bg-gray-300 rounded-full h-6 mb-6 mx-8">
    <div class="bg-violet h-6 rounded-full" style="width: {{ $progress }}%;"></div>
</div>

<h3 class="text-xl leading-none text-gray-800 ml-8 mr-8">
    <span
        class="speaker-icon"
        aria-label="Click to hear the question and options"
        role="button"
        tabindex="0"
        data-text="Question {{ $questionIndex + 1 }}. {{ $currentQuestion->question }}. 1, {{ $currentQuestion->options->get(0)->option }}. 2, {{ $currentQuestion->options->get(1)->option }}. 3, {{ $currentQuestion->options->get(2)->option }}. 4, {{ $currentQuestion->options->get(3)->option }}">
    </span>
    Question {{ $questionIndex + 1 }}
</h3>

<h2 class="text-[1.65rem] leading-tight font-semibold text-black mx-8 mb-5">{{ $currentQuestion->question }}</h2>

<form action="{{ route('quiz.save', ['questionIndex' => $questionIndex]) }}" method="POST" class="mx-8">
    @csrf
    <input type="hidden" name="question_id" value="{{ $currentQuestion->id }}">

    @foreach ($currentQuestion->options as $index => $option)
        <label class="flex items-center text-[1.4rem] font-medium text-gray-900 mb-5 cursor-pointer" for="option-{{ $option->id }}">
            <input type="radio" name="answer" value="{{ $option->id }}" class="h-6 w-6 outline-violet text-violet bg-gray-400 border-none mr-3" tabindex="{{ $index + 1 }}" id="option-{{ $option->id }}">
            <span class="leading-[1.8rem]">{{ $option->option }}</span>
        </label>
    @endforeach

    <div class="flex justify-between items-center gap-2 my-5">
        <button type="submit" class="bg-violet text-white font-semibold rounded-2xl py-3 px-6 w-full border-b-4 border-darkviolet hover:bg-darkviolet active:bg-violet" tabindex="{{ count($currentQuestion->options) + 1 }}">
            {{ $questionIndex + 1 < count($questions) ? 'Next' : 'See results' }}
        </button>
    </div>
</form>

<x-footer-layout></x-footer-layout>
