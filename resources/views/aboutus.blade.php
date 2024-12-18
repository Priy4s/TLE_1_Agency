@extends('layouts.app')
<!-- Navbar -->
<x-navbar-layout></x-navbar-layout>

<body>
<!-- Header met navigatie -->
<header class="bg-light py-3 w-[90%] mx-[5%]">
    <div class="container d-flex justify-content-between align-items-center">
        <img src="{{ asset('images/about.webp') }}" alt="Logo" height="40">
    </div>
</header>

<!-- About Us Sectie -->
<section class="container py-5 w-[90%] mx-[5%]">
    <div class="row align-items-left">
        <div class="col-12 text-left mb-4">
            <h1 class="font-bold text-3xl">Everyone can join</h1>
            <p class="mx-1 mb-8">
                Everyone deserves a fair chance at a job. That’s what Open Hiring is all about. It’s not about whether someone has a diploma, a smooth talk, or loads of experience it’s about whether they want to work and are able to do so. Companies hiring through Open Hiring don’t conduct job interviews, eliminating biases from the process. Job seekers decide for themselves if they are suitable for a position. This way, we make the job market fairer and help people get back to work quickly.
            </p>
        </div>
    </div>

    <!-- Principes Sectie -->
    <div class="text-center">
        <h2 class="font-bold mb-4 text-3xl text-left">3 Principles: What does Open Hiring believe in?</h2>
        <div class="row g-4">
            <!-- Principes 1 -->
            <div class="col-md-4 mb-8">
                <div class="flex items-center justify-center  gap-3">
                    <h3 class="font-bold text-8xl text-success text-mossmedium w-[15%]">1</h3>
                    <h5 class="text-xl text-left font-bold w-[60%]">It works better without prejudgments</h5>
                </div>

                <p class="text-left text-lg text-black mx-5">Opportunities are given based on motivation, not background. This creates a fair and inclusive job market.</p>
            </div>
            <!-- Principes 2 -->
            <div class="col-md-4 mb-8">
                <div class="flex items-center justify-center  gap-3">
                    <h3 class="font-bold text-8xl text-success text-mossmedium w-[15%]">2</h3>
                    <h5 class="text-xl text-left font-bold w-[60%]">We trust each other</h5>
                </div>

                <p class="text-left text-lg text-black mx-5">Trusting job seekers helps organizations become more resilient, inclusive, and diverse.</p>
            </div>
            <!-- Principes 3 -->
            <div class="col-md-4 mb-8">
                <div class="flex items-center justify-center  gap-3">
                    <h3 class="font-bold text-8xl text-success text-mossmedium w-[15%]">3</h3>
                    <h5 class="text-xl text-left font-bold w-[60%]">Growth happens together</h5>
                </div>

                <p class="text-left text-lg text-black mx-5">By creating an environment of support and learning, we grow stronger as a team.</p>
            </div>
        </div>
    </div>
</section>
</body>

<!-- Footer -->
<x-footer-layout></x-footer-layout>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
