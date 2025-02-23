<div>
    <button wire:click="$set('modalOpen', true)" type="button"
        class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors bg-white border rounded-md hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none">
        Status</button>

    @if ($modalOpen)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-6 rounded-lg relative">
                <button wire:click="$set('modalOpen', false)"
                    class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-red-400 rounded-full hover:text-white hover:bg-red-400">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <h2 class="text-xl font-bold mb-4">Ubah Status</h2>
                <form wire:submit.prevent="simpan">
                    <select wire:model="status" class="px-4 py-2 border rounded-lg mb-4">
                        @foreach ($statusList as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    <div class="flex justify-end">
                        <button type="button" wire:click="$set('modalOpen', false)"
                            class="px-4 py-2 bg-gray-500 text-white rounded-lg mr-2">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>