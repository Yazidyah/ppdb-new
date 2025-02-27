<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-primary hover:bg-tertiary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-tertiary  focus:bg-tertiary activer:text-white active:bg-tertiary active:border active:border-tertiary  focus:outline-none focus:ring-2 focus:ring-tertiary focus:ring-offset-2  transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
