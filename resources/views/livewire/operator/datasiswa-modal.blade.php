<div>
    <button wire:click="$set('modalOpen', true)" type="button"
        class="inline-flex items-center justify-center text-white h-10 px-4 py-2 text-sm font-medium transition-colors bg-tertiary border rounded-md hover:bg-secondary hover:text-tertiary active:bg-seconadry focus:bg-secondary focus:outline-none focus:ring-2 focus:ring-seconadry focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none">
        Detail</button>

    @if ($modalOpen)
    
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            
            <div
                class="bg-white p-6 rounded-lg mt-14 max-w-7xl w-full max-h-[90vh] overflow-y-auto relative flex items-start justify-center ">
                
                <div class="w-full">
                    @include('operator.data-siswa-detail', ['setTab' => $tab])
                </div>
            </div>
        </div>
    @endif
</div>