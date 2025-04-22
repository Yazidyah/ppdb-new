<div>
    {{-- @if (session()->has('message'))
        <div id="toast-warning"
            class="fixed top-5 left-1/2 transform -translate-x-1/2 z-50 flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow-sm"
            role="alert">
            <div
                class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-orange-500 bg-orange-100 rounded-lg">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
                </svg>
                <span class="sr-only">Warning icon</span>
            </div>
            <div class="ms-3 text-sm font-normal">{{ session('message') }}</div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8"
                onclick="closeToast()" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    @endif --}}

    <div class="flex w-3/4 items-center justify-center border-2 border-dasar2 rounded-lg py-2 gap-2 mx-auto">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-7 h-7">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
        </svg>
        <h1 class="block text-xs lg:text-base items-center text-center justify-center font-semibold">
            Peringatan : Isi Data Diri Anda yang Sebenar-benarnya.
        </h1>
    </div>

    <div class="flex w-3/4 mx-auto mt-4">
        <div class="md:grid flex flex-col grid-cols-4 grid-rows-2 gap-8 w-full">
            @foreach ($persyaratan as $data)
                <div class="flex flex-col col-span-1 row-span-1">
                    <h1>{{ $data->nama_persyaratan }}</h1>
                    @if (count($data->berkas) !== 0)
                        @forelse ($data->berkas->where('uploader_id', $user->id) as $berkas)
                            @livewire('pemberkasan.berkas', ['berkas' => $berkas, 'editable' => true], key($user->id . 'berkas' . $berkas->id))
                            <div>
                                <div class="flex gap-2">
                                    @if ($data->nama_persyaratan === 'Rapor MTs/SMP/ Sederajat')
                                        <button type="button" onclick="rapotModal()"
                                            class="mt-2 px-4 py-2 bg-tertiary hover:bg-secondary hover:text-tertiary text-white rounded-lg">
                                            Isi data rapot
                                        </button>
                                        <div class="mt-2 p-2 rounded-lg bg-gray-100">
                                            @if (!empty($rapot))
                                                @if ($rapot->nilai_rapot != null)
                                                    <p class="text-xs text-green-600 font-semibold">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="inline w-4 h-4 mr-1" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M5 13l4 4L19 7" />
                                                        </svg>
                                                        Data sudah diisi
                                                    </p>
                                                @endif
                                                @if ($rapot->nilai_rapot == null)
                                                    <p class="text-xs text-red-600 font-semibold">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="inline w-4 h-4 mr-1" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                        Data belum diisi
                                                    </p>
                                                @endif
                                            @else
                                                <p class="text-xs text-red-600 font-semibold">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4 mr-1"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                    Data belum diisi
                                                </p>
                                            @endif
                                        </div>
                                    @endif
                                    @if (isset($berkas) &&
                                            isset($berkas->id) &&
                                            $data->nama_persyaratan !== 'Pas Foto' &&
                                            $data->nama_persyaratan !== 'Rapor MTs/SMP/ Sederajat')
                                        <button type="button" onclick="berkasModal({{ $berkas->id }})"
                                            class="mt-2 px-4 py-2 bg-tertiary hover:bg-secondary hover:text-tertiary text-white rounded-lg">
                                            Isi data berkas
                                        </button>
                                        <div class="mt-2 p-2 rounded-lg bg-gray-100">
                                            @if ($berkas->data_berkas != null)
                                                <p class="text-xs text-green-600 font-semibold">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4 mr-1"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    Data sudah diisi
                                                </p>
                                            @endif
                                            @if ($berkas->data_berkas == null)
                                                <p class="text-xs text-red-600 font-semibold">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4 mr-1"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                    Data belum diisi
                                                </p>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            @if ($data->nama_persyaratan === 'Rapot MTs/SMP')
                                <div class="flex items-center justify-center w-full h-full">
                                    <label
                                        class="flex flex-col items-center justify-center w-full h-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-tertiary text-white hover:text-tertiary hover:bg-secondary">
                                        <div class="flex flex-col items-center justify-center py-5 ">
                                            <svg class="w-8 h-8 mb-4" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                            </svg>
                                            <p class="mb-2 text-sm"><span class="font-semibold">Tekan untuk
                                                    unggah</span>
                                            </p>
                                            <p class="text-xs">PDF (MAX. 3MB)</p>
                                        </div>
                                        <input wire:model="berkas" wire:change="setSyarat({{ $data->id_persyaratan }})"
                                            type="file" class="hidden" />
                                    </label>
                                </div>
                            @endif

                            @if ($data->nama_persyaratan !== 'Rapot MTs/SMP')
                                <div class="flex items-center justify-center w-full h-full">
                                    <label
                                        class="flex flex-col items-center justify-center w-full h-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-tertiary text-white hover:text-tertiary hover:bg-secondary">
                                        <div class="flex flex-col items-center justify-center py-5 ">
                                            <svg class="w-8 h-8 mb-4" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                            </svg>
                                            <p class="mb-2 text-sm"><span class="font-semibold">Tekan untuk
                                                    unggah</span>
                                            </p>
                                            <p class="text-xs">JPG,JPEG (MAX. 300KB)</p>
                                        </div>
                                        <input wire:model="berkas"
                                            wire:change="setSyarat({{ $data->id_persyaratan }})" type="file"
                                            class="hidden" />
                                    </label>
                                </div>
                            @endif
                        @endforelse
                    @endif
                    @if (count($data->berkas) === 0 or $data->berkas->contains(fn($berkas) => $berkas->trashed()))
                        @if ($data->nama_persyaratan === 'Rapot MTs/SMP')
                            <div class="flex items-center justify-center w-full h-full">
                                <label
                                    class="flex flex-col items-center justify-center w-full h-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-tertiary text-white hover:text-tertiary hover:bg-secondary">
                                    <div class="flex flex-col items-center justify-center py-5 ">
                                        <svg class="w-8 h-8 mb-4" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="mb-2 text-sm"><span class="font-semibold">Tekan untuk unggah</span>
                                        </p>
                                        <p class="text-xs">PDF (MAX. 3MB)</p>
                                    </div>
                                    <input wire:model="berkas" wire:change="setSyarat({{ $data->id_persyaratan }})"
                                        type="file" class="hidden" />
                                </label>
                            </div>
                        @endif
                        @if ($data->nama_persyaratan !== 'Rapot MTs/SMP')
                            <div class="flex items-center justify-center w-full h-full">
                                <label
                                    class="flex flex-col items-center justify-center w-full h-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-tertiary text-white hover:text-tertiary hover:bg-secondary">
                                    <div class="flex flex-col items-center justify-center py-5 ">
                                        <svg class="w-8 h-8 mb-4" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="mb-2 text-sm"><span class="font-semibold">Tekan untuk unggah</span>
                                        </p>
                                        <p class="text-xs">JPG,JPEG,PNG (MAX. 300KB)</p>
                                    </div>
                                    <input wire:model="berkas" wire:change="setSyarat({{ $data->id_persyaratan }})"
                                        type="file" class="hidden" />
                                </label>
                            </div>
                        @endif

                        @if ($data->nama_persyaratan === 'Rapot MTs/SMP')
                            @if (session()->has('error-rapot'))
                                <p class="text-red-500 text-xs mt-2">{{ session('error-rapot') }}</p>
                            @endif
                        @endif

                        @if ($data->nama_persyaratan === 'Pas Foto')
                            @if (session()->has('error-foto'))
                                <p class="text-red-500 text-xs mt-2">{{ session('error-foto') }}</p>
                            @endif
                        @endif

                        @if ($data->nama_persyaratan === 'Ijazah MTs/SMP')
                            @if (session()->has('error-ijazah'))
                                <p class="text-red-500 text-xs mt-2">{{ session('error-ijazah') }}</p>
                            @endif
                        @endif

                        @if ($data->nama_persyaratan === 'Kartu Keluarga')
                            @if (session()->has('error-kk'))
                                <p class="text-red-500 text-xs mt-2">{{ session('error-kk') }}</p>
                            @endif
                        @endif

                        @if ($data->nama_persyaratan === 'Akta Kelahiran')
                            @if (session()->has('error-akte'))
                                <p class="text-red-500 text-xs mt-2">{{ session('error-akte') }}</p>
                            @endif
                        @endif

                        @if ($data->nama_persyaratan === 'Sertifikat Akreditasi')
                            @if (session()->has('error-akreditasi'))
                                <p class="text-red-500 text-xs mt-2">{{ session('error-akreditasi') }}</p>
                            @endif
                        @endif
                    @endif
                    <button type="button" onclick="showExample('{{ $data->nama_persyaratan }}')"
                        class="mt-2 px-4 py-2 bg-tertiary hover:bg-secondary hover:text-tertiary text-white rounded-lg">
                        Lihat Contoh
                    </button>
                </div>
            @endforeach
        </div>
    </div>
    <div class="navigation-buttons justify-center flex items-center py-10 sm:py-6 px-2 sm:px-4 max-w-7xl mx-auto">
        <!-- <button wire:click="validateAndSubmit"
            class="px-3 w-full py-1 sm:px-6 sm:py-2 flex items-center justify-center hover:bg-secondary rounded-xl text-secondary font-medium bg-tertiary hover:text-tertiary"
            type="button" id="submitBtn">Lanjutkan ke tahap verifikasi</button> -->
        <button onclick="window.location.href='/siswa/daftar-step-empat?t=1'"
            class="px-3 w-full py-1 sm:px-6 sm:py-2 flex items-center justify-center hover:bg-secondary rounded-xl text-secondary font-medium bg-tertiary hover:text-tertiary"
            type="button" id="submitBtn">Lanjutkan ke tahap verifikasi</button>
    </div>
