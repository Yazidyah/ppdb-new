<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-white  border border-gray-800 rounded-md font-semibold text-xs text-tertiary  uppercase tracking-widest shadow-sm hover:bg-secondary  focus:outline-none focus:ring-2 focus:ring-tertiary focus:ring-offset-2  disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
