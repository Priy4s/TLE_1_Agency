<style>
    :root,
    html,
    body {
        color-scheme: light !important;}
</style>


<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <h1 class="text-[3rem] font-bold mb-6">Register</h1>

        <!-- Email Address -->
        <div class="mb-6 relative">
            <div class="flex items-center">
                <x-input-label for="email" :value="__('Email address*')" />
                <!-- Info Icon -->
                <img
                    src="{{ asset('images/info.png') }}"
                    alt="Info"
                    tabindex="0"
                    role="button"
                    aria-label="More information about the email field"
                    class="ms-2 cursor-pointer w-8 h-8"
                    onclick="showInfoPopup()"
                    onkeypress="handleKeyPress(event, showInfoPopup)" />
            </div>

            <x-text-input id="email" class="block mt-2 w-full" type="email" name="email" placeholder="Email address..." :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-6">
            <x-input-label for="password" :value="__('Password*')" />
            <x-text-input id="password" class="block mt-2 w-full" type="password" name="password" required autocomplete="new-password" placeholder="Password..." />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-6">
            <x-input-label for="password_confirmation" :value="__('Confirm Password*')" />
            <x-text-input id="password_confirmation" class="block mt-2 w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm password..." />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="mb-6">
            <x-input-label for="name" :value="__('Name (optional)')" />
            <x-text-input id="name" class="block mt-2 w-full" type="text" name="name" placeholder="Name..." :value="old('name')" autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Register Button and Link -->
        <div class="flex flex-col items-center justify-center mt-4 space-y-4">
            <x-primary-button class="flex items-center justify-center w-full max-w-xs px-4 py-3 sm:px-6 sm:py-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>

        <div class="flex flex-col items-center justify-center mt-4 space-y-4"><p>Or if you already have an account:</p></div>
        <div class="flex flex-col items-center justify-center mt-4 space-y-4">
            <x-secondary-button
                class="flex items-center justify-center w-full max-w-xs px-4 py-3 sm:px-6 sm:py-4"
                onclick="window.location='{{ route('login') }}'">
                {{ __('Login') }}
            </x-secondary-button>
        </div>
    </form>

    <!-- Modal Background and Popup -->
    <div id="modal" class="fixed inset-0 hidden bg-black bg-opacity-50 z-40 flex items-center justify-center" role="dialog" aria-labelledby="modal-title" aria-describedby="modal-description">
        <div class="bg-[#a3c7a3] p-6 rounded-md shadow-lg w-11/12 sm:w-96 relative">
            <!-- Close Button -->
            <button
                class="absolute top-4 right-4 text-gray-900 font-bold text-3xl hover:text-black"
                aria-label="Close popup"
                onclick="hideInfoPopup()"
                onkeypress="handleKeyPress(event, hideInfoPopup)">
                &times;
            </button>
            <!-- Popup Content -->
            <div class="flex items-center mb-4">
                <!-- Info Icon -->
                <img
                    src="{{ asset('images/info.png') }}"
                    alt="Info Icon"
                    class="w-8 h-8 mr-2" />
                <h2 id="modal-title" class="text-lg font-bold text-black">
                    How do we use your Email address?
                </h2>
            </div>
            <p id="modal-description" class="text-black text-base leading-6">
                Employers will use your email address to contact you once you’ve been selected.
                We use a secure system to ensure your email address stays hidden throughout the process.
            </p>
        </div>
    </div>

    <script>
        function showInfoPopup() {
            const modal = document.getElementById('modal');
            modal.classList.remove('hidden');
            // Focus on the close button inside the modal
            modal.querySelector('button').focus();
        }

        function hideInfoPopup() {
            const modal = document.getElementById('modal');
            modal.classList.add('hidden');
            // Return focus to the "info" icon
            document.querySelector('img[onclick="showInfoPopup()"]').focus();
        }

        function handleKeyPress(event, callback) {
            if (event.key === "Enter" || event.key === " ") {
                event.preventDefault();
                callback();
            }
        }
    </script>
</x-guest-layout>
