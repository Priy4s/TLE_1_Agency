<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <h1 class="text-[3rem] font-bold mb-6">Login</h1>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" placeholder="Email address..." :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="current-password"
                          placeholder="Password..." />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me"
                       type="checkbox"
                       class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800 scale-125"
                       name="remember">
                <span class="ms-2 text-[1.125rem] text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- Login Button -->
        <div class="flex flex-col items-center justify-center mt-4">
            <x-primary-button class="flex items-center justify-center w-full max-w-xs px-4 py-3 sm:px-6 sm:py-4">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <!-- Forgot Password Link -->
        <div class="flex justify-center mt-4">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   class="text-[1.125rem] text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 underline focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <!-- Register Button -->
        <div class="flex flex-col items-center justify-center mt-8 space-y-4">
            <x-secondary-button
                class="flex items-center justify-center w-full max-w-xs px-4 py-3 sm:px-6 sm:py-4"
                onclick="window.location='{{ route('register') }}'">
                {{ __('Register') }}
            </x-secondary-button>
        </div>
    </form>
</x-guest-layout>
