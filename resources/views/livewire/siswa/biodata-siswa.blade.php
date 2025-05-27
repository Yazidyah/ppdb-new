<div>
    {{-- Do your work, then step back. --}}
    <div class="steps max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex w-3/4 items-center justify-center border-2 border-tertiary rounded-lg py-2 gap-2 mx-auto">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-7 h-7">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
            </svg>
            <div class="">
                <h1 class="max-w-7xl block text-xs lg:text-base items-center text-center justify-center font-semibold ">
                    Peringatan
                    :
                    Isi Data Diri Anda yang Sebenar-benarnya.</h1>
            </div>



        </div>
        <div class="">
            <h1 class="font-semibold py-2 ">Informasi Pribadi</h1>
            <div>
                {{-- @livewire('pemberkasan.uploader', ['kategori' => $kb, 'model' => $siswa, 'editable' => true],
                key($siswa->id . '-testing-')) --}}
            </div>
            <div class="">
                <div class="md:flex gap-3 w-full">
                    <!-- Left Column -->
                    <div class="md:grid flex flex-col grid-cols-4 grid-rows-4 gap-8 py-2 w-full">
                        <!-- Nama Lengkap -->
                        <div class="col-span-4 mt-2">
                            <x-reg-input-label>Nama Lengkap</x-reg-input-label>
                            <div
                                class="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-tertiary focus-within:ring-2 focus-within:ring-inset focus-within:ring-tertiary">
                                <x-reg-input-text id="nama_lengkap"
                                    class=" block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full"
                                    type="text" name="nama_lengkap" required autofocus autocomplete="nama_lengkap"
                                    placeholder="Nama Lengkap" wire:model.live="nama_lengkap" />
                            </div>
                            @error('nama_lengkap')
                                <span class="text-xs text-red-500 flex items-center mx-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- NIK -->
                        <div class="col-span-2 mt-2">
                            <x-reg-input-label>NIK</x-reg-input-label>
                            <div
                                class="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-tertiary focus-within:ring-2 focus-within:ring-inset focus-within:ring-tertiary">
                                <x-reg-input-text id="NIK"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full"
                                    type="tel" name="NIK" required autofocus autocomplete="NIK"
                                    placeholder="NIK" wire:model.live="NIK" inputmode="numeric" pattern="[0-9]*"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="16" />
                            </div>
                            @error('NIK')
                                <span class="text-xs text-red-500 flex items-center mx-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- NISN -->
                        <div class="col-span-2 mt-2">
                            <x-reg-input-label>NISN</x-reg-input-label>
                            <div
                                class="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-tertiary focus-within:ring-2 focus-within:ring-inset focus-within:ring-tertiary">
                                <x-reg-input-text id="NISN"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full"
                                    type="tel" name="NISN" required autofocus autocomplete="NISN"
                                    placeholder="NISN" wire:model.live="NISN" inputmode="numeric" pattern="[0-9]*"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="10" />
                            </div>
                            @error('NISN')
                                <span class="text-xs text-red-500 flex items-center mx-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- NPSN -->
                        <div class="col-span-2 mt-2">
                            <x-reg-input-label>NPSN</x-reg-input-label>
                            <div
                                class="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-tertiary focus-within:ring-2 focus-within:ring-inset focus-within:ring-tertiary">
                                <x-reg-input-text id="NPSN"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full"
                                    type="text" name="NPSN" required autofocus autocomplete="NPSN"
                                    placeholder="NPSN" wire:model="NPSN" maxlength="8" />
                                <button wire:click="searchByNpsn" wire:loading.attr="disabled"
                                    wire:target="searchByNpsn"
                                    class="ml-2 px-4 py-2 bg-green-500 text-white rounded-md flex items-center">
                                    <span wire:loading.remove wire:target="searchByNpsn">Cek Sekolah</span>
                                    <span wire:loading wire:target="searchByNpsn" class="flex items-center">
                                        Memproses...
                                    </span>
                                </button>
                            </div>
                            @error('NPSN')
                                <span class="text-xs text-red-500 flex items-center mx-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- ASAL SEKOLAH -->
                        <div class="col-span-2 mt-2">
                            <x-reg-input-label>Asal Sekolah</x-reg-input-label>
                            <div
                                class="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-tertiary focus-within:ring-2 focus-within:ring-inset focus-within:ring-tertiary">
                                <x-reg-input-text id="sekolah_asal"
                                    class="block flex-1 border-0 py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full bg-gray-300"
                                    disabled="disabled" type="text" name="sekolah_asal" required autofocus
                                    autocomplete="sekolah_asal" placeholder="Asal Sekolah"
                                    value="{{ strtoupper($sekolah_asal) }}" />
                            </div>
                            @error('sekolah_asal')
                                <span class="text-xs text-red-500 flex items-center mx-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Predikat Akreditasi Sekolah -->
                        <div class="col-span-2 mt-2">
                            <x-reg-input-label>Predikat Akreditasi Sekolah</x-reg-input-label>
                            <div
                                class="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-tertiary focus-within:ring-2 focus-within:ring-inset focus-within:ring-tertiary">
                                <select id="predikat_akreditasi_sekolah" name="predikat_akreditasi_sekolah"
                                    wire:model.live="predikat_akreditasi_sekolah"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full">
                                    <option value="" disabled="disabled">Pilih Predikat Akreditasi</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="Belum Terakreditasi">Belum Terakreditasi</option>
                                </select>
                            </div>
                            @error('predikat_akreditasi_sekolah')
                                <span class="text-xs text-red-500 flex items-center mx-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Nilai Akreditasi Sekolah -->
                        <div class="col-span-2 mt-2">
                            <x-reg-input-label>Nilai Akreditasi Sekolah</x-reg-input-label>
                            <div
                                class="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-tertiary focus-within:ring-2 focus-within:ring-inset focus-within:ring-tertiary">
                                <x-reg-input-text id="nilai_akreditasi_sekolah"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full"
                                    type="text" name="nilai_akreditasi_sekolah" required autofocus
                                    autocomplete="nilai_akreditasi_sekolah"
                                    placeholder="Isi '0' jika belum terakreditasi"
                                    wire:model.live="nilai_akreditasi_sekolah" inputmode="decimal"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '');" />
                            </div>
                            @error('nilai_akreditasi_sekolah')
                                <span class="text-xs text-red-500 flex items-center mx-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!-- Right Column -->
                    <div class="md:grid flex flex-col grid-cols-4 grid-rows-4 gap-8 py-2 w-full">
                        <!-- Jenis Kelamin -->
                        <div class="col-span-2 mt-2">
                            <x-reg-input-label>Jenis Kelamin</x-reg-input-label>
                            <ul
                                class="items-center w-full h-full text-sm font-medium rounded-lg sm:flex ring-1 ring-inset ring-tertiary focus-within:ring-2 focus-within:ring-inset focus-within:ring-tertiary">
                                <li class="w-full border-b border-gray-500 sm:border-b-0 sm:border-r">
                                    <div class="flex items-center ps-3">
                                        <input id="horizontal-list-radio-l" type="radio" name="jenis_kelamin"
                                            value="L" wire:model.live="jenis_kelamin"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                        <label for="horizontal-list-radio-l"
                                            class="w-full py-3 ms-2 text-sm font-medium text-gray-900">Laki-laki</label>
                                    </div>
                                </li>
                                <li class="w-full">
                                    <div class="flex items-center ps-3">
                                        <input id="horizontal-list-radio-p" type="radio" name="jenis_kelamin"
                                            value="P" wire:model.live="jenis_kelamin"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                        <label for="horizontal-list-radio-p"
                                            class="w-full py-3 ms-2 text-sm font-medium text-gray-900">Perempuan</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- Nomor Telepon -->
                        <div class="col-span-2 mt-2">
                            <x-reg-input-label>Nomor Telepon</x-reg-input-label>
                            <div
                                class="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-tertiary focus-within:ring-2 focus-within:ring-inset focus-within:ring-tertiary">
                                <x-reg-input-text id="no_telp"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full"
                                    type="tel" name="no_telp" required autofocus autocomplete="no_telp"
                                    placeholder="Nomor Telepon" wire:model.live="no_telp" inputmode="numeric"
                                    pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                    maxlength="15" />
                            </div>
                            @error('no_telp')
                                <span class="text-xs text-red-500 flex items-center mx-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Alamat KK -->
                        <div class="col-span-2 mt-2">
                            <x-reg-input-label>Alamat KK</x-reg-input-label>
                            <div
                                class="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-tertiary focus-within:ring-2 focus-within:ring-inset focus-within:ring-tertiary">
                                <x-reg-input-text id="alamat_kk"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full"
                                    type="text" name="alamat_kk" required autofocus autocomplete="alamat_kk"
                                    placeholder="Alamat KK" wire:model.live='alamat_kk' />
                            </div>
                            @error('alamat_kk')
                                <span class="text-xs text-red-500 flex items-center mx-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Alamat Domisili -->
                        <div class="col-span-2 mt-2">
                            <x-reg-input-label class="flex items-center justify-between">Alamat Domisili
                                <label class="ml-2 flex items-center">
                                    <input type="checkbox" wire:click="toggleAlamatDomisili" class="mr-1"
                                        {{ $alamat_domisili_disabled ? 'checked' : '' }}>
                                    <span class="text-xs">Sama dengan Alamat KK</span>
                                </label>
                            </x-reg-input-label>
                            <div
                                class="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-tertiary focus-within:ring-2 focus-within:ring-inset focus-within:ring-tertiary">
                                <x-reg-input-text id="alamat_domisili" :value="$alamat_domisili" wire:model="alamat_domisili"
                                    class="block flex-1 border-0 py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full {{ $alamat_domisili_disabled ? 'bg-gray-300' : 'bg-transparent' }}"
                                    type="text" name="alamat_domisili" required autofocus
                                    autocomplete="alamat_domisili" placeholder="Alamat Domisili" :disabled="$alamat_domisili_disabled" />
                            </div>
                            @error('alamat_domisili')
                                <span class="text-xs text-red-500 flex items-center mx-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Provinsi -->
                        <div class="col-span-2 mt-2">
                            <x-reg-input-label>Provinsi Tinggal</x-reg-input-label>
                            <div
                                class="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-tertiary focus-within:ring-2 focus-within:ring-inset focus-within:ring-tertiary">
                                <select id="provinsi" name="provinsi" wire:model.live="provinsi"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full">
                                    <option value="" disabled="disabled">Pilih Provinsi</option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province['id'] }}">{{ $province['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('provinsi')
                                <span class="text-xs text-red-500 flex items-center mx-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Kota/Kab -->
                        <div class="col-span-2 mt-2">
                            <x-reg-input-label>Kota/Kab Tinggal</x-reg-input-label>
                            <div
                                class="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-tertiary focus-within:ring-2 focus-within:ring-inset focus-within:ring-tertiary">
                                <select id="kota" name="kota" wire:model.live="kota"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full">
                                    <option value="" disabled="disabled">Pilih Kota/Kab</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city['id'] }}">{{ $city['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('kota')
                                <span class="text-xs text-red-500 flex items-center mx-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Tempat Lahir -->
                        <div class="col-span-2 mt-2">
                            <x-reg-input-label>Tempat Lahir</x-reg-input-label>
                            <div
                                class="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-tertiary focus-within:ring-2 focus-within:ring-inset focus-within:ring-tertiary">
                                <x-reg-input-text id="tempat_lahir"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full"
                                    type="text" name="tempat_lahir" required autofocus autocomplete="tempat_lahir"
                                    placeholder="Tempat Lahir" wire:model.live='tempat_lahir' />
                            </div>
                            @error('tempat_lahir')
                                <span class="text-xs text-red-500 flex items-center mx-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Tanggal Lahir -->
                        <div class="col-span-2 mt-2">
                            <x-reg-input-label>Tanggal Lahir</x-reg-input-label>
                            <div
                                class="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-tertiary focus-within:ring-2 focus-within:ring-inset focus-within:ring-tertiary">
                                <x-reg-input-text id="tanggal_lahir"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full"
                                    type="date" name="tanggal_lahir" required autofocus
                                    autocomplete="tanggal_lahir" placeholder="Tanggal Lahir"
                                    wire:model.live='tanggal_lahir' min="{{ now()->subYears(21)->format('Y-m-d') }}"
                                    max="{{ now()->subYears(13)->format('Y-m-d') }}" />
                            </div>
                            @error('tanggal_lahir')
                                <span class="text-xs text-red-500 flex items-center mx-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
