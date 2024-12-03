@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-bold text-sm text-gray-700 dark:text-gray-300 text-[1.25rem]']) }}>
    {{ $value ?? $slot }}
</label>
