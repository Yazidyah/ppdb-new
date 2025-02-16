<div>
    <h1 class="font-semibold py-2 ">Informasi Orang Tua</h1>
    <div class="md:flex gap-3 w-full">
        <div class="md:grid flex flex-col grid-cols-4 grid-rows-3 gap-4 py-2 w-full">
            <!-- Nama Lengkap -->
            <div class="items-center justify-center col-span-3">
                <div
                    class="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                    <x-reg-input-text id="nama_lengkap"
                        class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full"
                        type="text" name="nama_lengkap" wire:model.live="nama_lengkap" placeholder="Nama Lengkap" />
                    @error('nama_lengkap')
                        <span class="text-xs text-red-500 flex items-center mx-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <!-- Hubungan -->
            <div class="items-center justify-center col-span-1">
                <div
                    class="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                    <select id="hubungan" name="hubungan"
                        class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full"
                        wire:model.live="id_hubungan">
                        @foreach ($hubunganOptions as $option)
                            <option value="{{ $option->id_hubungan }}">{{ $option->nama_hubungan }}</option>
                        @endforeach
                    </select>
                    @error('id_hubungan')
                        <span class="text-xs text-red-500 flex items-center mx-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <!-- NIK -->
            <div class="items-center justify-center col-span-3">
                <div
                    class="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                    <x-reg-input-text id="nik"
                        class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full"
                        type="tel" name="nik" wire:model.live="nik" placeholder="NIK" />
                    @error('nik')
                        <span class="text-xs text-red-500 flex items-center mx-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <!-- Pekerjaan -->
            <div class="items-center justify-center col-span-3">
                <div
                    class="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                    <select id="pekerjaan" name="pekerjaan"
                        class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full"
                        wire:model.live="pekerjaan">
                        @foreach ($pekerjaanOptions as $option)
                            <option value="{{ $option->id_pekerjaan }}">{{ $option->nama_pekerjaan }}</option>
                        @endforeach
                    </select>
                    @error('pekerjaan')
                        <span class="text-xs text-red-500 flex items-center mx-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <!-- Nomor Telepon -->
            <div class="items-center justify-center col-span-3">
                <div
                    class="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                    <x-reg-input-text id="no_telp"
                        class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full"
                        type="tel" name="no_telp" wire:model.live="no_telp" placeholder="Nomor Telepon" />
                    @error('no_telp')
                        <span class="text-xs text-red-500 flex items-center mx-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>
