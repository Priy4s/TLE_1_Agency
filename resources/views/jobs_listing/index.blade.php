@extends('layouts.app')

<div class="flex flex-col min-h-screen overflow-hidden">
    <!-- Navbar -->
    <x-navbar-layout></x-navbar-layout>

    <!-- Main Content -->
    <main class="flex-grow">
        <!-- Static Heading with Speaker Icon -->
        <h1 class="text-4xl font-semibold mb-4 text-center font-radical flex justify-center items-center">
            Job Openings
            <span
                class="speaker-icon ml-5"
                aria-label="Click to hear the header out loud"
                role="button"
                tabindex="0"
                data-text="{{ "Job Openings" }}">
    </span>
        </h1>

        <!-- Search Form -->
        <div class="flex justify-center items-center mb-8 w-full">
            <form action="{{ route('job_listings.index') }}" method="GET" class="flex justify-center w-full max-w-lg">
                <div class="flex w-full max-w-[20rem] max-h-[12rem]">
                    <input
                        type="text"
                        id="search-query"
                        name="query"
                        placeholder="Search Jobs..."
                        class="flex-2 py-[1rem] px-[0.75rem] rounded-l-full bg-gray-200 text-gray-800 placeholder-gray-500 placeholder:text-[1.1rem] placeholder:font-medium focus:outline-none border-none w-[80%]"
                        value="{{ request('query') }}"
                    >
                    <button type="submit"
                            class="flex-1 ml-[-1px] bg-[#AA0160] text-white py-[1rem] px-[1.25rem] rounded-r-full hover:bg-[#8D0052] transition font-bold text-[1.1rem]">
                        Search
                    </button>
                </div>
            </form>
        </div>

        <!-- Job Listings -->
        <ul class="space-y-6 mb-[2rem]">
            @foreach($jobListings as $job)
                <li class="bg-white shadow-md rounded-[16px] px-[1rem] pt-[1rem] max-w-[20rem] w-full border border-black mx-auto font-radical relative">
                    <!-- Job Title and Company -->
                    <h3 class="text-2xl font-semibold text-gray-800">
                        {{ $job->position }} - {{ $job->company ? $job->company->name : 'No company available' }}
                    </h3>

                    <!-- Speaker Icon for Job Title -->
                    <span
                        class="speaker-icon absolute top-2 right-2"
                        aria-label="Click to hear the job title read aloud"
                        role="button"
                        tabindex="0"
                        data-text="{{ $job->position }} at {{ $job->company ? $job->company->name : 'No company available' }}">
    </span>

                    <!-- Car Icon for Driver's License (Keep this inside the h3 if it relates to the job title) -->
                    @if($job->drivers_license === true)
                        <span class="ml-2">
            <img src="{{ asset('images/auto.png') }}" alt="Auto Icon" class="h-10 w-10">
        </span>
                    @endif

                    <div class="mt-4 border-green border-t-2 pt-[1rem]">
                        <p class="text-xl font-medium text-gray-700"><strong>Location:</strong>
                            {{ $job->location ? $job->location->name : 'No location available' }}
                        </p>
                        <p class="text-xl font-medium text-gray-700"><strong>Salary:</strong>
                            €{{ number_format($job->salary, 2) }} p/m</p>
                    </div>

                    <div class="mt-4 flex justify-center">
                        <form action="{{ route('job.show', ['id' => $job->id]) }}" method="get">
                            <button type="submit"
                                    class="w-[9rem] bg-violet text-white py-2 px-6 rounded-full hover:bg-darkviolet transition font-bold text-xl font-radical">
                                Details
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </main>

    <!-- Footer -->
    <footer>
        <x-footer-layout></x-footer-layout>
    </footer>
</div>

{{--<script>--}}
{{--    // Get all speaker icons on the page--}}
{{--    const speakerIcons = document.querySelectorAll('.speaker-icon');--}}

{{--    // Function to read the text using the Web Speech API--}}
{{--    function readAloud(text) {--}}
{{--        if ('speechSynthesis' in window) {--}}
{{--            const utterance = new SpeechSynthesisUtterance(text);--}}
{{--            utterance.lang = 'en-US'; // Set the language to English (US)--}}
{{--            window.speechSynthesis.speak(utterance);--}}
{{--        } else {--}}
{{--            alert('Sorry, your browser does not support text-to-speech.');--}}
{{--        }--}}
{{--    }--}}

{{--    // Attach event listeners to each speaker icon--}}
{{--    speakerIcons.forEach(icon => {--}}
{{--        // Read aloud when the icon is clicked--}}
{{--        icon.addEventListener('click', () => {--}}
{{--            // Check if the icon is inside a job listing (li) or an h1--}}
{{--            const jobListingContainer = icon.closest('li');--}}
{{--            const headingContainer = icon.closest('h1');--}}

{{--            let textToRead = '';--}}
{{--            if (jobListingContainer) {--}}
{{--                // Extract only the specific parts of the job listing (ignore button text)--}}
{{--                const jobTitle = jobListingContainer.querySelector('h3')?.textContent.trim() || '';--}}
{{--                const location = jobListingContainer.querySelector('p:nth-of-type(1)')?.textContent.trim() || '';--}}
{{--                const salary = jobListingContainer.querySelector('p:nth-of-type(2)')?.textContent.trim() || '';--}}
{{--                textToRead = `${jobTitle}. ${location}. ${salary}.`;--}}
{{--            } else if (headingContainer) {--}}
{{--                // Read only the heading if the speaker icon is in the h1--}}
{{--                textToRead = headingContainer.textContent.trim();--}}
{{--            } else {--}}
{{--                // Fallback to the data-text attribute if no container is found--}}
{{--                textToRead = icon.dataset.text || 'No text available to read';--}}
{{--            }--}}

{{--            readAloud(textToRead);--}}
{{--        });--}}

{{--        // Add keyboard accessibility for the speaker icon--}}
{{--        icon.addEventListener('keydown', (e) => {--}}
{{--            if (e.key === 'Enter' || e.key === ' ') {--}}
{{--                const jobListingContainer = icon.closest('li');--}}
{{--                const headingContainer = icon.closest('h1');--}}

{{--                let textToRead = '';--}}
{{--                if (jobListingContainer) {--}}
{{--                    const jobTitle = jobListingContainer.querySelector('h3')?.textContent.trim() || '';--}}
{{--                    const location = jobListingContainer.querySelector('p:nth-of-type(1)')?.textContent.trim() || '';--}}
{{--                    const salary = jobListingContainer.querySelector('p:nth-of-type(2)')?.textContent.trim() || '';--}}
{{--                    textToRead = `${jobTitle}. ${location}. ${salary}.`;--}}
{{--                } else if (headingContainer) {--}}
{{--                    textToRead = headingContainer.textContent.trim();--}}
{{--                } else {--}}
{{--                    textToRead = icon.dataset.text || 'No text available to read';--}}
{{--                }--}}

{{--                readAloud(textToRead);--}}
{{--            }--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}



