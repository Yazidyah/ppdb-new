@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex justify-center items-center <px-3></px-3>  border-b-2  text-sm font-medium leading-5 text-white  focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out  focus-scale-95 
            
            hover:bg-dasar hover:text-dasar2 focus-scale-95 transition-all duration-200 ease-out p-2 rounded-lg'
            : 'inline-flex justify-center items-center <px-3></px-3>  border-b-2 border-transparent text-sm font-medium leading-5 text-white focus:outline-none focus:text-white focus:border-gray-300  transition duration-150 ease-in-out focus-scale-95
            
            hover:bg-tertiary hover:text-white focus-scale-95 transition-all duration-200 ease-out p-2 rounded-lg';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
