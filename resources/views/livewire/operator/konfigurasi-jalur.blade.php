<div>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="container mx-auto text-center pt-7">
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
                    <div
                        class="w-1/2 inline-flex justify-center items-center px-4 py-2 bg-tertiary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-secondary hover:text-tertiary focus:bg-gray-700 dark:focus:bg-white active:bg-white active:border active:border-tertiary focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        <button wire:click="create" class="text-center flex justify-center items-center w-full">TAMBAH JALUR REGISTRASI</button>
                    </div>
                </div>
                <h2 class="font-bold text-[24px] pb-4">Jalur Registrasi yang Sudah Dibuat</h2>
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Nama Jalur</th>
                            <th class="px-4 py-2">Deskripsi</th>
                            <th class="px-4 py-2">Tanggal Buka</th>
                            <th class="px-4 py-2">Tanggal Tutup</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jalurRegistrasi as $item)
                            <tr>
                                <td class="border px-4 py-2">{{ $item->nama_jalur }}</td>
                                <td class="border px-4 py-2">{{ $item->deskripsi }}</td>
                                <td class="border px-4 py-2">{{ $item->tanggal_buka }}</td>
                                <td class="border px-4 py-2">{{ $item->tanggal_tutup }}</td>
                                <td class="border px-4 py-2">{{ $item->is_open ? 'Buka' : 'Tutup' }}</td>
                                <td class="border px-4 py-2 flex justify-center space-x-2">
                                    <button wire:click="edit({{ $item->id_jalur }})" class="bg-blue-500 text-white px-4 py-2 rounded">Edit</button>
                                    <button wire:click="delete({{ $item->id_jalur }})" class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="border px-4 py-2 text-center text-red-500">Jalur Registrasi belum ditambahkan</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if($isModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="p-4 sm:ml-64">
                <div class="p-4 border-2 border-tertiary border-dashed rounded-lg bg-white mt-14">
                    <h1 class="font-bold text-[32px] pt-7 pb-7">{{ $jalurId ? 'Edit Jalur Registrasi' : 'Tambah Jalur Registrasi' }}</h1>
                    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
                        <div class="container py-5 mx-auto px-12 lg:px-32 flex items-center justify-center">
                            <div class="md:grid grid-cols-4 py-2 w-6/7 gap-2">
                                <div class="py-1 flex items-center justify-left col-span-1">
                                    <x-reg-input-label for="nama_jalur" :value="__('Nama Jalur')" />
                                </div>
                                <div class="py-1 flex items-center justify-left col-span-3">
                                    <x-reg-input-text id="nama_jalur" class="block mt-1 w-full" type="text" wire:model="nama_jalur" required autofocus autocomplete="nama_jalur" />
                                    <x-input-error :messages="$errors->get('nama_jalur')" class="mt-2" />
                                </div>

                                <div class="py-1 flex items-center justify-left col-span-1">
                                    <x-reg-input-label for="deskripsi" :value="__('Deskripsi')" />
                                </div>
                                <div class="py-1 flex items-center justify-left col-span-3">
                                    <div class="w-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2">
                                        <textarea wire:model="deskripsi" id="deskripsi" autocomplete="deskripsi" class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full h-full"></textarea>
                                    </div>
                                </div>

                                <div class="py-1 flex items-center justify-left col-span-1">
                                    <x-reg-input-label for="tanggal_buka" :value="__('Tanggal Buka')" />
                                </div>
                                <div class="py-1 flex items-center justify-left col-span-3">
                                    <x-reg-input-text id="tanggal_buka" class="block mt-1 w-full" type="date" wire:model="tanggal_buka" required autocomplete="tanggal_buka" />
                                    <x-input-error :messages="$errors->get('tanggal_buka')" class="mt-2" />
                                </div>
                                <div class="py-1 flex items-center justify-left col-span-1">
                                    <x-reg-input-label for="tanggal_tutup" :value="__('Tanggal Tutup')" />
                                </div>
                                <div class="py-1 flex flex-col items-start col-span-3">
                                    <x-reg-input-text id="tanggal_tutup" class="block mt-1 w-full" type="date" wire:model="tanggal_tutup" required autocomplete="tanggal_tutup" />
                                    <x-input-error :messages="$errors->get('tanggal_tutup')" class="mt-1 text-sm text-red-500" />
                                </div>
                                <div class="py-1 flex items-center justify-left col-span-1">
                                    <x-reg-input-label for="is_open" :value="__('Status')" />
                                </div>

                                <div class="py-1 flex items-center justify-left col-span-3">
                                    <select wire:model="is_open" id="is_open" class="w-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2">
                                        <option disabled="disabled" value="">Pilih Status</option>
                                        <option value="1">Buka</option>
                                        <option value="0">Tutup</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('is_open')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        <x-primary-button class="mb-2 mx-auto w-full justify-center items-center">{{ $isEdit ? 'Update' : 'Submit' }}</x-primary-button>
                    </form>
                    <button wire:click="closeModal" class="mt-4 px-4 py-2 bg-red-500 text-white rounded-lg">Tutup</button>
                </div>
            </div>
        </div>
    @endif
</div>

