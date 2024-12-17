@extends('layouts.app')

<x-navbar-layout></x-navbar-layout>

<div class="max-w-md w-full bg-white rounded-lg shadow-lg p-6 sm:p-8 md:max-w-2xl lg:max-w-3xl">
    <!-- Welkomstsectie -->
    <div class="text-center mb-6">
        <span
            class="speaker-icon inline-block mb-2 cursor-pointer"
            aria-label="Click to hear what's next after signing up"
            role="button"
            tabindex="0"
            data-text="Congratulations! You're One Step Closer! You're now on the waiting list and closer than ever to your next job opportunity. Stay tuned!">
        </span>

        <div>
            <div class="flex justify-center gap-2">
                <img src="{{ asset('images/check.png') }}" alt="Check" class="w-9 h-9">
                <h1 class="text-4xl font-bold sm:text-4xl text-black">
                    Congratulation!
                </h1>
            </div>
            <h1 class="text-4xl font-bold sm:text-4xl text-black">You're One Step Closer!</h1>
        </div>

        <p class="text-lg text-black mt-2 mx-5">You're now on the waiting list and closer than ever to your next job opportunity. Stay tuned!</p>
    </div>

    <hr class="border-green border-[0.1rem] my-12 mx-10">

    <!-- Statusbericht -->
    {{--        <div class="flex items-center justify-start mb-4 space-x-2">--}}
    {{--            <div class="text-yellow-500 font-bold text-xl">✅</div>--}}
    {{--            <h2 class="text-xl sm:text-2xl font-semibold text-green-600">You're on the waiting list!</h2>--}}
    {{--        </div>--}}

    <!-- Centered Speaker Icon for Steps -->
    <div class="flex justify-center items-center mb-4">
        <span
            class="speaker-icon inline-block cursor-pointer"
            aria-label="Click to hear the steps for what happens next"
            role="button"
            tabindex="0"
            data-text="Here's what happens next. 1, It can take some time. 2, If you're number 1, the employer will message you about your start date. 3, Start working!">
        </span>
    </div>

    <!-- Informatie over de volgende stappen -->
    <p class="text-2xl text-black mb-6 font-bold text-center">Here's what happens next:</p>

    <div class="list-decimal flex flex-col justify-center space-y-2 text-black gap-4">
        <p class="text-lg bg-mosslight border-b-4 border-r-4 border-mossmedium rounded-[16px] py-4 px-12 flex items-center pb-[-5px] text-left">
            <span class="font-bold text-7xl mr-4 pb-[5px]">1</span> It can take some time.
        </p>
        <p class="text-lg bg-mosslight border-b-4 border-r-4 border-mossmedium rounded-[16px] py-4 px-12 flex items-center pb-[-5px] text-left leading-tight">
            <span class="font-bold text-7xl mr-4 pb-[5px]">2</span> If you're number 1, the employer will message you about your start date.
        </p>
        <p class="text-lg bg-mosslight border-b-4 border-r-4 border-mossmedium rounded-[16px] py-4 px-12 flex items-center pb-[-5px] text-left">
            <span class="font-bold text-7xl mr-4 pb-[5px]">3</span> Start working!
        </p>
    </div>

    <!-- Call-to-action button -->
    <a href="{{ route('job_listings.my') }}" class="block mt-8 bg-[#AA0160] text-white text-center py-3 rounded-lg shadow-md hover:bg-[#7A0040] transition ease-in-out duration-300">
        View My Job Listings
    </a>
</div>

<x-footer-layout></x-footer-layout>
