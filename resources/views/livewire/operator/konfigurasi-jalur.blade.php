<div>
    <div class="p-4 sm:ml-64">
        <div class="container mx-auto text-center pt-3">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="container mx-auto mt-10">
                <h2 class="font-bold text-[24px] pb-4">Jalur Registrasi yang Sudah Dibuat</h2>
                <div class="flex justify-between">
                    <div>
                    </div>
                    <div
                        class="md:w-1/6 inline-flex justify-center items-center px-4 py-3 bg-tertiary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-secondary hover:text-tertiary focus:bg-gray-700 dark:focus:bg-white active:bg-white active:border active:border-tertiary focus:outline-none focus:ring-2 focus:ring-tertiary focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        <button wire:click="create" class="text-center flex justify-center items-center w-full">+ JALUR
                            REGISTRASI</button>
                    </div>
                </div>
            </div>
            <div class="w-full overflow-x-auto mx-auto flex items-center relative shadow-md sm:rounded-lg my-6">
                <table class="w-full max-w-full rtl:justify-left text-sm text-left text-gray-500 my-3">
                    <thead class="text-sm text-tertiary uppercase bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 pl-12 text-left">Nama Jalur</th>
                            <th class="px-4 py-2 text-center">Deskripsi</th>
                            <th class="px-4 py-2 text-center">Tanggal Buka</th>
                            <th class="px-4 py-2 text-center">Tanggal Tutup</th>
                            <th class="px-4 py-2 text-center">Status</th>
                            <th class="px-4 py-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jalurRegistrasi as $item)
                            <tr class="hover:bg-gray-200 transition duration-200 cursor-pointer">
                                <td class=" px-4 py-2 pl-12 text-tertiary text-left">{{ $item->nama_jalur }}</td>
                                <td class=" px-4 py-2 text-tertiary text-left">{{ $item->deskripsi }}</td>
                                <td class=" px-4 py-2 text-tertiary text-center">{{ $item->tanggal_buka }}</td>
                                <td class=" px-4 py-2 text-tertiary text-center">{{ $item->tanggal_tutup }}</td>
                                <td class=" px-4 py-2 text-tertiary text-center">{{ $item->is_open ? 'Buka' : 'Tutup' }}
                                </td>
                                <td class=" px-4 py-2 text-tertiary text-center flex justify-center space-x-2">
                                    <button wire:click="edit({{ $item->id_jalur }})"
                                        class="bg-tertiary text-white px-4 py-2  hover:bg-secondary hover:text-tertiary rounded">Edit</button>
                                    <button wire:click="delete({{ $item->id_jalur }})"
                                        class="bg-red-900 text-white px-4 py-2 hover:bg-red-500  rounded">Hapus</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="border px-4 py-2 text-center text-red-500">Jalur Registrasi belum
                                    ditambahkan</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if($isModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" wire:click="closeModal">
            <div class="p-4 sm:ml-64" wire:click.stop>
                <div class="p-4 border-2 border-tertiary rounded-lg bg-white mt-14 relative">
                    <button wire:click="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <h1 class="font-bold text-[32px] pt-7 pb-7 text-center">
                        {{ $jalurId ? 'Edit Jalur Registrasi' : 'Tambah Jalur Registrasi' }}
                    </h1>
                    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
                        <div class="container py-5 mx-auto px-12 lg:px-32 flex items-center justify-center">
                            <div class="md:grid grid-cols-4 py-2 w-6/7 gap-2">
                                <div class="py-1 flex items-center justify-left col-span-1">
                                    <x-reg-input-label for="nama_jalur" :value="__('Nama Jalur')" />
                                </div>
                                <div class="py-1 flex items-center justify-left col-span-3">
                                    <x-reg-input-text id="nama_jalur" class="block mt-1 w-full" type="text"
                                        wire:model="nama_jalur" required autofocus autocomplete="nama_jalur" />
                                    <x-input-error :messages="$errors->get('nama_jalur')" class="mt-2" />
                                </div>

                                <div class="py-1 flex items-center justify-left col-span-1">
                                    <x-reg-input-label for="deskripsi" :value="__('Deskripsi')" />
                                </div>
                                <div class="py-1 flex items-center justify-left col-span-3">
                                    <div
                                        class="w-full flex rounded-md shadow-sm ring-1 ring-inset ring-tertiary focus-within:ring-2 focus-within:ring-inset focus-within:ring-tertiary">
                                        <textarea wire:model="deskripsi" id="deskripsi" autocomplete="deskripsi"
                                            class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full h-full"></textarea>
                                    </div>
                                </div>

                                <div class="py-1 flex items-center justify-left col-span-1">
                                    <x-reg-input-label for="tanggal_buka" :value="__('Tanggal Buka')" />
                                </div>
                                <div class="py-1 flex items-center justify-left col-span-3">
                                    <x-reg-input-text id="tanggal_buka" class="block mt-1 w-full" type="date"
                                        wire:model="tanggal_buka" required autocomplete="tanggal_buka" />
                                    <x-input-error :messages="$errors->get('tanggal_buka')" class="mt-2" />
                                </div>
                                <div class="py-1 flex items-center justify-left col-span-1">
                                    <x-reg-input-label for="tanggal_tutup" :value="__('Tanggal Tutup')" />
                                </div>
                                <div class="py-1 flex flex-col items-start col-span-3">
                                    <x-reg-input-text id="tanggal_tutup" class="block mt-1 w-full" type="date"
                                        wire:model="tanggal_tutup" required autocomplete="tanggal_tutup" />
                                    <x-input-error :messages="$errors->get('tanggal_tutup')"
                                        class="mt-1 text-sm text-red-500" />
                                </div>
                                <div class="py-1 flex items-center justify-left col-span-1">
                                    <x-reg-input-label for="is_open" :value="__('Status')" />
                                </div>
                                <div
                                    class="items-center col-span-3 w-full h-full text-sm font-medium rounded-lg sm:flex ring-1 ring-inset ring-tertiary focus-within:ring-2 focus-within:ring-inset focus-within:ring-tertiary">
                                    <div class="w-full border-b border-gray-500 sm:border-b-0 sm:border-r">
                                        <div class="flex items-center ps-3">
                                            <input id="is_open_1" type="radio" name="is_open" wire:model="is_open" value="1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2" />
                                            <label for="is_open_1"
                                                class="w-full py-3 ms-2 text-sm font-medium text-gray-900">
                                                Buka
                                            </label>
                                        </div>
                                    </div>

                                    <div class="w-full">
                                        <div class="flex items-center ps-3">
                                            <input id="is_open_0" type="radio" name="is_open" wire:model="is_open" value="0"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2" />
                                            <label for="is_open_0"
                                                class="w-full py-3 ms-2 text-sm font-medium text-gray-900">
                                                Tutup
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->get('is_open')" class="mt-2" />
                            </div>
                        </div>
                        <div class="flex justify-between px-4 py-2 border-t">
                        <div>
                        <button wire:click="closeModal"
                            class="inline-flex justify-center items-center px-4 py-2 bg-red-900 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500  focus:bg-red-900 active:bg-red-900 active:border active:border-red-900 focus:outline-none focus:ring-2 focus:ring-red-900 focus:ring-offset-2  transition ease-in-out duration-150">Tutup</button>
                        </div>
                            
                        <div>
                            <x-primary-button class="mb-2 mx-auto w-full justify-center items-center">{{ $isEdit ? 'Update' : 'Submit' }}</x-primary-button>
                        </div>
                    </div>
                    </form>
                    </div>
            </div>
        </div>
    @endif
</div>