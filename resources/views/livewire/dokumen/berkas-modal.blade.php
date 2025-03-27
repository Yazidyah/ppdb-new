<div>
    @if ($modalSubmit)
        <div class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="fixed inset-0 bg-black/50" wire:click="closeModal"></div>
            <div class="relative w-full max-w-md p-6 bg-white rounded-lg shadow-xl">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Isi Nomor {{ $syarat->nama_persyaratan }}</h3>
                    <button wire:click="closeModal" class="text-gray-500 hover:text-red-800">
                        <svg class="h-4 w-4 inline-block ml-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                            data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="space-y-4">
                    <div>
                        <label for="data_berkas" class="block text-sm font-medium text-gray-700">
                            Pastikan data sesuai dengan berkas yang diunggah
                        </label>
                        <input type="text" id="data_berkas" wire:model="isian_berkas"
                            class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-green-900 bg-white text-gray-900 placeholder-gray-400"
                            placeholder="Isi data di sini" required>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button wire:click="closeModal"
                            class="inline-flex justify-center items-center px-4 py-2 bg-red-900 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500  focus:bg-red-900 active:bg-red-900 active:border active:border-red-900 focus:outline-none focus:ring-2 focus:ring-red-900 focus:ring-offset-2  transition ease-in-out duration-150">
                            Batal
                        </button>
                        <button wire:click="simpan"
                            class="px-4 py-2 inline-flex justify-center items-center  bg-tertiary border border-transparent font-semibold text-xs text-white uppercase tracking-widest hover:bg-secondary hover:text-tertiary active:text-white focus:bg-tertiary active:bg-tertiary active:border active:border-tertiary focus:outline-none focus:ring-2 focus:ring-tertiary focus:ring-offset-2  transition ease-in-out duration-150 rounded">
                            Kirim
                            <svg class="h-4 w-4 inline-block ml-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                                data-slot="icon">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>