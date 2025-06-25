<div class="text-left mb-4">
    <button
        class="cursor-not-allowed px-4 py-2 text-sm font-medium text-white transition-colors bg-tertiary border rounded-md hover:bg-secondary hover:text-tertiary active:bg-secondary focus:bg-secondary focus:outline-none focus:ring-2 focus:ring-secondary focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none min-w-[199px]"
        wire:click="kirimEmail" wire:loading.attr="disabled" wire:target="kirimEmail" cursor-not-allowed disabled>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="inline-block w-6 h-6 mr-2">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M21.75 6.75v10.5A2.25 2.25 0 0 1 19.5 19.5h-15A2.25 2.25 0 0 1 2.25 17.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-.659 1.591l-7.091 7.091a2.25 2.25 0 0 1-3.182 0L3.909 8.584A2.25 2.25 0 0 1 3.25 6.993V6.75" />
        </svg>
        <span wire:loading.remove wire:target="kirimEmail">
            Kirim Email Hasil Seleksi Jalur Reguler
        </span>
        <span wire:loading wire:target="kirimEmail">
            Mengirim Email...
        </span>
    </button>
</div>
