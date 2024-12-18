@extends('layouts.app')
<!-- Navbar -->
<x-navbar-layout></x-navbar-layout>

<!-- Header -->
<header class="bg-green-100 py-7 text-center mx-[5%] w-[90%]">
    <div class="container mx-auto">
        <img
            src="{{ asset('images/open.webp') }}"
            alt="Open Hiring Logo"
            class="object-contain ">


        <p class="text-3xl text-black mt-7 font-bold">Work wherever you want</h1>
        <p class="mt-4 text-black text-left pl-3">
            Open Hiring gives everyone a fair chance at employment. No applications, no questions—just start with the press of a button. It's not your diploma, but your commitment that counts!
        </p>
        <a href="{{ route('job_listings.index') }}" class="mt-6 inline-block bg-violet text-white font-bold py-2 px-6 rounded-lg text-xl hover:bg- via- violet">
            View Job Openings
        </a>
    </div>
</header>

<!-- How it works -->
<section class="py-12 w-[90%] mx-[5%]">
    <p class="text-3xl text-black mb-6 font-bold text-center">How it works</p>

    <div class="list-decimal flex flex-col justify-center space-y-2 text-black gap-4">
        <p class="text-lg leading-tight bg-mosslight border-b-4 border-r-4 border-mossmedium rounded-[16px] py-4 px-12 flex items-center pb-[-5px] text-left">
            <span class="font-bold text-7xl mr-4 pb-[5px]">1</span> Direct response. No job interviews, questions, or (pre)judgments. A fair chance..
        </p>
        <p class="text-lg leading-tight bg-mosslight border-b-4 border-r-4 border-mossmedium rounded-[16px] py-4 px-12 flex items-center pb-[-5px] text-left leading-tight">
            <span class="font-bold text-7xl mr-4 pb-[5px]">2</span> You decide if you can do it.
        </p>
        <p class="text-lg leading-tight bg-mosslight border-b-4 border-r-4 border-mossmedium rounded-[16px] py-4 px-12 flex items-center pb-[-5px] text-left">
            <span class="font-bold text-7xl mr-4 pb-[5px]">3</span> Start quickly. With a regular contract, paid from day one.
        </p>
    </div>

</section>

<!-- Footer -->
<x-footer-layout></x-footer-layout>

<!-- Tailwind JS -->
<script src="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.0/dist/tailwind.min.js"></script>

