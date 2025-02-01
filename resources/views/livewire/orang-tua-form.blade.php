<div>
<h1 class="font-semibold py-2 ">Informasi Orang Tua</h1>
<div class="md:flex gap-3 w-full">
    <div class="md:grid flex flex-col grid-cols-4 grid-rows-3 gap-4 py-2 w-full">
        <!-- Nama Lengkap -->
        <div class="items-center justify-center col-span-3">
            <div
                class="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                <x-reg-input-text id="nama_lengkap_{{ $index }}"
                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full"
                    type="text" name="nama_lengkap" wire:model="nama_lengkap" placeholder="Nama Lengkap" />
                <x-input-error :messages="$errors->get('nama_lengkap')" class="mt-2" />
            </div>
        </div>
        <!-- Hubungan -->
        <div class="items-center justify-center col-span-1">
            <div
                class="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                <select id="hubungan_{{ $index }}" name="hubungan"
                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full"
                    wire:model="id_hubungan">
                    @foreach($hubunganOptions as $option)
                        <option value="{{ $option->id }}">{{ $option->nama_hubungan }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('id_hubungan')" class="mt-2" />
            </div>
        </div>
        <!-- NIK -->
        <div class="items-center justify-center col-span-3">
            <div
                class="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                <x-reg-input-text id="nik_{{ $index }}"
                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full"
                    type="tel" name="nik" wire:model="nik" placeholder="NIK" />
                <x-input-error :messages="$errors->get('nik')" class="mt-2" />
            </div>
        </div>
        <!-- Pekerjaan -->
        <div class="items-center justify-center col-span-3">
            <div
                class="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                <select id="pekerjaan_{{ $index }}" name="pekerjaan"
                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full"
                    wire:model="pekerjaan">
                    @foreach($pekerjaanOptions as $option)
                        <option value="{{ $option->id_pekerjaan }}">{{ $option->nama_pekerjaan }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('pekerjaan')" class="mt-2" />
            </div>
        </div>
        <!-- Nomor Telepon -->
        <div class="items-center justify-center col-span-3">
            <div
                class="w-full h-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                <x-reg-input-text id="no_telp_{{ $index }}"
                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full"
                    type="tel" name="no_telp" wire:model="no_telp" placeholder="Nomor Telepon" />
                <x-input-error :messages="$errors->get('no_telp')" class="mt-2" />
            </div>
        </div>
    </div>
</div>
</div>