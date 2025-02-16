<x-app-layout>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="container mx-auto text-center pt-7">
                <div id="persyaratan" class="hidden fixed inset-0 z-50 flex-col items-center justify-center bg-black bg-opacity-50">
                    <div class="p-4 sm:ml-64">
                        <div class="p-4 border-2 border-tertiary border-dashed rounded-lg bg-white mt-14">
                            <h1 id="modal-title" class="font-bold text-[32px] pt-7 pb-7">Tambah Persyaratan</h1>
                            <div class="flex w-3/4 items-center justify-center border-2 border-tertiary rounded-lg py-2 mx-auto my-6">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                </svg>
                                <h1 class="block text-xs lg:text-base items-center text-center justify-center font-semibold">Peringatan: Isi Kegiatan dengan data yang benar.</h1>
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
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form id="persyaratan-form" action="{{ route('operator.tambah-persyaratan') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="container py-5 mx-auto px-12 lg:px-32 flex items-center justify-center">
                                    <div class="md:grid grid-cols-4 py-2 w-6/7 gap-2">
                                        <div class="py-1 flex items-center justify-left col-span-1">
                                            <x-reg-input-label for="nama_persyaratan" :value="__('Dokumen Persyaratan')" />
                                        </div>
                                        <div class="py-1 flex items-center justify-left col-span-3">
                                            <x-reg-input-text id="nama_persyaratan" class="block mt-1 w-full" type="text" name="nama_persyaratan" required autofocus autocomplete="nama_persyaratan" />
                                            <x-input-error :messages="$errors->get('Nama Persyaratan')" class="mt-2" />
                                        </div>

                                        <div class="py-1 flex items-center justify-left col-span-1">
                                            <x-reg-input-label for="id_jalur" :value="__('Jenis Jalur')" />
                                        </div>
                                        <div class="py-1 flex items-center justify-left col-span-3">
                                            <select name="id_jalur" id="id_jalur" class="w-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2">
                                                @foreach ($jalurRegistrasi as $jalur)
                                                    <option value="{{ $jalur->id_jalur }}">{{ $jalur->nama_jalur }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('Jenis Jalur')" class="mt-2" />
                                        </div>

                                        <div class="py-1 flex items-center justify-left col-span-1">
                                            <x-reg-input-label for="deskripsi" :value="__('Deskripsi')" />
                                        </div>
                                        <div class="py-1 flex items-center justify-left col-span-3">
                                            <div class="w-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2">
                                                <textarea type="text" name="deskripsi" id="deskripsi" autocomplete="deskripsi" class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full h-full"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <x-primary-button class="mb-2 mx-auto w-full justify-center items-center" value="Tambah Kegiatan">{{ __('Submit') }}</x-primary-button>
                            </form>
                            <button onclick="closeExample()" class="mt-4 px-4 py-2 bg-red-500 text-white rounded-lg">Tutup</button>
                        </div>
                    </div>
                            <div class ="py-1 flex items-center justify-left col-span-1">
                                <x-reg-input-label class="" for="id_jalur" :value="__('Jenis Jalur')" />
                            </div>

                            <div class ="py-1 flex items-center justify-left col-span-3">
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($jalurRegistrasi as $jalur)
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" name="id_jalur[]" value="{{ $jalur->id_jalur }}" class="form-checkbox">
                                            <span class="ml-2">{{ $jalur->nama_jalur }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                <x-input-error :messages="$errors->get('Jenis Jalur')" class="mt-2" />
                            </div>
                            <div class=" py-1 flex items-center justify-left col-span-1">
                                <x-reg-input-label class="" for="deskripsi" :value="__('Deskripsi')" />
                            </div>

                            <div class ="py-1 flex items-center justify-left col-span-3">
                                <div
                                    class="w-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                                    <textarea type="text" name="deskripsi" id="deskripsi" autocomplete="deskripsi"
                                        class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full h-full"
                                        placeholder=""></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <x-primary-button class="mb-2 mx-auto w-full justify-center items-center" value="Tambah Kegiatan">
                        {{ __('Submit') }}
                    </x-primary-button>
                </form>
                <button onclick="closeExample()" class="mt-4 px-4 py-2 bg-red-500 text-white rounded-lg">Tutup</button>
                </div>
                </div>
                </div>
                <div class="container mx-auto mt-10">
                    <div class="w-1/2 inline-flex justify-center items-center px-4 py-2 bg-tertiary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-secondary hover:text-tertiary focus:bg-gray-700 dark:focus:bg-white active:bg-white active:border active:border-tertiary focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        <button onclick="openModal('Tambah Persyaratan', '{{ route('operator.tambah-persyaratan') }}')" class="text-center flex justify-center items-center w-full">TAMBAH PERSYARATAN</button>
                    </div>
                </div>
                <h2 class="font-bold text-[24px] pb-4">Persyaratan yang Sudah Dibuat</h2>
                <form action="{{ route('operator.tambah-persyaratan') }}" method="GET" class="mb-4">
                    <select name="filter_jalur" id="filter_jalur" class="w-1/4 flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2" onchange="this.form.submit()">
                        <option value="">Semua Jalur</option>
                        @foreach ($jalurRegistrasi as $jalur)
                            <option value="{{ $jalur->id_jalur }}" {{ request('filter_jalur') == $jalur->id_jalur ? 'selected' : '' }}>{{ $jalur->nama_jalur }}</option>
                        @endforeach
                    </select>
                </form>
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Nama Persyaratan</th>
                            <th class="px-4 py-2">Jenis Jalur</th>
                            <th class="px-4 py-2">Deskripsi</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($persyaratan as $item)
                            @if (!request('filter_jalur') || request('filter_jalur') == $item->id_jalur)
                                <tr>
                                    <td class="border px-4 py-2">{{ $item->nama_persyaratan }}</td>
                                    <td class="border px-4 py-2">{{ $item->jalurRegistrasi->nama_jalur }}</td>
                                    <td class="border px-4 py-2">{{ $item->deskripsi }}</td>
                                    <td class="border px-4 py-2 flex justify-center space-x-2">
                                        <button onclick="editPersyaratan({{ $item->id_persyaratan }})" class="bg-blue-500 text-white px-4 py-2 rounded">Edit</button>
                                        <form action="{{ route('operator.delete-persyaratan', $item->id_persyaratan) }}" method="post" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="4" class="border px-4 py-2 text-center text-red-500">SYARAT UNTUK JALUR INI BELUM DITAMBAHKAN</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function openModal(title, action) {
            document.getElementById('modal-title').innerText = title;
            document.getElementById('persyaratan-form').action = action;
            document.getElementById('persyaratan').classList.remove('hidden');
            document.getElementById('persyaratan').classList.add('flex');
        }

        function closeExample() {
            document.getElementById('persyaratan').classList.add('hidden');
        }

        function editPersyaratan(id) {
            fetch(`/operator/edit-persyaratan/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('nama_persyaratan').value = data.persyaratan.nama_persyaratan;
                    document.getElementById('id_jalur').value = data.persyaratan.id_jalur;
                    document.getElementById('deskripsi').value = data.persyaratan.deskripsi;
                    openModal('Edit Persyaratan', `/operator/update-persyaratan/${id}`);
                });
        }
    </script>
</x-app-layout>
