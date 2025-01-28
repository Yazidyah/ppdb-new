@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-medium leading-2 text-gray-900']) }}>
    {{ $value ?? $slot }}
</label>
