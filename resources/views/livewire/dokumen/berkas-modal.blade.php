<div>
    @if ($modalSubmit)
        <div class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="fixed inset-0 bg-black/50"></div>
            <div class="relative w-full max-w-md p-6 bg-white  rounded-lg shadow-xl">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 ">Isi Data sesusai syarat</h3>
                    <button wire:click="closeModal"
                        class="text-gray-500 hover:text-red-800 " >
                        <svg class="h-4 w-4 inline-block ml-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                            data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="space-y-4">
                    <div>
                        <label for="data_berkas" class="block text-sm font-medium text-gray-700 ">Isi data sesuai dengan berkas yang diunggah</label>
                        <input type="text" id="data_berkas" wire:model="dataBerkas.data_berkas"
                            class="w-full mt-1 p-2 border border-gray-300  rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500  bg-white  text-gray-900  placeholder-gray-400 "
                            placeholder="Isi data di sini" required>
                        @error('dataBerkas.data_berkas') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end gap-3">
                        <button wire:click="closeModal"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white hover:text-white border border-gray-300 rounded-md hover:bg-red-800    ">
                            Batal
                        </button>
                        <button wire:click="update"
                            class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-md bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-primary hover:to-tertiary ">
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