<div>
    <button wire:click="$set('modalOpen', true)" type="button"
        class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors {{ $buttonColor }} border rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none">
        {!! $buttonIcon !!}

    </button>

    @if ($modalOpen)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm"
            wire:click.self="$set('modalOpen', false)">
            <div class="relative w-3/4 max-w-md p-6 bg-white rounded-lg">
                <button wire:click="$set('modalOpen', false)"
                    class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-red-400 rounded-full hover:text-white hover:bg-red-400">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <h2 class="mb-4 text-xl font-bold">Penerimaan {{ ucwords($siswa->nama_lengkap) }}</h2>
                <hr class="mb-4">
                <form wire:submit.prevent="simpan">
                    <div class="flex items-center mb-4">
                        <label for="status" class="mr-4">Penerimaan</label>
                        <select id="status" wire:model="status"
                            class="px-4 py-2 border rounded-lg focus:border-tertiary  focus:ring-tertiary shadow-sm">
                            <option value="">Pilih Status</option>
                            <option value="7">Diterima</option>
                            <option value="8">Cadangan</option>
                            <option value="6">Tidak Diterima</option>
                            {{-- @foreach ($statusList as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" wire:click="$set('modalOpen', false)"
                            class="px-4 py-2 mr-2 text-white bg-red-900 rounded hover:bg-red-500">Batal</button>
                        <button type="submit"
                            class="px-4 py-2 text-white bg-tertiary rounded hover:bg-secondary hover:text-tertiary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
