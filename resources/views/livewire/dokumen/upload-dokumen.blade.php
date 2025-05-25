<div>
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
                    <h1 class="flex items-center gap-2 relative group">
                        {{ $data->nama_persyaratan }}
                        <button data-tooltip-target="tooltip-top-{{ $data->id_persyaratan }}"
                            data-tooltip-placement="top" type="button" class="text-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="size-5">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-7-4a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM9 9a.75.75 0 0 0 0 1.5h.253a.25.25 0 0 1 .244.304l-.459 2.066A1.75 1.75 0 0 0 10.747 15H11a.75.75 0 0 0 0-1.5h-.253a.25.25 0 0 1-.244-.304l.459-2.066A1.75 1.75 0 0 0 9.253 9H9Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div id="tooltip-top-{{ $data->id_persyaratan }}" role="tooltip"
                            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
                            {{ $data->deskripsi }}
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </h1>
                    @if (count($data->berkas) !== 0)
                        @forelse ($data->berkas->where('uploader_id', $user->id)->where('deleted_at',null) as $berkas)
                            @livewire('pemberkasan.berkas', ['berkas' => $berkas, 'editable' => true], key($user->id . '-berkas-' . $berkas->id))
                            <div>
                                <div class="flex gap-2">
                                    @if (Str::contains(Str::lower($data->nama_persyaratan), 'rapot'))
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
                                    @if (isset($berkas) && isset($berkas->id) && !$data->is_simple)
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
                            @if (Str::of($data->nama_persyaratan)->lower()->contains('rapot'))
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
                            @elseif (Str::of($data->nama_persyaratan)->lower()->contains('pas foto'))
                                <div class="flex items-center justify-center w-full h-full">
                                    <label
                                        class="flex flex-col items-center justify-center w-full h-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-tertiary text-white hover:text-tertiary hover:bg-secondary">
                                        <div class="flex flex-col items-center justify-center py-5 ">
                                            <svg class="w-8 h-8 mb-4" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                            </svg>
                                            <p class="mb-2 text-sm"><span class="font-semibold">Tekan untuk
                                                    unggah</span>
                                            </p>
                                            <p class="text-xs">JPG, JPEG (MAX. 200KB)</p>
                                        </div>
                                        <input wire:model="berkas"
                                            wire:change="setSyarat({{ $data->id_persyaratan }})" type="file"
                                            class="hidden" />
                                    </label>
                                </div>
                            @elseif (!Str::of($data->nama_persyaratan)->lower()->contains('rapot '))
                                <div class="flex items-center justify-center w-full h-full">
                                    <label
                                        class="flex flex-col items-center justify-center w-full h-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-tertiary text-white hover:text-tertiary hover:bg-secondary">
                                        <div class="flex flex-col items-center justify-center py-5 ">
                                            <svg class="w-8 h-8 mb-4" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                            </svg>
                                            <p class="mb-2 text-sm"><span class="font-semibold">Tekan untuk
                                                    unggah</span>
                                            </p>
                                            <p class="text-xs">PDF (MAX. 200KB)</p>
                                        </div>
                                        <input wire:model="berkas"
                                            wire:change="setSyarat({{ $data->id_persyaratan }})" type="file"
                                            class="hidden" />
                                    </label>
                                </div>
                            @endif
                        @endforelse
                    @endif
                    @if (Str::contains(Str::lower($data->nama_persyaratan), 'ijazah'))
                        @if (session()->has('error-ijazah'))
                            <p class="text-red-500 text-xs mt-2">{{ session('error-ijazah') }}</p>
                        @endif
                    @endif
                    @if (Str::contains(Str::lower($data->nama_persyaratan), 'rapot'))
                        @if (session()->has('error-rapot'))
                            <p class="text-red-500 text-xs mt-2">{{ session('error-rapot') }}</p>
                        @endif
                    @endif

                    @if (Str::contains(Str::lower($data->nama_persyaratan), 'pas foto'))
                        @if (session()->has('error-foto'))
                            <p class="text-red-500 text-xs mt-2">{{ session('error-foto') }}</p>
                        @endif
                    @endif

                    @if (Str::contains(Str::lower($data->nama_persyaratan), 'kartu keluarga'))
                        @if (session()->has('error-kk'))
                            <p class="text-red-500 text-xs mt-2">{{ session('error-kk') }}</p>
                        @endif
                    @endif

                    @if (Str::contains(Str::lower($data->nama_persyaratan), 'akta kelahiran'))
                        @if (session()->has('error-akte'))
                            <p class="text-red-500 text-xs mt-2">{{ session('error-akte') }}</p>
                        @endif
                    @endif

                    @if (Str::contains(Str::lower($data->nama_persyaratan), 'sertifikat akreditasi'))
                        @if (session()->has('error-akreditasi'))
                            <p class="text-red-500 text-xs mt-2">{{ session('error-akreditasi') }}</p>
                        @endif
                    @endif

                    @if (Str::contains(Str::lower($data->nama_persyaratan), 'sertifikat prestasi'))
                        @if (session()->has('error-prestasi'))
                            <p class="text-red-500 text-xs mt-2">{{ session('error-prestasi') }}</p>
                        @endif
                    @endif

                    @if (Str::contains(Str::lower($data->nama_persyaratan), 'nisn'))
                        @if (session()->has('error-nisn'))
                            <p class="text-red-500 text-xs mt-2">{{ session('error-nisn') }}</p>
                        @endif
                    @endif

                    @if (Str::contains(Str::lower($data->nama_persyaratan), 'kip'))
                        @if (session()->has('error-kip'))
                            <p class="text-red-500 text-xs mt-2">{{ session('error-kip') }}</p>
                        @endif
                    @endif

                    @if (Str::contains(Str::lower($data->nama_persyaratan), 'tabungan'))
                        @if (session()->has('error-tabungan'))
                            <p class="text-red-500 text-xs mt-2">{{ session('error-tabungan') }}</p>
                        @endif
                    @endif

                    @if (Str::contains(Str::lower($data->nama_persyaratan), 'psikolog'))
                        @if (session()->has('error-psikolog'))
                            <p class="text-red-500 text-xs mt-2">{{ session('error-psikolog') }}</p>
                        @endif
                    @endif
                    {{-- @if (count($data->berkas) === 0 or $data->berkas->contains(fn($berkas) => $berkas->trashed()))
                        @if ($data->nama_persyaratan === 'Rapot MTs/SMP (Sem 1-5)')
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
                        @elseif ($data->nama_persyaratan === 'Pas Foto')
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
                                        <p class="text-xs">JPG,JPEG,PNG (MAX. 200KB)</p>
                                    </div>
                                    <input wire:model="berkas" wire:change="setSyarat({{ $data->id_persyaratan }})"
                                        type="file" class="hidden" />
                                </label>
                            </div>
                        @elseif ($data->nama_persyaratan !== 'Rapot MTs/SMP (Sem 1-5)')
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
                                        <p class="text-xs">PDF (MAX. 200KB)</p>
                                    </div>
                                    <input wire:model="berkas" wire:change="setSyarat({{ $data->id_persyaratan }})"
                                        type="file" class="hidden" />
                                </label>
                            </div>
                        @endif
                        @if (Str::contains(Str::lower($data->nama_persyaratan), 'ijazah'))
                            @if (session()->has('error-ijazah'))
                                <p class="text-red-500 text-xs mt-2">{{ session('error-ijazah') }}</p>
                            @endif
                        @endif
                        @if (Str::contains(Str::lower($data->nama_persyaratan), 'rapot'))
                            @if (session()->has('error-rapot'))
                                <p class="text-red-500 text-xs mt-2">{{ session('error-rapot') }}</p>
                            @endif
                        @endif

                        @if (Str::contains(Str::lower($data->nama_persyaratan), 'pas foto'))
                            <p>tes</p>
                            @if (session()->has('error-foto'))
                                <p class="text-red-500 text-xs mt-2">{{ session('error-foto') }}</p>
                            @endif
                        @endif

                        @if (Str::contains(Str::lower($data->nama_persyaratan), 'kartu keluarga'))
                            @if (session()->has('error-kk'))
                                <p class="text-red-500 text-xs mt-2">{{ session('error-kk') }}</p>
                            @endif
                        @endif

                        @if (Str::contains(Str::lower($data->nama_persyaratan), 'akta kelahiran'))
                            @if (session()->has('error-akte'))
                                <p class="text-red-500 text-xs mt-2">{{ session('error-akte') }}</p>
                            @endif
                        @endif

                        @if (Str::contains(Str::lower($data->nama_persyaratan), 'sertifikat akreditasi'))
                            @if (session()->has('error-akreditasi'))
                                <p class="text-red-500 text-xs mt-2">{{ session('error-akreditasi') }}</p>
                            @endif
                        @endif

                        @if (Str::contains(Str::lower($data->nama_persyaratan), 'sertifikat prestasi'))
                            @if (session()->has('error-prestasi'))
                                <p class="text-red-500 text-xs mt-2">{{ session('error-prestasi') }}</p>
                            @endif
                        @endif

                        @if (Str::contains(Str::lower($data->nama_persyaratan), 'nisn'))
                            @if (session()->has('error-nisn'))
                                <p class="text-red-500 text-xs mt-2">{{ session('error-nisn') }}</p>
                            @endif
                        @endif

                        @if (Str::contains(Str::lower($data->nama_persyaratan), 'kip'))
                            @if (session()->has('error-kip'))
                                <p class="text-red-500 text-xs mt-2">{{ session('error-kip') }}</p>
                            @endif
                        @endif

                        @if (Str::contains(Str::lower($data->nama_persyaratan), 'tabungan'))
                            @if (session()->has('error-tabungan'))
                                <p class="text-red-500 text-xs mt-2">{{ session('error-tabungan') }}</p>
                            @endif
                        @endif

                        @if (Str::contains(Str::lower($data->nama_persyaratan), 'psikolog'))
                            @if (session()->has('error-psikolog'))
                                <p class="text-red-500 text-xs mt-2">{{ session('error-psikolog') }}</p>
                            @endif
                        @endif
                    @endif --}}
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
        @if ($isRapotLengkap == true)
            <button onclick="window.location.href='/siswa/daftar-step-empat?t=1'"
                class="px-3 w-full py-1 sm:px-6 sm:py-2 flex items-center justify-center hover:bg-secondary rounded-xl text-secondary font-medium bg-tertiary hover:text-tertiary"
                type="button" id="submitBtn">Lanjutkan ke tahap verifikasi</button>
        @endif
        @if ($isRapotLengkap == false)
            <button onclick="window.location.href='/siswa/daftar-step-empat?t=1'"
                class="px-3 w-full py-1 sm:px-6 sm:py-2 flex items-center justify-center hover:bg-secondary rounded-xl text-secondary font-medium bg-tertiary hover:text-tertiary cursor-not-allowed relative group"
                type="button" id="submitBtn" disabled>
                Lanjutkan ke tahap verifikasi
                <span
                    class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-3 py-2 text-xs text-white bg-gray-700 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity">
                    Pastikan semua data rapot telah diisi untuk melanjutkan
                </span>
            </button>
        @endif
        {{-- <button onclick="window.location.href='/siswa/daftar-step-empat?t=1'"
            class="px-3 w-full py-1 sm:px-6 sm:py-2 flex items-center justify-center hover:bg-secondary rounded-xl text-secondary font-medium bg-tertiary hover:text-tertiary"
            type="button" id="submitBtn">Lanjutkan ke tahap verifikasi</button> --}}
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
            "NISN": "/contoh_berkas/contoh-nisn.png",
            "Akta Kelahiran": "/contoh_berkas/contoh-akta.png",
            "Kartu Pelajar": "/contoh_berkas/contoh-kartu-pelajar.jpg",
            "Rapot MTs/SMP (Sem 1-5)": "/contoh_berkas/cover-rapot.png",
            "Rapor %": "/contoh_berkas/cover-rapot.png",
            "Raport %": "/contoh_berkas/cover-rapot.png",
            "Kartu Keluarga": "/contoh_berkas/contoh-kk.jpg",
            "Sertifikat Akreditasi": "/contoh_berkas/contoh-sertifikat-akreditasi.png",
            "KIP/KKS/PKH": "/contoh_berkas/contoh-kip.png",
            // Tambahkan contoh file lainnya di sini...
        };

        // Gunakan default-image.jpg jika contoh file tidak ditemukan
        exampleImage.src = exampleFiles[type] || "/default-no-image.png";
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
