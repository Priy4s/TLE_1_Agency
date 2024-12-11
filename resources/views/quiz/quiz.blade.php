@extends('layouts.app')

    <x-navbar-layout></x-navbar-layout>

    <img class="rounded-full" src="{{ asset('images/quiz-worker.jpg') }}">

    <h1 class="text-4xl font-semibold mb-8 mt-10 text-center font-radical">Discover You Talent</h1>

    <div class="w-auto bg-gray-300 rounded-full h-6 mb-6 mx-8">
        <div class="bg-violet h-6 rounded-full" style="width: {{ $progress }}%;"></div>
    </div>

    <h3 class="text-xl leading-none text-gray-800 ml-8 mr-8">Question {{ $questionIndex + 1 }}</h3>
    <h2 class="text-[1.65rem] leading-tight font-semibold text-black mx-8 mb-5">{{ $currentQuestion->question }}</h2>

    <form action="{{ route('quiz.save', ['questionIndex' => $questionIndex]) }}" method="POST" class="mx-8">
        @csrf
        <input type="hidden" name="question_id" value="{{ $currentQuestion->id }}">
        @foreach ($currentQuestion->options as $option)
            <label class="flex items-start text-[1.4rem] font-medium text-gray-900 mb-5">
                <input type="radio" name="answer" value="{{ $option->id }}" class="h-6 w-6 outline-violet text-violet bg-gray-400 border-none mr-3 ">
                <span class="leading-[1.8rem]">{{ $option->option }}</span>
            </label>
        @endforeach
        <div class="flex justify-between items-center gap-2 my-5">
{{--        @if ($previousQuestionIndex !== null)--}}
{{--            <a  class="text-white font-semibold bg-violet rounded-2xl py-3 px-6 w-full">--}}
{{--                Back--}}
{{--            </a>--}}
{{--        @endif--}}

            <button type="submit" class="bg-violet text-white font-semibold rounded-2xl py-3 px-6 w-full border-b-4 border-darkviolet hover:bg-darkviolet active:bg-violet border-b-2-2">
                {{ $questionIndex + 1 < count($questions) ? 'Next' : 'See results' }}
            </button>
        </div>
        </form>


<x-footer-layout></x-footer-layout>
