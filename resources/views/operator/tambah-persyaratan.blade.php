<x-app-layout>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div  class="container mx-auto text-center pt-7">
                <div id="persyaratan" class="hidden fixed inset-0 z-50 flex-col items-center justify-center bg-black bg-opacity-50">
                <div class="p-4 sm:ml-64">
                <div class="p-4 border-2 border-tertiary border-dashed rounded-lg  bg-white mt-14">
                <h1 class="font-bold text-[32px] pt-7 pb-7 ">Tambah Persyaratan</h1>
                <div class="flex w-3/4 items-center justify-center border-2 border-tertiary rounded-lg py-2 mx-auto my-6">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-7 h-7">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                    </svg>
                    <h1 class=" block text-xs lg:text-base items-center text-center justify-center font-semibold">
                        Peringatan : Isi Kegiatan dengan data yang benar.</h1>
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

                <form action="{{ route('operator.tambah-persyaratan') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="container py-5 mx-auto px-12 lg:px-32 flex items-center justify-center">
                        <div class="md:grid grid-cols-4  py-2 w-6/7 gap-2">

                            <div class ="py-1 flex items-center justify-left col-span-1">
                                <x-reg-input-label class="" for="nama_persyaratan" :value="__('Dokumen Persyaratan')" />
                            </div>
                            <div class ="py-1 flex items-center justify-left col-span-3">
                                <x-reg-input-text id="name" class=" block mt-1 w-full" type="text"
                                    name="nama_persyaratan" required autofocus autocomplete="nama_persyaratan" />
                                <x-input-error :messages="$errors->get('Nama Persyaratan')" class="mt-2" />
                            </div>

                            <div class ="py-1 flex items-center justify-left col-span-1">
                                <x-reg-input-label class="" for="id_jalur" :value="__('Jenis Jalur')" />
                            </div>

                            <div class ="py-1 flex items-center justify-left col-span-3">
                                <select name="id_jalur" id="id_jalur"
                                    class="w-full flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2 ">
                                    @foreach ($jalurRegistrasi as $jalur)
                                        <option value="{{ $jalur->id_jalur }}">{{ $jalur->nama_jalur }}</option>
                                    @endforeach
                                </select>
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

                <div class="container mx-auto mt-10">
                    <h2 class="font-bold text-[24px] pb-4">Persyaratan yang Sudah Dibuat</h2>
                    <form action="{{ route('operator.tambah-persyaratan') }}" method="GET" class="mb-4">
                        <select name="filter_jalur" id="filter_jalur" class="w-1/4 flex rounded-md shadow-sm ring-1 ring-inset ring-dasar2 focus-within:ring-2 focus-within:ring-inset focus-within:ring-dasar2" onchange="this.form.submit()">
                            <option value="">Semua Jalur</option>
                            @foreach ($jalurRegistrasi as $jalur)
                                <option value="{{ $jalur->id_jalur }}" {{ request('filter_jalur') == $jalur->id_jalur ? 'selected' : '' }}>
                                    {{ $jalur->nama_jalur }}
                                </option>
                            @endforeach
                        </select>
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
                                        <td class="border px-4 py-2">
                                            <form action="{{ route('operator.delete-persyaratan', $item->id_persyaratan) }}" method="post">
                                                @csrf
                                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="4" class="border px-4 py-2 text-center text-red-500">SYARAT UNTUK JALUR INI BELUM DITAMBAHKAN</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
    function persyaratan() {
        const modal = document.getElementById('persyaratan');
        if (modal.classList.contains('hidden')) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        } else {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }
    function closeExample() {
        document.getElementById('persyaratan').classList.add('hidden');
    }
</script>
</x-app-layout>
