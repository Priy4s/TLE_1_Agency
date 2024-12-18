@extends('layouts.app')
<!-- Navbar -->
<x-navbar-layout></x-navbar-layout>

<body>
<!-- Header met navigatie -->
<header class="bg-light py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <img src="{{ asset('images/about.webp') }}" alt="Logo" height="40">
    </div>
</header>

<!-- About Us Sectie -->
<section class="container py-5">
    <div class="row align-items-center">
        <div class="col-12 text-center mb-4">
            <h1 class="fw-bold">Everyone can join</h1>
            <p>
                Everyone deserves a fair chance at a job. That’s what Open Hiring is all about. It’s not about whether someone has a diploma, a smooth talk, or loads of experience it’s about whether they want to work and are able to do so. Companies hiring through Open Hiring don’t conduct job interviews, eliminating biases from the process. Job seekers decide for themselves if they are suitable for a position. This way, we make the job market fairer and help people get back to work quickly.
            </p>
        </div>
    </div>

    <!-- Principes Sectie -->
    <div class="text-center">
        <h2 class="fw-bold mb-4">3 Principles: What does Open Hiring believe in?</h2>
        <div class="row g-4">
            <!-- Principes 1 -->
            <div class="col-md-4">
                <h3 class="fw-bold text-success">1</h3>
                <h5>It works better without prejudgments</h5>
                <p>Opportunities are given based on motivation, not background. This creates a fair and inclusive job market.</p>
            </div>
            <!-- Principes 2 -->
            <div class="col-md-4">
                <h3 class="fw-bold text-success">2</h3>
                <h5>We trust each other</h5>
                <p>Trusting job seekers helps organizations become more resilient, inclusive, and diverse.</p>
            </div>
            <!-- Principes 3 -->
            <div class="col-md-4">
                <h3 class="fw-bold text-success">3</h3>
                <h5>Growth happens together</h5>
                <p>By creating an environment of support and learning, we grow stronger as a team.</p>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<x-footer-layout></x-footer-layout>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
