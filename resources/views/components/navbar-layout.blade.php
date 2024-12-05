<nav class="bg-white px-[1.5rem] py-[1rem] flex items-center justify-between relative">
    <!-- Logo in de navbar -->
    <div class="flex items-center ml-[1rem]">
        <div class="mt-[-1.5rem] py-[1.1rem]">
            <img src="{{ asset('images/ohlogo.png') }}" alt="Open Hiring Logo" class="h-[4rem]">
        </div>
    </div>

    <!-- Hamburger menu, groter en naar links -->
    <div id="hamburger" class="space-y-[0.5rem] ml-[-0.25rem] mt-[-1rem] px-[0.8rem] flex flex-col items-center cursor-pointer">
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

        <li><a href="#" class="block py-2 px-4 font-black">Home</a></li>
        <li><a href="{{ route('job_listings.index') }}" class="block py-2 px-4 font-black">Job Openings</a></li>
        <li><a href="#" class="block py-2 px-4 font-black">Profile</a></li>
        <li><a href="#" class="block py-2 px-4 font-black">My Job Openings</a></li>
        <li><a href="{{ route('register') }}" class="block py-2 px-4 font-black">Register</a></li>
        <li><a href="#" class="block py-2 px-4 font-black">Over Open Hiring</a></li>

        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full py-2 px-4 font-black text-black text-2xl text-center">
                    Logout
                </button>
            </form>
        </li>

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
</script>
