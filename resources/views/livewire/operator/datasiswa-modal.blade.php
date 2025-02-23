<div>
    <button wire:click="$set('modalOpen', true)" type="button"
        class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors bg-white border rounded-md hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none">
        Detail</button>

    @if ($modalOpen)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div
                class="bg-white p-6 rounded-lg max-w-7xl w-full max-h-[90vh] overflow-y-auto relative flex items-center justify-center">
                <button wire:click="$set('modalOpen', false)"
                    class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-red-400 rounded-full hover:text-white hover:bg-red-400">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <div class="w-full">
                    @include('operator.data-siswa-detail', ['setTab' => $tab])
                </div>
            </div>
        </div>
    @endif
</div>