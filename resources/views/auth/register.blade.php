<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <h1 class="text-[3rem] font-bold mb-6">Register</h1>

        <!-- Email Address -->
        <div class="mb-6">
            <x-input-label for="email" :value="__('Email address*')" />
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
            <x-text-input id="name" class="block mt-2 w-full" type="text" name="name" placeholder="Name..." :value="old('name')" required autofocus autocomplete="name" />
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
</x-guest-layout>
