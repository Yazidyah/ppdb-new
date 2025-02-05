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
                {{-- @livewire('pemberkasan.uploader', ['kategori' => $kb, 'model' => $siswa, 'editable' => true], key($siswa->id . '-testing-')) --}}
            </div>
            <div class="">
                <div class="md:flex gap-3 w-full">
                    <!-- Left Column -->
                    <div class="md:grid flex flex-col grid-cols-4 grid-rows-4 gap-4 py-2 w-full">
                        <!-- Nama Lengkap -->
                        <div class="col-span-4">
                            <div
                                class="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-tertiary focus-within:ring-2 focus-within:ring-inset focus-within:ring-tertiary">
                                <x-reg-input-text id="nama_lengkap" class=" flex-1 border-l-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400
                                focus:ring-0 sm:text-sm sm:leading-6 w-full" type="text" name="nama_lengkap" required autofocus autocomplete="nama_lengkap"
                                placeholder="Nama Lengkap" wire:model.live="nama_lengkap" />
                                @error('nama_lengkap')
                                        <span class="text-xs text-red-500 flex items-center mx-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                        </div>

                        <!-- NIK -->
                        <div class="col-span-2">
                            <div
                                class="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-tertiary focus-within:ring-2 focus-within:ring-inset focus-within:ring-tertiary">
                                <x-reg-input-text id="NIK"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full"
                                    type="tel" name="NIK" required autofocus autocomplete="NIK"
                                    placeholder="NIK" wire:model.live="nik" />
                                    @error('nik')
                                        <span class="text-xs text-red-500 flex items-center mx-1">{{ $message }}</span>
                                    @enderror
                            </div>

                        </div>

                        <!-- NISN -->
                        <div class="col-span-2">
                            <div
                                class="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-tertiary focus-within:ring-2 focus-within:ring-inset focus-within:ring-tertiary">
                                <x-reg-input-text id="NISN"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full"
                                    type="tel" name="NISN" required autofocus autocomplete="NISN"
                                    placeholder="NISN" wire:model.live="nisn" />
                                    @error('nisn')
                                        <span class="text-xs text-red-500 flex items-center mx-1">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>

                        <!-- NPSN -->
                        <div class="col-span-2">
                            <div
                                class="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-tertiary focus-within:ring-2 focus-within:ring-inset focus-within:ring-tertiary">
                                <x-reg-input-text id="NPSN"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full"
                                    type="tel" name="NPSN" required autofocus autocomplete="NPSN"
                                    placeholder="NPSN" wire:model.live="npsn" />
                                    @error('npsn')
                                        <span class="text-xs text-red-500 flex items-center mx-1">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>

                        <!-- ASAL SEKOLAH -->
                        <div class="col-span-2">
                            <div
                                class="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-tertiary focus-within:ring-2 focus-within:ring-inset focus-within:ring-tertiary">
                                <x-reg-input-text id="sekolah_asal"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full"
                                    type="text" name="sekolah_asal" required autofocus autocomplete="sekolah_asal"
                                    placeholder="Asal Sekolah" wire:model.live="sekolah_asal" />
                                    @error('sekolah_asal')
                                        <span class="text-xs text-red-500 flex items-center mx-1">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>

                        <!-- Nomor Telepon -->
                        <div class="col-span-4">
                            <x-reg-input-label>Nomor Telepon</x-reg-input-label>
                            <div
                                class="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-tertiary focus-within:ring-2 focus-within:ring-inset focus-within:ring-tertiary">
                                <x-reg-input-text id="no_telp"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full"
                                    type="tel" name="no_telp" required autofocus autocomplete="no_telp"
                                    placeholder="Nomor Telepon" wire:model.live="no_telp" />
                                    @error('no_telp')
                                        <span class="text-xs text-red-500 flex items-center mx-1">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="md:grid flex flex-col grid-cols-4 grid-rows-4 gap-4 py-2 w-full">
                        <!-- Jenis Kelamin -->
                        <div class="col-span-4">
                            <div class="flex items-center justify-center gap-2">
                                <p>Jenis Kelamin:</p>
                                <div class="flex items-center justify-center gap-2">
                                    <label class="text-xs">
                                        <input type="radio" name="jenis_kelamin" value="L"
                                            wire:model.live="jenis_kelamin"> Laki-laki
                                    </label>
                                    <label class="text-xs">
                                        <input type="radio" name="jenis_kelamin" value="P"
                                            wire:model.live="jenis_kelamin"> Perempuan
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Alamat Domisili -->
                        <div class="col-span-2">
                            <div
                                class="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-tertiary focus-within:ring-2 focus-within:ring-inset focus-within:ring-tertiary">
                                <x-reg-input-text id="alamat_domisili"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full"
                                    type="text" name="alamat_domisili" required autofocus
                                    autocomplete="alamat_domisili" placeholder="Alamat Domisili"
                                    wire:model.live='alamat_domisili' />
                                    @error('alamat_domisili')
                                        <span class="text-xs text-red-500 flex items-center mx-1">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>

                        <!-- Alamat KK -->
                        <div class="col-span-2">
                            <div
                                class="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-tertiary focus-within:ring-2 focus-within:ring-inset focus-within:ring-tertiary">
                                <x-reg-input-text id="alamat_kk"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full"
                                    type="text" name="alamat_kk" required autofocus autocomplete="alamat_kk"
                                    placeholder="Alamat KK" wire:model.live='alamat_kk' />
                                    @error('alamat_kk')
                                        <span class="text-xs text-red-500 flex items-center mx-1">{{ $message }}</span>
                                    @enderror
                            </div>

                        </div>

                        <!-- Provinsi -->
                        <div class="col-span-2">
                            <div
                                class="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-tertiary focus-within:ring-2 focus-within:ring-inset focus-within:ring-tertiary">
                                <select id="provinsi" name="provinsi" wire:model.live="provinsi"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full">
                                    <option value=""disabled="disabled">Pilih Provinsi</option>
                                    @foreach($provinces as $province)
                                        <option value="{{ $province['id'] }}">{{ $province['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('provinsi')
                                    <span class="text-xs text-red-500 flex items-center mx-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Kota/Kab -->
                        <div class="col-span-2">
                            <div
                                class="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-tertiary focus-within:ring-2 focus-within:ring-inset focus-within:ring-tertiary">
                                <select id="kota" name="kota" wire:model.live="kota"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full">
                                    <option value="" disabled="disabled" >Pilih Kota/Kab</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city['id'] }}">{{ $city['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('kota')
                                    <span class="text-xs text-red-500 flex items-center mx-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Tempat Lahir -->
                        <div class="col-span-2">
                            <x-reg-input-label>Tempat Lahir</x-reg-input-label>
                            <div
                                class="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-tertiary focus-within:ring-2 focus-within:ring-inset focus-within:ring-tertiary">
                                <x-reg-input-text id="tempat_lahir"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full"
                                    type="text" name="tempat_lahir" required autofocus autocomplete="tempat_lahir"
                                    placeholder="Tempat Lahir" wire:model.live='tempat_lahir' />
                                    @error('tempat_lahir')
                                        <span class="text-xs text-red-500 flex items-center mx-1">{{ $message }}</span>
                                    @enderror
                            </div>

                        </div>

                        <!-- Tanggal Lahir -->
                        <div class="col-span-2">
                            <x-reg-input-label>Tanggal Lahir</x-reg-input-label>
                            <div
                                class="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-tertiary focus-within:ring-2 focus-within:ring-inset focus-within:ring-tertiary">
                                <x-reg-input-text id="tanggal_lahir"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full"
                                    type="date" name="tanggal_lahir" required autofocus
                                    autocomplete="tanggal_lahir" placeholder="Tanggal Lahir"
                                    wire:model.live='tanggal_lahir' />
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
</div>
