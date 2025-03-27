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


        @if ($showModalKartuPeserta)
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
                            <iframe src="{{ $previewUrlKartuPeserta }}"
                                class="w-full h-[700px] border rounded"></iframe>
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
                            <iframe src="{{ $previewUrlSuratKeterangan }}"
                                class="w-full h-[700px] border rounded"></iframe>
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
        @endif
    </div>
    <h5 class="font-medium">Edit Data Siswa</h5>
    <p class="text-sm text-gray-400">Pastikan data sudah benar sebelum menyimpan.</p>

    <!-- Input Form -->
    <div class="grid grid-cols-2 gap-4 text-gray-700 text-left">
        <div>
            <label class="text-xs font-medium">Nama Lengkap</label>
            <input type="text" wire:model="nama_lengkap" class="border p-2 w-full">
        </div>
        <div>
            <label class="text-xs font-medium">NIK</label>
            <input type="text" wire:model="nik" class="border p-2 w-full">
        </div>
        <div>
            <label class="text-xs font-medium">NISN</label>
            <input type="text" wire:model="nisn" class="border p-2 w-full">
        </div>
        <div>
            <label class="text-xs font-medium">No Telepon</label>
            <input type="text" wire:model="no_telp" class="border p-2 w-full">
        </div>
        <div>
            <label class="text-xs font-medium">Jenis Kelamin</label>
            <select wire:model="jenis_kelamin" class="border p-2 w-full">
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>
        <div>
            <label class="text-xs font-medium">Tempat Lahir</label>
            <input type="text" wire:model="tempat_lahir" class="border p-2 w-full">
        </div>
        <div>
            <label class="text-xs font-medium">Tanggal Lahir</label>
            <input type="date" wire:model="tanggal_lahir" class="border p-2 w-full">
        </div>
        <div>
            <label class="text-xs font-medium">Jalur</label>
            <select wire:model="id_jalur" class="border p-2 w-full">
                @foreach ($jalurOptions as $jalur)
                    <option value="{{ $jalur->id_jalur }}">{{ $jalur->nama_jalur }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="text-xs font-medium">NPSN</label>
            <input type="text" wire:model="npsn" class="border p-2 w-full">
        </div>
        <div>
            <label class="text-xs font-medium">Sekolah Asal</label>
            <input type="text" wire:model="sekolah_asal" class="border p-2 w-full">
        </div>
        <div>
            <label class="text-xs font-medium">Status Sekolah</label>
            <input type="text" wire:model="status_sekolah" class="border p-2 w-full">
        </div>
        <div>
            <label class="text-xs font-medium">Alamat Domisili</label>
            <input type="text" wire:model="alamat_domisili" class="border p-2 w-full">
        </div>
        <div>
            <label class="text-xs font-medium">Alamat KK</label>
            <input type="text" wire:model="alamat_kk" class="border p-2 w-full">
        </div>
        <div>
            <label class="text-xs font-medium">Provinsi</label>
            <input type="text" wire:model="provinsi" class="border p-2 w-full">
        </div>
        <div>
            <label class="text-xs font-medium">Kota</label>
            <input type="text" wire:model="kota" class="border p-2 w-full">
        </div>
        <!-- New fields for name, email, and password -->
        <div>
            <label class="text-xs font-medium">Name</label>
            <input type="text" wire:model="name" class="border p-2 w-full">
        </div>
        <div>
            <label class="text-xs font-medium">Email</label>
            <input type="email" wire:model="email" class="border p-2 w-full">
        </div>
        <div>
            <label class="text-xs font-medium">Password</label>
            <input type="text" wire:model="password" class="border p-2 w-full">
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
            Cetak Kartu Peserta
        </button>

        <button wire:click="previewSuratKeterangan"
            class="mt-4 px-4 py-2 inline-flex justify-center items-center  bg-tertiary border border-transparent font-semibold text-xs text-white uppercase tracking-widest hover:bg-secondary hover:text-tertiary focus:bg-tertiary active:bg-tertiary active:border active:border-tertiary focus:outline-none focus:ring-2 focus:ring-tertiary focus:ring-offset-2  transition ease-in-out duration-150 rounded">
            Cetak Surat Keterangan
        </button>
    </div>



    @if (session()->has('message'))
        <p class="text-green-500 mt-2">{{ session('message') }}</p>
    @endif
</div>
