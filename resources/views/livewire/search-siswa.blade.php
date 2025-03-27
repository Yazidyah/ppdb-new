<div class="container mx-auto p-4">
    <!-- Form Pencarian -->
    <div class="max-w-md mx-auto bg-white border-4 border-tertiary rounded-lg shadow-lg p-6">
        <form wire:submit.prevent="search">
            <!-- tambahkan teks "Sudah pernah mendaftar? cari disini -->
            <div class="mb-4 text-left text-gray-700 text-sm font-bold">
                Sudah pernah mendaftar? Silakan cari disini
            </div>
            <div class="mb-4">
                <label for="nisn" class="block text-gray-700 text-sm font-bold mb-2">NISN</label>
                <input type="text" id="nisn" wire:model="nisn" inputmode="numeric" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="10" 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline  focus:border-tertiary  focus:ring-tertiary">
                @error('nisn')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="nomor_peserta" class="block text-gray-700 text-sm font-bold mb-2">Kode Registrasi</label>
                <input type="text" id="nomor_peserta" wire:model="nomor_peserta"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-tertiary  focus:ring-tertiary">
                @error('nomor_peserta')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>
            @error('not_found')
                <div class="text-red-500 text-xs italic mt-2">{{ $message }}</div>
            @enderror
            <div class="flex items-center justify-end mt-4">
                <button type="submit"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-tertiary rounded-lg hover:bg-secondary focus:ring-2 focus:outline-none focus:ring-tertiary hover:text-tertiary
                     border border-transparent tracking-widest  focus:bg-tertiary active:text-white active:bg-tertiary active:border active:border-tertiary  focus:ring-offset-2  transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                    Search
                </button>
            </div>
        </form>
    </div>

    <!-- Modal Tampilan Detail Siswa (read-only) -->
    @if ($showModal)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm">
            <div class="relative w-3/4 max-w-md p-6 bg-white rounded-lg">
                <button wire:click="$set('showModal', false)"
                    class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-red-400 rounded-full hover:text-white hover:bg-red-400">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <h2 class="mb-4 text-xl font-bold">Detail Siswa</h2>
                <hr class="mb-4">
                <div class="grid grid-cols-2 gap-4">
                    <div class="font-bold">Nama:</div>
                    <div>{{ ucwords($siswa->calonSiswa->nama_lengkap) }}</div>

                    <div class="font-bold">NISN:</div>
                    <div>{{ $siswa->calonSiswa->NISN }}</div>

                    <div class="font-bold">Kode Registrasi:</div>
                    <div>{{ $siswa->nomor_peserta }}</div>

                    <div class="font-bold">Jalur:</div>
                    <div>{{ $siswa->jalur->nama_jalur}}</div>

                    <div class="font-bold">Status:</div>
                    <div>{{ $statusLabels[$siswa->status] }}</div>
                </div>
            </div>
        </div>
    @endif
</div>