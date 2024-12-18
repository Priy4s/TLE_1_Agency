<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<!-- Header met navigatie -->
<header class="bg-light py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" height="40">
        <button class="btn btn-dark">Menu</button>
    </div>
</header>

<!-- About Us Sectie -->
<section class="container py-5">
    <div class="row align-items-center">
        <div class="col-12 text-center mb-4">
            <h1 class="fw-bold">Everyone can join</h1>
            <p>
                Everyone deserves a fair chance at a job. Open Hiring is about focusing on potential,
                not judgment. It helps companies and job seekers to connect in an honest and inclusive way.
            </p>
        </div>
        <div class="col-12">
            <img src="{{ asset('images/about-us.jpg') }}" alt="Team Image" class="img-fluid mb-4 rounded">
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
<footer class="bg-dark text-white py-4">
    <div class="container text-center">
        <p>For Job Seekers | For Employers</p>
        <p>About Open Hiring | Privacy Policy</p>
        <div>
            <a href="#" class="text-white me-2">LinkedIn</a>
            <a href="#" class="text-white me-2">Facebook</a>
            <a href="#" class="text-white">Instagram</a>
        </div>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
