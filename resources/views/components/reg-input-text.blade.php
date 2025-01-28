@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => '"w-full flex rounded-md shadow-sm ring-1 ring-inset ring-primary focus-within:ring-2 focus-within:ring-inset focus-within:ring-primary ']) !!}>
