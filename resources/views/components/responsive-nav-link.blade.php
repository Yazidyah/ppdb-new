@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-secondary  text-start text-base font-medium text-tertiary  bg-indigo-50  focus:outline-none focus:text-indigo-800 focus:bg-indigo-100  focus:border-secondary  transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-white  hover:text-tertiary  hover:bg-gray-50  hover:border-tertiary  focus:outline-none focus:text-gray-800 focus:bg-gray-50  focus:border-gray-300  transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
