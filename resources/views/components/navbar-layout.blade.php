<nav class="bg-white px-[1.5rem] py-[1rem] flex items-center justify-between relative">
    <!-- Logo in de navbar -->
    <div class="flex items-center ml-[1rem]">
        <div class="mt-[-1.5rem] py-[1.1rem]">
            <img src="{{ asset('images/ohlogo.png') }}" alt="Open Hiring Logo" class="h-[4rem]">
        </div>
    </div>

    <!-- Hamburger menu, groter en naar links -->
    <div id="hamburger"
        class="space-y-[0.5rem] ml-[-0.25rem] mt-[-1rem] px-[0.8rem] flex flex-col items-center cursor-pointer">
        <div class="h-[0.3rem] w-[3rem] bg-black rounded"></div>
        <div class="h-[0.3rem] w-[3rem] bg-black rounded"></div>
        <div class="h-[0.3rem] w-[3rem] bg-black rounded"></div>
        <span class="text-black text-lg font-black mt-[0.5rem]">Menu</span>
    </div>

</nav>

<!-- Verberg het menu standaard -->
<div id="menu" class="fixed inset-0 bg-white flex justify-center items-center z-50 hidden">
    <ul class="text-black text-2xl text-center">
        <!-- Logo in het midden van het menu -->
        <div class="flex justify-center w-full mb-4">
            <img src="{{ asset('images/ohlogo.png') }}" alt="Open Hiring Logo" class="h-[6rem]">
        </div>

        @if (auth()->check() && auth()->user()->role == 'admin')
            <li><a href="{{ route('manager.dashboard') }}" class="block py-2 px-4 font-black">Manager Dashboard</a></li>
            <li><a href="{{ route('jobs_listing.create') }}" class="block py-2 px-4 font-black">Create Job Listing</a>
            </li>
            <li><a href="{{ route('chat.index') }}" class="block py-2 px-4 font-black">Chats</a></li>
            <li><a href="{{ route('about') }}" class="block py-2 px-4 font-black">About Open Hiring</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full py-2 px-4 font-black text-black text-2xl text-center">
                        Logout
                    </button>
                </form>
            </li>
        @endif
        @if (auth()->check() && auth()->user()->role == 'applicant')
            <li><a href="{{ route('home') }}" class="block py-2 px-4 font-black">Home</a></li>
            <li><a href="{{ route('job_listings.index') }}" class="block py-2 px-4 font-black">Job Openings</a></li>
            <li><a href="{{ route('quiz.start') }}" class="block py-2 px-4 font-black">Talent Discovery</a></li>
            <li><a href="{{ route('job_listings.my') }}" class="block py-2 px-4 font-black">My Job Openings</a></li>
            <li><a href="{{ route('chat.index') }}" class="block py-2 px-4 font-black">Chats</a></li>
            <li><a href="{{ route('about') }}" class="block py-2 px-4 font-black">About Open Hiring</a></li>

            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full py-2 px-4 font-black text-black text-2xl text-center">
                        Logout
                    </button>
                </form>
            </li

        @elseif (!auth()->check())
            <li><a href="{{ route('home') }}" class="block py-2 px-4 font-black">Home</a></li>
            <li><a href="{{ route('about') }}" class="block py-2 px-4 font-black">About Open Hiring</a></li>
            <li><a href="{{ route('login') }}" class="block py-2 px-4 font-black">Login</a></li>
        @endif

        <!-- Knoppen voor lettergrootte en vergroting in het midden -->
        <div class="flex justify-between items-center space-x-4 mt-4 w-full px-4">
            <button id="decrease-font" class="text-black text-lg font-black bg-gray-200 p-2 rounded">A-</button>
            <span id="font-size-display" class="text-black text-lg font-black">Font size: 16px</span>
            <button id="increase-font" class="text-black text-lg font-black bg-gray-200 p-2 rounded">A+</button>
        </div>

        <!-- Sluitknop ("X") net onder de laatste optie -->
        <li id="closeMenu" class="block py-2 px-4 font-black text-black cursor-pointer text-5xl">×</li>
    </ul>
</div>

<script>
    // JavaScript om het menu zichtbaar/verborgen te maken
    document.getElementById('hamburger').addEventListener('click', function() {
        const menu = document.getElementById('menu');
        menu.classList.toggle('hidden');

        // Zorg ervoor dat je niet kunt scrollen als het menu zichtbaar is
        if (!menu.classList.contains('hidden')) {
            document.body.style.overflow = 'hidden'; // Voorkom scrollen
        } else {
            document.body.style.overflow = 'auto'; // Zet scrollen weer aan
        }
    });

    // Sluit het menu wanneer de "X" wordt aangeklikt
    document.getElementById('closeMenu').addEventListener('click', function() {
        const menu = document.getElementById('menu');
        menu.classList.add('hidden');
        document.body.style.overflow = 'auto'; // Zet scrollen weer aan
    });

    // Lettergrootte aanpassen
    const increaseFontButton = document.getElementById('increase-font');
    const decreaseFontButton = document.getElementById('decrease-font');
    const fontSizeDisplay = document.getElementById('font-size-display');
    const defaultFontSize = 16; // Standaard lettergrootte
    const maxFontSize = 23; // Maximaal toegestane lettergrootte
    const minFontSize = 10; // Minimale lettergrootte
    let fontSize = localStorage.getItem('fontSize') ? parseFloat(localStorage.getItem('fontSize')) : defaultFontSize;

    // Stel de huidige lettergrootte in
    document.documentElement.style.fontSize = `${fontSize}px`;
    fontSizeDisplay.textContent = `Font size: ${fontSize}px`;

    increaseFontButton.addEventListener('click', function() {
        if (fontSize < maxFontSize) { // Controleer of de maximale grootte niet is bereikt
            fontSize += 1; // Verhoog met 1px
            document.documentElement.style.fontSize = `${fontSize}px`;
            fontSizeDisplay.textContent = `Font size: ${fontSize}px`; // Toon de nieuwe grootte
            localStorage.setItem('fontSize', fontSize); // Bewaren in localStorage
        }
    });

    decreaseFontButton.addEventListener('click', function() {
        if (fontSize > minFontSize) { // Minimale fontgrootte
            fontSize -= 1; // Verklein met 1px
            document.documentElement.style.fontSize = `${fontSize}px`;
            fontSizeDisplay.textContent = `Font size: ${fontSize}px`; // Toon de nieuwe grootte
            localStorage.setItem('fontSize', fontSize); // Bewaren in localStorage
        }
    });
</script>
