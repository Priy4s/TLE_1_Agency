<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Open Hiring</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans bg-gray-50">
<!-- Navbar -->
<x-navbar-layout></x-navbar-layout>

<!-- Header -->
<header class="bg-green-100 py-10 text-center">
    <div class="container mx-auto">
        <img src="{{ asset('images/openhiring.webp') }}" alt="Open Hiring Logo" class="mx-auto h-16">
        <h1 class="text-2xl font-bold text-gray-800 mt-4">Work wherever you want</h1>
        <p class="mt-4 text-gray-600">
            Open Hiring geeft iedereen een eerlijke kans op werk. Geen sollicitatie, geen vragen—gewoon starten met één druk op de knop.
            Niet je diploma, maar jouw inzet telt!
        </p>
        <a href="#" class="mt-6 inline-block bg-pink-700 text-white font-bold py-2 px-6 rounded-full uppercase hover:bg-pink-800">
            View Job Openings
        </a>
    </div>
</header>

<!-- How it works -->
<section class="py-12">
    <div class="container mx-auto text-center">
        <h2 class="text-2xl font-bold mb-8 text-gray-800">How it works</h2>

        <!-- Step 1 -->
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
    </div>
</section>

<!-- Footer -->
<x-footer-layout></x-footer-layout>

<!-- Tailwind JS -->
<script src="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.0/dist/tailwind.min.js"></script>
</body>
</html>
