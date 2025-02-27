@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-tertiary  focus:ring-tertiary rounded-md shadow-sm']) }}>