</div>

<script>
    function handleFileUpload(event, labelId) {
        const file = event.target.files[0];
        if (file) {
            document.getElementById(labelId).innerText = file.name;
        }
    }

    function rapotModal() {
        Livewire.dispatch('openRapotModal');
    }

    function berkasModal(id) {
        console.log('Opening berkas modal with ID:', id);
        Livewire.dispatch('openBerkasModal', {
            id: id
        });
    }

    // Fungsi untuk menampilkan contoh file
    function showExample(type) {
        const exampleModal = document.getElementById('exampleModal');
        const exampleImage = document.getElementById('exampleImage');

        // Tentukan URL gambar contoh berdasarkan jenis file
        let exampleFiles = {
            "Pas Foto": "/contoh_berkas/contoh-pas-foto.jpg",
            "Kartu Pelajar": "/contoh_berkas/Contoh Kartu Pelajar.jpg",
            "Ijazah SMP/MTs": "/contoh_berkas/Contoh Ijazah.jpeg",
            "Rapot MTs/SMP": "/contoh_berkas/Contoh Rapot.webp",
            "Kartu Keluarga": "/logoman.webp",
            "Piagam Akreditasi Sekolah Asal": "https://example.com/contoh-pasfoto.jpg",
            "Piagam Kejuaraan": "https://example.com/contoh-pasfoto.jpg",
            // Tambahkan contoh file lainnya di sini...
        };

        exampleImage.src = exampleFiles[type] || "https://via.placeholder.com/300";
        exampleModal.classList.remove('hidden');
    }

    // Fungsi untuk menutup modal contoh file
    function closeExample() {
        document.getElementById('exampleModal').classList.add('hidden');
    }

    // Fungsi untuk menutup toast
    function closeToast() {
        document.getElementById('toast-warning').classList.add('hidden');
    }
</script>
