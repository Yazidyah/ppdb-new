<div>
    <div class="p-4 sm:ml-64">
        <div class="container mx-auto text-center pt-3">
            @if ($showModal)
                <div class="fixed inset-0 z-50 flex-col items-center justify-center bg-black bg-opacity-50 overflow-auto"
                    wire:key="modal-{{ $isEdit ? 'edit-' . $persyaratanId : 'create' }}">
                    <div class="p-4 sm:ml-64">
                        <div class="p-4 border-2 border-tertiary border-dashed rounded-lg bg-white mt-14">
                            <h1 class="font-bold text-[32px] pt-7 pb-7">
                                {{ $isEdit ? 'Edit Persyaratan' : 'Tambah Persyaratan' }}
                            </h1>
                            <div
                                class="flex w-3/4 items-center justify-center border-2 border-tertiary rounded-lg py-2 mx-auto my-6">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                </svg>
                                <h1
                                    class="block text-xs lg:text-base items-center text-center justify-center font-semibold">
                                    Peringatan: Isi Dokumen yang diperlukan.</h1>
                            </div>
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li class="text-red-500">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
                                <div class="container py-5 mx-auto px-12 lg:px-32 flex items-center justify-center">
                                    <div class="md:grid grid-cols-4 py-2 w-6/7 gap-2">
                                        <div class="py-1 flex items-center justify-left col-span-1">
                                            <x-reg-input-label for="nama_persyaratan" :value="__('Dokumen Persyaratan')" />
                                        </div>
                                        <div class="py-1 flex items-center justify-left col-span-3">
                                            <x-reg-input-text wire:model.defer="nama_persyaratan" id="nama_persyaratan"
                                                class="block mt-1 w-full" type="text" name="nama_persyaratan"
                                                required autofocus autocomplete="nama_persyaratan" />
                                            <span class="text-red-500 text-sm">
                                                @error('nama_persyaratan')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                        <div class="py-1 flex items-center justify-left col-span-1">
                                            <x-reg-input-label for="id_jalur" :value="__('Jenis Jalur')" />
                                        </div>
                                        @if ($isEdit)
                                            <div class="py-1 flex items-center justify-left col-span-3">
                                                <select wire:model="id_jalur.0"
                                                    wire:key="select-id_jalur-{{ $persyaratanId ?? 'new' }}"
                                                    class="w-full rounded-md shadow-sm ring-1 ring-tertiary focus:ring-2">
                                                    @foreach ($jalurRegistrasi as $jalur)
                                                        <option value="{{ $jalur->id_jalur }}">{{ $jalur->nama_jalur }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="text-red-500 text-sm">
                                                    @error('id_jalur')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        @else
                                            <div class="py-1 flex items-center justify-left col-span-3">
                                                <div class="grid grid-cols-2 gap-4">
                                                    @foreach ($jalurRegistrasi as $jalur)
                                                        <div class="flex items-center">
                                                            <input wire:model="id_jalur" type="checkbox"
                                                                name="id_jalur[]" id="id_jalur_{{ $jalur->id_jalur }}"
                                                                value="{{ $jalur->id_jalur }}" class="mr-2">
                                                            <label
                                                                for="id_jalur_{{ $jalur->id_jalur }}">{{ $jalur->nama_jalur }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <span class="text-red-500 text-sm">
                                                    @error('id_jalur')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        @endif
                                        <div class="py-1 flex items-center justify-left col-span-1">
                                            <x-reg-input-label for="deskripsi" :value="__('Deskripsi')" />
                                        </div>
                                        <div class="py-1 flex items-center justify-left col-span-3">
                                            <div
                                                class="w-full flex rounded-md shadow-sm ring-1 ring-inset ring-tertiary focus-within:ring-2 focus-within:ring-inset focus-within:ring-tertiary">
                                                <textarea wire:model="deskripsi" name="deskripsi" id="deskripsi" autocomplete="deskripsi"
                                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full h-full"
                                                    placeholder=""></textarea>
                                            </div>
                                        </div>
                                        <div class="py-1 flex items-center justify-left col-span-1">
                                            <x-reg-input-label for="accepted_file_types" :value="__('Jenis Berkas')" />
                                        </div>
                                        <div class="py-1 flex items-center justify-left col-span-3">
                                            <ul
                                                class="items-center w-full text-sm font-medium text-gray-900 bg-green-50 border border-gray-200 rounded-lg sm:flex">
                                                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                                                    <div class="flex items-center ps-3">
                                                        <input id="horizontal-list-radio-image" type="radio"
                                                            value="jpg/jpeg/png" wire:model="accepted_file_types"
                                                            name="list-radio"
                                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2"
                                                            {{ $accepted_file_types == 'jpg/jpeg/png' ? 'checked' : '' }}>
                                                        <label for="horizontal-list-radio-image"
                                                            class="w-full py-3 ms-2 text-sm font-medium text-gray-900">Gambar
                                                            (JPG,JPEG,PNG)</label>
                                                    </div>
                                                </li>
                                                <li class="w-full">
                                                    <div class="flex items-center ps-3">
                                                        <input id="horizontal-list-radio-document" type="radio"
                                                            value="pdf" wire:model="accepted_file_types"
                                                            name="list-radio"
                                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2"
                                                            {{ $accepted_file_types == 'pdf' ? 'checked' : '' }}>
                                                        <label for="horizontal-list-radio-document"
                                                            class="w-full py-3 ms-2 text-sm font-medium text-gray-900">Dokumen
                                                            (PDF)</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="justify-between flex  px-4 py-2 border-t">

                                    <div>
                                        <button wire:click="closeModal"
                                            class="inline-flex justify-center items-center px-4 py-2 bg-red-900 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500  focus:bg-red-900 active:bg-red-900 active:border active:border-red-900 focus:outline-none focus:ring-2 focus:ring-red-900 focus:ring-offset-2  transition ease-in-out duration-150">Tutup</button>

                                    </div>
                                    <div>
                                        <x-primary-button
                                            class="mb-2 mx-auto w-full justify-center items-center">{{ __('Submit') }}</x-primary-button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
            <div class="container mx-auto mt-10">
                <h2 class="font-bold text-[24px] pb-4">Persyaratan yang Sudah Dibuat</h2>
                <div class="mb-4 flex justify-between">
                    <select wire:model="filterJalur"
                        class="md:w-1/4 w-1/2 flex rounded-md shadow-sm ring-1 ring-inset ring-tertiary focus-within:ring-2 focus-within:ring-inset focus-within:ring-tertiary"
                        onchange="window.location.href='{{ route('operator.konfigurasi-persyaratan') }}?filter_jalur=' + (this.value ? this.value : 'Semua%20Jalur')">
                        <option value="">Semua Jalur</option>
                        @foreach ($jalurRegistrasi as $jalur)
                            <option value="{{ $jalur->nama_jalur }}">{{ $jalur->nama_jalur }}</option>
                        @endforeach
                    </select>
                    <div
                        class="md:w-1/6 inline-flex justify-center items-center px-4 py-3 bg-tertiary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-secondary hover:text-tertiary focus:bg-gray-700 dark:focus:bg-white active:bg-white active:border active:border-tertiary focus:outline-none focus:ring-2 focus:ring-tertiary focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        <button wire:click="openModal(false)"
                            class="text-center flex justify-center items-center w-full">+ PERSYARATAN</button>
                    </div>
                </div>
                <div class="w-full overflow-x-auto mx-auto flex items-center relative shadow-md sm:rounded-lg my-6">
                    <table class="w-full max-w-full rtl:justify-left text-sm text-left text-gray-500 my-3">
                        <thead class="text-sm text-tertiary uppercase bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-center">Nama Persyaratan</th>
                                <th class="px-4 py-2 text-center">Jenis Jalur</th>
                                <th class="px-4 py-2 text-center">Deskripsi</th>
                                <th class="px-4 py-2 text-center">Jenis Berkas</th>
                                <th class="px-4 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($persyaratan as $item)
                                <tr class="hover:bg-gray-200 transition duration-200 cursor-pointer">
                                    <td class="border text-tertiary text-left px-4 py-2 pl-12">
                                        {{ $item->nama_persyaratan }}
                                    </td>
                                    <td class="border text-tertiary text-center px-4 py-2">
                                        {{ $item->jalurRegistrasi->nama_jalur }}</td>
                                    <td class="border text-tertiary text-left px-4 py-2">{{ $item->deskripsi }}</td>
                                    <td class="border text-tertiary text-center px-4 py-2">
                                        {{ $item->file_type === 'jpg/jpeg/png' ? 'GAMBAR' : ($item->file_type === 'pdf' ? 'DOKUMEN' : '') }}
                                    </td>
                                    <td
                                        class="border text-tertiary text-center px-4 py-2 flex justify-center space-x-2">
                                        <button type="button" wire:click="edit({{ $item->id_persyaratan }})"
                                            class="bg-tertiary text-white px-4 py-2 hover:bg-secondary hover:text-tertiary rounded">Edit</button>
                                        <button wire:click="delete({{ $item->id_persyaratan }})"
                                            class="bg-red-900 text-white px-4 py-2 hover:bg-red-500  rounded">Hapus</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="border px-4 py-2 text-center text-red-500">SYARAT UNTUK
                                        JALUR INI
                                        BELUM DITAMBAHKAN</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
