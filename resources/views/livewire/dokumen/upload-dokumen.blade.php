<div>
    {{-- Be like water. --}}
    {{-- <form method="post" action="{{ route('register') }}" id="multiStepForm" enctype="multipart/form-data">
        @csrf --}}
    <!-- Step 1 - Data Diri-->
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
                                <button type="button" onclick="showExample('{{ $data->nama_persyaratan }}')"
                                    class="mt-2 px-4 py-2 bg-tertiary hover:bg-secondary hover:text-tertiary text-white rounded-lg">
                                    Lihat Contoh
                                </button>
                                @if ($data->nama_persyaratan === 'Rapot')
                                    <button type="button" onclick="rapotModal()"
                                        class="mt-2 px-4 py-2 bg-tertiary hover:bg-secondary hover:text-tertiary text-white rounded-lg">
                                        Isi data rapot
                                    </button>
                                @else
                                    @if (isset($berkas) && isset($berkas->id))
                                        <button type="button" onclick="berkasModal({{ $berkas->id }})"
                                            class="mt-2 px-4 py-2 bg-tertiary hover:bg-secondary hover:text-tertiary text-white rounded-lg">
                                            Isi data berkas
                                        </button>
                                    @endif
                                @endif
                            </div>
                        @empty
                            <div class="flex items-center justify-center w-full h-full">
                                <label
                                    class="flex flex-col items-center justify-center w-full h-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-tertiary text-white hover:text-tertiary hover:bg-secondary">
                                    <div class="flex flex-col items-center justify-center py-5 ">
                                        <svg class="w-8 h-8 mb-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="mb-2 text-sm"><span class="font-semibold">Click to upload</span> or
                                            drag
                                            and
                                            drop</p>
                                        <p class="text-xs">SVG, PNG, JPG, or GIF (MAX. 800x400px)</p>
                                    </div>
                                    <input wire:model.live="berkas" wire:change="setSyarat({{ $data->id_persyaratan }})"
                                        type="file" class="hidden" />
                                </label>
                            </div>
                        @endforelse
                    @endif
                    @if (count($data->berkas) === 0)
                        <div class="flex items-center justify-center w-full h-full">
                            <label
                                class="flex flex-col items-center justify-center w-full h-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-tertiary text-white hover:text-tertiary hover:bg-secondary">
                                <div class="flex flex-col items-center justify-center py-5 ">
                                    <svg class="w-8 h-8 mb-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                    </svg>
                                    <p class="mb-2 text-sm"><span class="font-semibold">Click to upload</span> or
                                        drag
                                        and
                                        drop</p>
                                    <p class="text-xs">SVG, PNG, JPG, or GIF (MAX. 800x400px)</p>
                                </div>
                                <input wire:model.live="berkas" wire:change="setSyarat({{ $data->id_persyaratan }})"
                                    type="file" class="hidden" />
                            </label>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    </form>
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
            "Pas Foto 3x4": "/contoh-pas-foto.jpg",
            "Kartu Keluarga": "/logoman.webp",
            "Akte Kelahiran": "https://example.com/contoh-pasfoto.jpg",
            "Rapor Semester 1-5": "https://example.com/contoh-pasfoto.jpg",
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
</script>
