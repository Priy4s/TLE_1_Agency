@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-bold text-sm text-gray-700  text-[1.125rem]']) }}>
    {{ $value ?? $slot }}
</label>
