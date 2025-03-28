<div class="p-8 bg-white rounded-lg">

    <div>
        {{-- <div class="grid grid-cols-2 gap-4 text-gray-700 text-left mb-3">
            <button wire:click="previewKartuPeserta"
                class="mt-4 px-4 py-2 inline-flex justify-center items-center bg-tertiary border border-transparent font-semibold text-xs text-white uppercase tracking-widest hover:bg-secondary hover:text-tertiary focus:bg-tertiary active:bg-tertiary active:border active:border-tertiary focus:outline-none focus:ring-2 focus:ring-tertiary focus:ring-offset-2 transition ease-in-out duration-150 rounded">
                Cetak Kartu Peserta
            </button>

            <button wire:click="previewSuratKeterangan"
                class="mt-4 px-4 py-2 inline-flex justify-center items-center  bg-tertiary border border-transparent font-semibold text-xs text-white uppercase tracking-widest hover:bg-secondary hover:text-tertiary focus:bg-tertiary active:bg-tertiary active:border active:border-tertiary focus:outline-none focus:ring-2 focus:ring-tertiary focus:ring-offset-2  transition ease-in-out duration-150 rounded">
                Cetak Surat Keterangan
            </button>
        </div> --}}


        {{-- @if ($showModalKartuPeserta)
        <div class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="bg-white rounded-lg shadow-2xl w-3/4 max-w-5xl mt-[600px] border border-gray-300">
                <div class="flex justify-between items-center p-4 border-b">
                    <h2 class="text-lg font-semibold">Preview Kartu Peserta</h2>
                    <button wire:click="closeModalKartuPeserta" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="p-4">
                    @if ($previewUrlKartuPeserta)
                    <iframe src="{{ $previewUrlKartuPeserta }}" class="w-full rounded-lg h-[700px] border rounded"></iframe>
                    @else
                    <p class="text-gray-500">Preview tidak tersedia.</p>
                    @endif
                </div>

                <div class="flex justify-end p-4 border-t">
                    <button wire:click="closeModalKartuPeserta"
                        class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-700">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
        @endif

        @if ($showModalSuratKeterangan)
        <div class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="bg-white rounded-lg shadow-2xl w-3/4 max-w-5xl mt-[600px] border border-gray-300">
                <div class="flex justify-between items-center p-4 border-b">
                    <h2 class="text-lg font-semibold">Preview Surat Keterangan</h2>
                    <button wire:click="closeModalSuratKeterangan" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="p-4">
                    @if ($previewUrlSuratKeterangan)
                    <iframe src="{{ $previewUrlSuratKeterangan }}" class="w-full rounded-lg h-[700px] border rounded"></iframe>
                    @else
                    <p class="text-gray-500">Preview tidak tersedia.</p>
                    @endif
                </div>

                <div class="flex justify-end p-4 border-t">
                    <button wire:click="closeModalSuratKeterangan"
                        class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-700">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
        @endif --}}
    </div>
    <h5 class="font-medium">Edit Data Siswa</h5>
    <p class="text-sm text-gray-400 mb-4">Pastikan data sudah benar sebelum menyimpan.</p>

    <!-- Input Form -->
    <div class="grid grid-cols-2 gap-4 text-gray-700 text-left">
        <div class="border p-4 rounded-lg">
            <h6 class="font-medium mb-2">Informasi Pribadi</h6>
            <div>
                <label class="text-xs font-medium">Nama Lengkap</label>
                <input type="text" wire:model="nama_lengkap" class="border p-2 w-full rounded-lg">
            </div>
            <div>
                <label class="text-xs font-medium">NIK</label>
                <input type="text" wire:model="nik" class="border p-2 w-full rounded-lg">
            </div>
            <div>
                <label class="text-xs font-medium">No Telepon</label>
                <input type="text" wire:model="no_telp" class="border p-2 w-full rounded-lg">
            </div>
            <div>
                <label class="text-xs font-medium">Jenis Kelamin</label>
                <select wire:model="jenis_kelamin" class="border p-2 w-full rounded-lg">
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            <div>
                <label class="text-xs font-medium">Tempat Lahir</label>
                <input type="text" wire:model="tempat_lahir" class="border p-2 w-full rounded-lg">
            </div>
            <div>
                <label class="text-xs font-medium">Tanggal Lahir</label>
                <input type="date" wire:model="tanggal_lahir" class="border p-2 w-full rounded-lg">
            </div>
            <div>
                <label class="text-xs font-medium">Alamat Domisili</label>
                <input type="text" wire:model="alamat_domisili" class="border p-2 w-full rounded-lg">
            </div>
            <div>
                <label class="text-xs font-medium">Alamat KK</label>
                <input type="text" wire:model="alamat_kk" class="border p-2 w-full rounded-lg">
            </div>
            <div>
                <label class="text-xs font-medium">Provinsi</label>
                <input type="text" wire:model="provinsi" class="border p-2 w-full rounded-lg">
            </div>
            <div>
                <label class="text-xs font-medium">Kota</label>
                <input type="text" wire:model="kota" class="border p-2 w-full rounded-lg">
            </div>
        </div>
        <div class="border p-4 rounded-lg">
            <h6 class="font-medium mb-2">Informasi Pendidikan</h6>
            <div>
                <label class="text-xs font-medium">Jalur</label>
                <select wire:model="id_jalur" class="border p-2 w-full rounded-lg">
                    @foreach ($jalurOptions as $jalur)
                        <option value="{{ $jalur->id_jalur }}">{{ $jalur->nama_jalur }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-xs font-medium">NISN</label>
                <input type="text" wire:model="nisn" class="border p-2 w-full rounded-lg">
            </div>
            <div>
                <label class="text-xs font-medium">NPSN</label>
                <input type="text" wire:model="npsn" class="border p-2 w-full rounded-lg">
            </div>
            <div>
                <label class="text-xs font-medium">Sekolah Asal</label>
                <input type="text" wire:model="sekolah_asal" class="border p-2 w-full rounded-lg">
            </div>
            <div>
                <label class="text-xs font-medium">Status Sekolah</label>
                <input type="text" wire:model="status_sekolah" class="border p-2 w-full rounded-lg">
            </div>
            <h6 class="font-medium mb-2 mt-4">Informasi Akun</h6>
            <div>
                <label class="text-xs font-medium">Username</label>
                <input type="text" wire:model="name" class="border p-2 w-full rounded-lg">
            </div>
            <div>
                <label class="text-xs font-medium">Email</label>
                <input type="email" wire:model="email" class="border p-2 w-full rounded-lg">
            </div>
            <div>
                <label class="text-xs font-medium">Password</label>
                <input type="text" wire:model="password" class="border p-2 w-full rounded-lg" placeholder="(Kosongkan jika tidak ingin mengubah)">
            </div>
        </div>
        <div class="border p-4 rounded-lg col-span-2">
            <h6 class="mb-4">Jadwal Tes</h6>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-xs font-medium">BQ & Wawancara</label>
                    <input type="text" wire:model="jadwalTesBQ" class="border p-2 w-full rounded-lg">
                </div>
                <div>
                    <label class="text-xs font-medium">Seleksi Japres</label>
                    <input type="text" wire:model="jadwalTesJapres" class="border p-2 w-full rounded-lg">
                </div>
            </div>
        </div>

    </div>

    <!-- Tombol Update -->
    <button wire:click="updateSiswa"
        class="mt-4 px-4 py-2 inline-flex justify-center items-center  bg-tertiary border border-transparent font-semibold text-xs text-white uppercase tracking-widest hover:bg-secondary hover:text-tertiary focus:bg-tertiary active:bg-tertiary active:border active:border-tertiary focus:outline-none focus:ring-2 focus:ring-tertiary focus:ring-offset-2  transition ease-in-out duration-150 rounded">
        Simpan Perubahan
    </button>

    <div class="grid grid-cols-2 gap-4 text-gray-700 text-left mb-3">
        <button wire:click="previewKartuPeserta"
            class="mt-4 px-4 py-2 inline-flex justify-center items-center bg-tertiary border border-transparent font-semibold text-xs text-white uppercase tracking-widest hover:bg-secondary hover:text-tertiary focus:bg-tertiary active:bg-tertiary active:border active:border-tertiary focus:outline-none focus:ring-2 focus:ring-tertiary focus:ring-offset-2 transition ease-in-out duration-150 rounded">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 mr-2">
            <path fill-rule="evenodd" d="M7.875 1.5C6.839 1.5 6 2.34 6 3.375v2.99c-.426.053-.851.11-1.274.174-1.454.218-2.476 1.483-2.476 2.917v6.294a3 3 0 0 0 3 3h.27l-.155 1.705A1.875 1.875 0 0 0 7.232 22.5h9.536a1.875 1.875 0 0 0 1.867-2.045l-.155-1.705h.27a3 3 0 0 0 3-3V9.456c0-1.434-1.022-2.7-2.476-2.917A48.716 48.716 0 0 0 18 6.366V3.375c0-1.036-.84-1.875-1.875-1.875h-8.25ZM16.5 6.205v-2.83A.375.375 0 0 0 16.125 3h-8.25a.375.375 0 0 0-.375.375v2.83a49.353 49.353 0 0 1 9 0Zm-.217 8.265c.178.018.317.16.333.337l.526 5.784a.375.375 0 0 1-.374.409H7.232a.375.375 0 0 1-.374-.409l.526-5.784a.373.373 0 0 1 .333-.337 41.741 41.741 0 0 1 8.566 0Zm.967-3.97a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H18a.75.75 0 0 1-.75-.75V10.5ZM15 9.75a.75.75 0 0 0-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 0 0 .75-.75V10.5a.75.75 0 0 0-.75-.75H15Z" clip-rule="evenodd" />
            </svg>
            Cetak Kartu Peserta
        </button>

        <button wire:click="previewSuratKeterangan"
            class="mt-4 px-4 py-2 inline-flex justify-center items-center  bg-tertiary border border-transparent font-semibold text-xs text-white uppercase tracking-widest hover:bg-secondary hover:text-tertiary focus:bg-tertiary active:bg-tertiary active:border active:border-tertiary focus:outline-none focus:ring-2 focus:ring-tertiary focus:ring-offset-2  transition ease-in-out duration-150 rounded">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 mr-2">
            <path fill-rule="evenodd" d="M7.875 1.5C6.839 1.5 6 2.34 6 3.375v2.99c-.426.053-.851.11-1.274.174-1.454.218-2.476 1.483-2.476 2.917v6.294a3 3 0 0 0 3 3h.27l-.155 1.705A1.875 1.875 0 0 0 7.232 22.5h9.536a1.875 1.875 0 0 0 1.867-2.045l-.155-1.705h.27a3 3 0 0 0 3-3V9.456c0-1.434-1.022-2.7-2.476-2.917A48.716 48.716 0 0 0 18 6.366V3.375c0-1.036-.84-1.875-1.875-1.875h-8.25ZM16.5 6.205v-2.83A.375.375 0 0 0 16.125 3h-8.25a.375.375 0 0 0-.375.375v2.83a49.353 49.353 0 0 1 9 0Zm-.217 8.265c.178.018.317.16.333.337l.526 5.784a.375.375 0 0 1-.374.409H7.232a.375.375 0 0 1-.374-.409l.526-5.784a.373.373 0 0 1 .333-.337 41.741 41.741 0 0 1 8.566 0Zm.967-3.97a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H18a.75.75 0 0 1-.75-.75V10.5ZM15 9.75a.75.75 0 0 0-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 0 0 .75-.75V10.5a.75.75 0 0 0-.75-.75H15Z" clip-rule="evenodd" />
            </svg>
            Cetak Surat Keterangan
        </button>
    </div>




    @if (session()->has('message'))
        <p class="text-green-500 mt-2">{{ session('message') }}</p>
    @endif
</div>