<button
    {{ $attributes->merge(['type' => 'button', 'class' => 'relative inline-flex items-center justify-center w-full max-w-xs px-6 py-3 bg-darkviolet rounded-lg text-white font-semibold text-sm tracking-normal shadow-md transition-all duration-200 ease-in-out hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-violet/50 active:bg-darkviolet']) }}>
    <span class="absolute inset-0 bg-violet rounded-lg scale-[1.02] -translate-y-1"></span>
    <span class="relative z-10">{{ $slot }}</span>
</button>
