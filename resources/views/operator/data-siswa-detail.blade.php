<x-app-layout>
    @php
        $tab = $tab ?? 'detail';
    @endphp

    <div class="p-4 sm:ml-64">
        <div class="p-4  dark:border-gray-700 mt-14">
            <div class="container mx-auto text-center pt-7">
                <div class="flex justify-between items-left mb-3">
                    <button onclick="window.location.href='{{ route('operator.datasiswa') }}'"
                        class="px-4 py-2 bg-tertiary text-white font-medium rounded-lg hover:bg-secondary hover:text-tertiary">Kembali
                    </button>
                </div>
                <div class="bg-white  rounded-lg p-6 transition duration-300 ease-in-out transform ">
                    <div class="flex justify-between items-center space-x-4">
                        <div class="flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-8 h-8 text-indigo-600">
                                <path
                                    d="M11.7 2.805a.75.75 0 0 1 .6 0A60.65 60.65 0 0 1 22.83 8.72a.75.75 0 0 1-.231 1.337 49.948 49.948 0 0 0-9.902 3.912l-.003.002c-.114.06-.227.119-.34.18a.75.75 0 0 1-.707 0A50.88 50.88 0 0 0 7.5 12.173v-.224c0-.131.067-.248.172-.311a54.615 54.615 0 0 1 4.653-2.52.75.75 0 0 0-.65-1.352 56.123 56.123 0 0 0-4.78 2.589 1.858 1.858 0 0 0-.859 1.228 49.803 49.803 0 0 0-4.634-1.527.75.75 0 0 1-.231-1.337A60.653 60.653 0 0 1 11.7 2.805Z" />
                                <path
                                    d="M13.06 15.473a48.45 48.45 0 0 1 7.666-3.282c.134 1.414.22 2.843.255 4.284a.75.75 0 0 1-.46.711 47.87 47.87 0 0 0-8.105 4.342.75.75 0 0 1-.832 0 47.87 47.87 0 0 0-8.104-4.342.75.75 0 0 1-.461-.71c.035-1.442.121-2.87.255-4.286.921.304 1.83.634 2.726.99v1.27a1.5 1.5 0 0 0-.14 2.508c-.09.38-.222.753-.397 1.11.452.213.901.434 1.346.66a6.727 6.727 0 0 0 .551-1.607 1.5 1.5 0 0 0 .14-2.67v-.645a48.549 48.549 0 0 1 3.44 1.667 2.25 2.25 0 0 0 2.12 0Z" />
                                <path
                                    d="M4.462 19.462c.42-.419.753-.89 1-1.395.453.214.902.435 1.347.662a6.742 6.742 0 0 1-1.286 1.794.75.75 0 0 1-1.06-1.06Z" />
                            </svg>
                            <div class="font-semibold text-lg text-gray-800">{{ $siswa->nama_lengkap }}</div>
                        </div>
                        <div class="flex flex-col text-left sm:text-center">
                            <div class="text-sm text-gray-600 font-semibold"> {{ $siswa->sekolah_asal }}</div>
                        </div>
                    </div>
                    <div class="flex justify-between items-start space-x-4 mt-2">
                        <div class="text-sm text-gray-500">Tanggal Daftar :
                            {{ \Carbon\Carbon::parse(@$siswa->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                        </div>
                    </div>
                    <hr class="my-4 border-gray-300">
                    <div class="mt-4 grid grid-cols-2 sm:grid-cols-4 gap-4 text-gray-700">
                        <div class="flex flex-col text-left">
                            <p class="text-xs font-medium">No Telpon</p>
                            <p class="text-sm text-gray-500">{{ $siswa->no_telp }}</p>
                        </div>
                        <div class="flex flex-col text-left">
                            <p class="text-xs font-medium">NISN</p>
                            <p class="text-sm text-gray-500">{{ $siswa->NISN }}</p>
                        </div>
                        <div class="flex flex-col text-left">
                            <p class="text-xs font-medium">Jalur</p>
                            <p class="text-sm text-gray-500">
                                {{ $siswa->dataRegistrasi->jalur->nama_jalur }}</p>
                            </p>
                        </div>
                        <div class="flex flex-col text-left">
                            <p class="text-xs font-medium">Kota</p>
                            <p class="text-sm text-gray-500">{{ $siswa->kota }}</p>
                        </div>

                    </div>

                </div>

                <div class="mt-5 relative w-full">
                    <div
                        class="relative flex items-center justify-between w-full h-12 gap-2 p-4 text-sm text-gray-500 bg-white rounded">

                        <button onclick="setTab('detail')" @class([
                            'flex-1 py-2 font-medium duration-300 h-10',
                            'border-b-2 text-gray-400 hover:text-indigo-600 border-white hover:border-indigo-100' =>
                                $tab != 'detail',
                            'text-indigo-700 border-b-2 border-indigo-500' => $tab == 'detail',
                        ])>
                            Siswa
                        </button>

                        <button onclick="setTab('orangtua')" @class([
                            'flex-1 py-2 font-medium duration-300 h-10',
                            'border-b-2 text-gray-400 hover:text-indigo-600 border-white hover:border-indigo-100' =>
                                $tab != 'orangtua',
                            'text-indigo-700 border-b-2 border-indigo-500' => $tab == 'orangtua',
                        ])>
                            Orang Tua
                        </button>

                        <button onclick="setTab('berkas')" @class([
                            'flex-1 py-2 font-medium duration-300 h-10',
                            'border-b-2 text-gray-400 hover:text-indigo-600 border-white hover:border-indigo-100' =>
                                $tab != 'berkas',
                            'text-indigo-700 border-b-2 border-indigo-500' => $tab == 'berkas',
                        ])>
                            Berkas
                        </button>

                    </div>

                    <div id="detail-content" class="tab-content"
                        style="display: {{ $tab == 'detail' ? 'block' : 'none' }};">
                        <div class="mt-3">
                            @livewire('operator.tab-detail-siswa', ['siswa' => $siswa], key('operator-tab-detail-siswa-' . $siswa->id_calon_siswa))
                        </div>
                    </div>

                    <div id="orangtua-content" class="tab-content"
                        style="display: {{ $tab == 'orangtua' ? 'block' : 'none' }};">
                        <div class="mt-3">
                            @livewire('operator.tab-ortu-siswa', ['siswa' => $siswa], key('operator-tab-ortu-siswa-' . $siswa->id_calon_siswa))
                        </div>
                    </div>

                    <div id="berkas-content" class="tab-content"
                        style="display: {{ $tab == 'berkas' ? 'block' : 'none' }};">
                        <div class="mt-3">
                            @livewire('operator.tab-berkas-siswa', ['siswa' => $siswa], key('operator-tab-berkas-siswa-' . $siswa->id_calon_siswa))
                        </div>
                    </div>
                </div>

                <script>
                    function setTab(tab) {
                        document.querySelectorAll('button').forEach(button => {
                            button.classList.remove('text-indigo-700', 'border-indigo-500');
                            button.classList.add('text-gray-400', 'border-white');
                        });

                        const activeButton = document.querySelector(`button[onclick="setTab('${tab}')"]`);
                        activeButton.classList.add('text-indigo-700', 'border-indigo-500');
                        activeButton.classList.remove('text-gray-400', 'border-white');

                        document.querySelectorAll('.tab-content').forEach(content => {
                            content.style.display = 'none';
                        });

                        document.getElementById(`${tab}-content`).style.display = 'block';
                    }
                </script>
            </div>
        </div>
    </div>

</x-app-layout>
