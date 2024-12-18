@extends('layouts.app')

<style>
    .animated-bg {
        position: relative;
        width: 100%;
        height: 17rem;
        overflow: hidden;
        border-radius: 16px;
    }

    .animated-bg canvas {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
        background-color: #e7efe1;
    }

    .animated-bg-content {
        position: relative;
        z-index: 1;
        padding: 1rem;
    }
</style>

<div class="text-black min-h-screen p-4">
    <x-navbar-layout></x-navbar-layout>

    <!-- Heading -->
    <h1 class="text-4xl font-semibold text-center mb-6">My Job Listings
        <span
            class="speaker-icon"
            aria-label="Click to hear the header"
            role="button"
            tabindex="0"
            data-text="My job listings">
        </span>
    </h1>

    <div class="flex justify-center space-x-4">
        <button id="filter-all" class="filter-button bg-[#39462F] text-white py-2 px-6 rounded-lg hover:bg-[#1B1F19] transition font-bold">
            Show All
        </button>
        <button id="filter-hired" class="filter-button bg-[#39462F] text-white py-2 px-6 rounded-lg hover:bg-[#1B1F19] transition font-bold">
            Selected
        </button>
        <button id="filter-open" class="filter-button bg-[#39462F] text-white py-2 px-6 rounded-lg hover:bg-[#1B1F19] transition font-bold">
            Still Open
        </button>
    </div>

    <hr class="border-green border-[0.1rem] m-10">

    <!-- Job Listings -->
    <div class="space-y-6">
        @foreach ($jobListings as $waitlist)
            @if ($waitlist->status === 'selected')
                <div class="animated-bg p-6 rounded-[16px] border-2 border-green shadow-lg max-w-[22rem] mx-auto relative">
                    <canvas class="bg-animation"></canvas>

                    <!-- Speaker Icon Positioned in Top Right -->
                    <span
                        class="speaker-icon absolute top-2 right-2 cursor-pointer"
                        aria-label="Click to hear the status of this job listing"
                        role="button"
                        tabindex="0"
                        data-text="You’ve been selected for {{ $waitlist->job->position }} - {{ $waitlist->job->company->name ?? 'No company available' }}! The employer will message you to agree on a starting date!">
                    </span>

                    <div class="animated-bg-content">
                        <h3 class="text-2xl font-bold text-black text-center mb-4">
                            You’ve been selected!🎉
                        </h3>
                        <p class="text-center font-semibold text-black mb-2 text-xl">
                            {{ $waitlist->job->position }} - {{ $waitlist->job->company->name ?? 'No company available' }}
                        </p>
                        <p class="text-center text-black font-bold">
                            The employer will message you to agree on a starting date!
                        </p>
                    </div>
                </div>

            @else
                <div class="bg-white shadow-md rounded-[16px] p-4 w-[90%] mx-[5%] border-2 border-green relative">

                    <!-- Speaker Icon Positioned in Top Right -->
                    <span
                        class="speaker-icon absolute top-2 right-2 cursor-pointer"
                        aria-label="Click to hear the status of this job listing"
                        role="button"
                        tabindex="0"
                        data-text="{{ $waitlist->job->position }} at {{ $waitlist->job->company->name ?? 'No company available' }}. Your position is {{ $waitlist->position }}. Total waitlist is {{ $waitlist->waitlist_count }}.">
                    </span>

                    <h3 class="text-2xl font-semibold text-gray-800">
                        {{ $waitlist->job->position }} - {{ $waitlist->job->company->name ?? 'No company available' }}
                    </h3>

                    <div class="mt-4 flex justify-between">
                        <p><strong>Your Position:</strong> {{ $waitlist->position }}</p>
                        <p><strong>Waitinglist:</strong> {{ $waitlist->waitlist_count }}</p>
                    </div>

                    <div class="mt-4 flex justify-center">
                        <form action="{{ route('job.show', ['id' => $waitlist->job->id]) }}" method="get">
                            <button type="submit" class="cta-button bg-[#AA0160] text-white py-2 px-6 rounded-lg hover:bg-[#8D0052] transition font-bold">
                                See Details
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>

<x-footer-layout></x-footer-layout>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const filterButtons = document.querySelectorAll(".filter-button");
        const jobListings = document.querySelectorAll(".space-y-6 > div");

        const filterListings = (status) => {
            jobListings.forEach((listing) => {
                const isHired = listing.classList.contains("animated-bg");
                if (status === "selected" && isHired) {
                    listing.style.display = "block";
                } else if (status === "open" && !isHired) {
                    listing.style.display = "block";
                } else if (status === "all") {
                    listing.style.display = "block";
                } else {
                    listing.style.display = "none";
                }
            });
        };

        filterButtons.forEach((button) => {
            button.addEventListener("click", (e) => {
                const filterType = e.target.id.replace("filter-", "");
                filterListings(filterType);
            });
        });
    });


    document.addEventListener("DOMContentLoaded", function () {
        const animatedContainers = document.querySelectorAll(".animated-bg");

        animatedContainers.forEach((container) => {
            const canvas = container.querySelector(".bg-animation");
            const ctx = canvas.getContext("2d");

            // Ensure canvas matches container size
            const setCanvasSize = () => {
                canvas.width = container.offsetWidth;
                canvas.height = container.offsetHeight;
            };

            setCanvasSize();

            const bubbles = [];
            const maxBubbles = 30;

            class Bubble {
                constructor(x, y, radius, speedX, speedY, color) {
                    this.x = x;
                    this.y = y;
                    this.radius = radius;
                    this.speedX = speedX;
                    this.speedY = speedY;
                    this.color = color;
                }

                draw() {
                    ctx.beginPath();
                    ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
                    ctx.fillStyle = this.color;
                    ctx.fill();
                    ctx.closePath();
                }

                update() {
                    this.x += this.speedX;
                    this.y += this.speedY;

                    // Handle bubbles moving out of bounds
                    if (this.x - this.radius > canvas.width) this.x = -this.radius;
                    if (this.x + this.radius < 0) this.x = canvas.width + this.radius;
                    if (this.y - this.radius > canvas.height) this.y = -this.radius;
                    if (this.y + this.radius < 0) this.y = canvas.height + this.radius;
                }
            }

            const createBubbles = () => {
                const colors = ["#e3b2cd", "#d4e3ce", "#eae7bd"];
                for (let i = 0; i < maxBubbles; i++) {
                    const radius = Math.random() * 10 + 5;
                    const x = Math.random() * canvas.width;
                    const y = Math.random() * canvas.height;
                    const speedX = (Math.random() - 0.5) * 2;
                    const speedY = (Math.random() - 0.5) * 2;
                    const color = colors[Math.floor(Math.random() * colors.length)];
                    bubbles.push(new Bubble(x, y, radius, speedX, speedY, color));
                }
            };

            const animate = () => {
                ctx.clearRect(0, 0, canvas.width, canvas.height);


                bubbles.forEach((bubble) => {
                    bubble.update();
                    bubble.draw();
                });

                requestAnimationFrame(animate);
            };

            createBubbles();
            animate();

            // window.addEventListener("resize", () => {
            //     setCanvasSize();
            //     bubbles.length = 0;
            //     createBubbles();
            // });
        });
    });
</script>
