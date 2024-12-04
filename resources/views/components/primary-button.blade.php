<button
    {{ $attributes->merge(['class' => 'relative w-full max-w-xs px-6 py-4 text-white font-bold text-lg bg-mossdark rounded-lg shadow-md transition-all duration-200 ease-in-out transform hover:translate-y-[-2px] focus:outline-none focus:ring-4 focus:ring-green/50 active:bg-green active:translate-y-[2px]']) }}>
    <span class="absolute inset-0 bg-green rounded-lg scale-[1.02] -translate-y-1"></span>
    <span class="relative z-10">{{ $slot }}</span>
    @if ($showIcon ?? true)
        <span class="absolute right-4 top-1/2 transform -translate-y-1/2 text-xl">→</span>
    @endif
</button>
