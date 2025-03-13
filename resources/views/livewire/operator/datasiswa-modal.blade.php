<div>
    <button wire:click="$set('modalOpen', true)" type="button"
        class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors bg-blue-500 border rounded-md hover:bg-blue-700 active:bg-blue-700 focus:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
        </svg>
    </button>

    @if ($modalOpen)
    
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="w-3/4 h-[90vh] bg-white rounded-lg p-6 transition duration-300 ease-in-out transform overflow-y-auto">
        <div class="p-4 dark:border-gray-700">
            <div class="container mx-auto text-center pt-7">
                <div class="flex justify-between items-center mb-3">
                    <button wire:click="$set('modalOpen', false)"
                        class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
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
                        <div class="font-semibold text-lg text-gray-800">{{ Str::title(@$siswa->nama_lengkap) }}
                        </div>
                    </div>
                    <div class="flex flex-col text-left sm:text-center">
                        <div class="text-sm text-gray-600 font-semibold"> {{ strtoupper(@$siswa->sekolah_asal) }}</div>
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
                        <p class="text-xs font-medium">Email</p>
                        <p class="text-sm text-gray-500">{{ @$siswa->user->email ?? 'Belum Di Lengkapi' }}</p>
                    </div>
                    <div class="flex flex-col text-left">
                        <p class="text-xs font-medium">NISN</p>
                        <p class="text-sm text-gray-500">{{ @$siswa->NISN ?? 'Belum Di Lengkapi' }}</p>
                    </div>
                    <div class="flex flex-col text-left">
                        <p class="text-xs font-medium">Jalur</p>
                        <p class="text-sm text-gray-500">
                            {{ @$siswa->dataRegistrasi->jalur->nama_jalur ?? 'Belum Di Pilih' }}</p>
                        </p>
                    </div>
                    <div class="flex flex-col text-left">
                        <p class="text-xs font-medium">Kode Registrasi</p>
                        <p class="text-sm text-gray-500">{{ @$siswa->DataRegistrasi->nomor_peserta ?? 'Belum Di Lengkapi' }}</p>
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
                    <button onclick="setTab('nilai')" @class([
                        'flex-1 py-2 font-medium duration-300 h-10',
                        'border-b-2 text-gray-400 hover:text-indigo-600 border-white hover:border-indigo-100' =>
                            $tab != 'nilai',
                        'text-indigo-700 border-b-2 border-indigo-500' => $tab == 'nilai',
                    ])>
                        Nilai
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

                <div id="nilai-content" class="tab-content" style="display: {{ $tab == 'nilai' ? 'block' : 'none' }};">
                    <div class="mt-3">
                        @livewire('operator.tab-nilai-siswa', ['siswa' => $siswa], key('operator-tab-nilai-siswa-' . $siswa->id_calon_siswa))
                    </div>
                </div>

                <div id="berkas-content" class="tab-content"
                    style="display: {{ $tab == 'berkas' ? 'block' : 'none' }};">
                    <div class="mt-3">
                        @livewire('operator.tab-berkas-siswa', ['siswa' => $siswa], key('operator-tab-berkas-siswa-' . $siswa->id_calon_siswa))
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>