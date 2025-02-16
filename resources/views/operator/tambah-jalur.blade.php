<x-app-layout>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="container mx-auto text-center pt-7">
                <div id="jalur"
                    class="hidden fixed inset-0 z-50 flex-col items-center justify-center bg-black bg-opacity-50">
                    <div class="p-4 sm:ml-64">
                        <div class="p-4 border-2 border-tertiary border-dashed rounded-lg bg-white mt-14">
                            <h1 id="modal-title" class="font-bold text-[32px] pt-7 pb-7">Tambah Jalur Registrasi</h1>
                            <div
                                class="flex w-3/4 items-center justify-center border-2 border-tertiary rounded-lg py-2 mx-auto my-6">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                </svg>
                                <h1
                                    class="block text-xs lg:text-base items-center text-center justify-center font-semibold">
                                    Peringatan: Isi Jalur Registrasi dengan data yang benar.</h1>
                            </div>
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

                            <form id="jalur-form" action="{{ route('operator.tambah-jalur') }}" method="post"
                                enctype="multipart/form-data" onsubmit="return validateForm()">
                                @csrf
                                <div class="container py-5 mx-auto px-12 lg:px-32 flex items-center justify-center">
                                    <div class="md:grid grid-cols-4 py-2 w-6/7 gap-2">
                                        <div class="py-1 flex items-center justify-left col-span-1">
                                            <x-reg-input-label for="nama_jalur" :value="__('Nama Jalur')" />
                                        </div>
                                        <div class="py-1 flex items-center justify-left col-span-3">
                                            <x-reg-input-text id="nama_jalur" class="block mt-1 w-full" type="text"
                                                name="nama_jalur" required autofocus autocomplete="nama_jalur" />
                                            <span id="error-nama_jalur" class="text-red-500 text-sm"></span>
                                            <x-input-error :messages="$errors->get('Nama Jalur')" class="mt-2" />
                                        </div>

                                        <div class="py-1 flex items-center justify-left col-span-1">
                                            <x-reg-input-label for="deskripsi" :value="__('Deskripsi')" />
                                        </div>
                                        <div class="py-1 flex items-center justify-left col-span-3">
                                            <div
                                                class="w-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2">
                                                <textarea type="text" name="deskripsi" id="deskripsi"
                                                    autocomplete="deskripsi"
                                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6 w-full h-full"></textarea>
                                            </div>
                                        </div>

                                        <div class="py-1 flex items-center justify-left col-span-1">
                                            <x-reg-input-label for="tanggal_buka" :value="__('Tanggal Buka')" />
                                        </div>
                                        <div class="py-1 flex items-center justify-left col-span-3">
                                            <x-reg-input-text id="tanggal_buka" class="block mt-1 w-full" type="date"
                                                name="tanggal_buka" required autocomplete="tanggal_buka" />
                                            <x-input-error :messages="$errors->get('Tanggal Buka')" class="mt-2" />
                                        </div>
                                        <div class="py-1 flex items-center justify-left col-span-1">
                                            <x-reg-input-label for="tanggal_tutup" :value="__('Tanggal Tutup')" />
                                        </div>
                                        <div class="py-1 flex flex-col items-start col-span-3">
                                            <x-reg-input-text id="tanggal_tutup" class="block mt-1 w-full" type="date"
                                                name="tanggal_tutup" required autocomplete="tanggal_tutup" />
                                            <x-input-error :messages="$errors->get('tanggal_tutup')"
                                                class="mt-1 text-sm text-red-500" />
                                            <span id="error-tanggal_tutup" class="text-red-500 text-sm mt-1"></span>
                                        </div>
                                        <div class="py-1 flex items-center justify-left col-span-1">
                                            <x-reg-input-label for="is_open" :value="__('Status')" />
                                        </div>

                                        <div class="py-1 flex items-center justify-left col-span-3">
                                            <select name="is_open" id="is_open"
                                                class="w-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2">
                                                <option value="1">Buka</option>
                                                <option value="0">Tutup</option>
                                            </select>
                                            <x-input-error :messages="$errors->get('Status')" class="mt-2" />
                                        </div>
                                    </div>
                                </div>
                                <x-primary-button class="mb-2 mx-auto w-full justify-center items-center"
                                    value="Tambah Jalur">{{ __('Submit') }}</x-primary-button>
                            </form>
                            <button onclick="closeExample()"
                                class="mt-4 px-4 py-2 bg-red-500 text-white rounded-lg">Tutup</button>
                        </div>
                    </div>
                </div>
                <div class="container mx-auto mt-10">
                    <div
                        class="w-1/2 inline-flex justify-center items-center px-4 py-2 bg-tertiary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-secondary hover:text-tertiary focus:bg-gray-700 dark:focus:bg-white active:bg-white active:border active:border-tertiary focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        <button onclick="openModal('Tambah Jalur Registrasi', '{{ route('operator.tambah-jalur') }}')"
                            class="text-center flex justify-center items-center w-full">TAMBAH JALUR REGISTRASI</button>
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
                                    <button onclick="editJalur({{ $item->id_jalur }})"
                                        class="bg-blue-500 text-white px-4 py-2 rounded">Edit</button>
                                    <form action="{{ route('operator.delete-jalur', $item->id_jalur) }}" method="post"
                                        onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        <button type="submit"
                                            class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                                    </form>
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
    <script>
        function openModal(title, action) {
            document.getElementById('modal-title').innerText = title;
            document.getElementById('jalur-form').action = action;
            document.getElementById('jalur').classList.remove('hidden');
            document.getElementById('jalur').classList.add('flex');
        }

        function closeExample() {
            document.getElementById('jalur').classList.add('hidden');
        }

        function editJalur(id) {
            fetch(`/operator/edit-jalur/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('nama_jalur').value = data.jalur.nama_jalur;
                    document.getElementById('deskripsi').value = data.jalur.deskripsi;
                    document.getElementById('tanggal_buka').value = data.jalur.tanggal_buka;
                    document.getElementById('tanggal_tutup').value = data.jalur.tanggal_tutup;
                    document.getElementById('is_open').value = data.jalur.is_open;
                    openModal('Edit Jalur Registrasi', `/operator/update-jalur/${id}`);
                });
        }

        function validateForm() {
            let isValid = true;
            const namaJalur = document.getElementById('nama_jalur').value;
            const tanggalBuka = document.getElementById('tanggal_buka').value;
            const tanggalTutup = document.getElementById('tanggal_tutup').value;

            if (!namaJalur) {
                document.getElementById('error-nama_jalur').innerText = 'Nama Jalur tidak boleh kosong.';
                isValid = false;
            } else {
                document.getElementById('error-nama_jalur').innerText = '';
            }

            if (new Date(tanggalTutup) <= new Date(tanggalBuka)) {
                document.getElementById('error-tanggal_tutup').innerText = 'Tanggal Tutup harus lebih dari Tanggal Buka.';
                isValid = false;
            } else {
                document.getElementById('error-tanggal_tutup').innerText = '';
            }

            return isValid;
        }
    </script>
</x-app-layout>