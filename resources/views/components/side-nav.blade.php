@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center p-2 rounded-lg text-tertiary hover:bg-white hover:text-tertiary group flex-1 ms-3 whitespace-nowrap text-wrap bg-white'
            : 'flex items-center p-2 rounded-lg text-white hover:bg-white hover:text-tertiary group ';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
