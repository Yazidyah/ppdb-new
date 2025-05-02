<div>
    <div class="container mx-auto">
        <h2 class="text-2xl font-bold mb-4 mx-2 text-center">Verifikasi Data</h2>
        <h2 class="text-2xl font-bold mb-4 mx-2 text-start">Biodata Diri</h2>
        <div class="mx-auto md:grid md:grid-cols-4 gap-2">
            <div class="mb-4 mx-2 col-span-4">
                <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" id="nama_lengkap"
                    value="{{ strtoupper($calonSiswa->nama_lengkap) ?: 'DATA INI KOSONG' }}" disabled
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$calonSiswa->nama_lengkap ? 'text-red-500' : '' }}">
            </div>
            <div class="mb-4 mx-2">
                <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                <input type="text" id="nik" value="{{ $calonSiswa->NIK ?: 'DATA INI KOSONG' }}" disabled
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$calonSiswa->NIK ? 'text-red-500' : '' }}">
            </div>
            <div class="mb-4 mx-2">
                <label for="nisn" class="block text-sm font-medium text-gray-700">NISN</label>
                <input type="text" id="nisn" value="{{ $calonSiswa->NISN ?: 'DATA INI KOSONG' }}" disabled
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$calonSiswa->NISN ? 'text-red-500' : '' }}">
            </div>
            <div class="mb-4 mx-2">
                <label for="no_telp" class="block text-sm font-medium text-gray-700">No Telp</label>
                <input type="text" id="no_telp" value="{{ $calonSiswa->no_telp ?: 'DATA INI KOSONG' }}" disabled
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$calonSiswa->no_telp ? 'text-red-500' : '' }}">
            </div>
            <div class="mb-4 mx-2">
                <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                <input type="text" id="jenis_kelamin"
                    value="{{ strtoupper($calonSiswa->jenis_kelamin_readable) ?: 'DATA INI KOSONG' }}" disabled
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$calonSiswa->jenis_kelamin_readable ? 'text-red-500' : '' }}">
            </div>
            <div class="mb-4 mx-2">
                <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                <input type="text" id="tanggal_lahir"
                    value="{{ strtoupper($calonSiswa->tanggal_lahir_formatted) ?: 'DATA INI KOSONG' }}" disabled
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$calonSiswa->tanggal_lahir_formatted ? 'text-red-500' : '' }}">
            </div>
            <div class="mb-4 mx-2">
                <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                <input type="text" id="tempat_lahir"
                    value="{{ strtoupper($calonSiswa->tempat_lahir) ?: 'DATA INI KOSONG' }}" disabled
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$calonSiswa->tempat_lahir ? 'text-red-500' : '' }}">
            </div>
            <div class="mb-4 mx-2">
                <label for="npsn" class="block text-sm font-medium text-gray-700">NPSN</label>
                <input type="text" id="npsn" value="{{ strtoupper($calonSiswa->NPSN) ?: 'DATA INI KOSONG' }}" disabled
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$calonSiswa->NPSN ? 'text-red-500' : '' }}">
            </div>
            <div class="mb-4 mx-2">
                <label for="sekolah_asal" class="block text-sm font-medium text-gray-700">Sekolah Asal</label>
                <input type="text" id="sekolah_asal"
                    value="{{ strtoupper($calonSiswa->sekolah_asal) ?: 'DATA INI KOSONG' }}" disabled
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$calonSiswa->sekolah_asal ? 'text-red-500' : '' }}">
            </div>
            <div class="mb-4 mx-2">
                <label for="provinsi" class="block text-sm font-medium text-gray-700">Provinsi Tinggal</label>
                <input type="text" id="provinsi" value="{{ $calonSiswa->provinsi ?: 'DATA INI KOSONG' }}" disabled
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$calonSiswa->provinsi ? 'text-red-500' : '' }}">
            </div>
            <div class="mb-4 mx-2">
                <label for="kota" class="block text-sm font-medium text-gray-700">Kota Tinggal</label>
                <input type="text" id="kota" value="{{ $calonSiswa->kota ?: 'DATA INI KOSONG' }}" disabled
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$calonSiswa->kota ? 'text-red-500' : '' }}">
            </div>
            <div class="mb-4 mx-2">
                <label for="alamat_domisili" class="block text-sm font-medium text-gray-700">Alamat Domisili</label>
                <input type="text" id="alamat_domisili"
                    value="{{ strtoupper($calonSiswa->alamat_domisili) ?: 'DATA INI KOSONG' }}" disabled
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$calonSiswa->alamat_domisili ? 'text-red-500' : '' }}">
            </div>
            <div class="mb-4 mx-2">
                <label for="alamat_kk" class="block text-sm font-medium text-gray-700">Alamat KK</label>
                <input type="text" id="alamat_kk" value="{{ strtoupper($calonSiswa->alamat_kk) ?: 'DATA INI KOSONG' }}"
                    disabled
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$calonSiswa->alamat_kk ? 'text-red-500' : '' }}">
            </div>
            <div class="mb-4 mx-2">
                <label for="predikat_akreditasi_sekolah" class="block text-sm font-medium text-gray-700">Predikat
                    Akreditasi Sekolah</label>
                <input type="text" id="predikat_akreditasi_sekolah"
                    value="{{ strtoupper($calonSiswa->predikat_akreditasi_sekolah) ?: 'DATA INI KOSONG' }}" disabled
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$calonSiswa->predikat_akreditasi_sekolah ? 'text-red-500' : '' }}">
            </div>
            <div class="mb-4 mx-2">
                <label for="nilai_akreditasi_sekolah" class="block text-sm font-medium text-gray-700">Nilai Akreditasi
                    Sekolah</label>
                <input type="text" id="nilai_akreditasi_sekolah"
                    value="{{ $calonSiswa->nilai_akreditasi_sekolah ?: 'DATA INI KOSONG' }}" disabled
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$calonSiswa->nilai_akreditasi_sekolah ? 'text-red-500' : '' }}">
            </div>
        </div>
        @if($orangTuaIbu)
            <h2 class="text-2xl font-bold mb-4 mx-2 text-start">Biodata Orang Tua Ibu</h2>
            <div class="mb-4 mx-2">
                <label for="nama_orang_tua_ibu" class="block text-sm font-medium text-gray-700">Nama Lengkap Ibu</label>
                <input type="text" id="nama_orang_tua_ibu"
                    value="{{ strtoupper($orangTuaIbu->nama_lengkap) ?: 'DATA INI KOSONG' }}" disabled
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$orangTuaIbu->nama_lengkap ? 'text-red-500' : '' }}">
            </div>
            <div class="mb-4 mx-2">
                <label for="nik_orang_tua_ibu" class="block text-sm font-medium text-gray-700">NIK Ibu</label>
                <input type="text" id="nik_orang_tua_ibu" value="{{ $orangTuaIbu->nik ?: 'DATA INI KOSONG' }}" disabled
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$orangTuaIbu->nik ? 'text-red-500' : '' }}">
            </div>
            <div class="mb-4 mx-2">
                <label for="pekerjaan_orang_tua_ibu" class="block text-sm font-medium text-gray-700">Pekerjaan Ibu</label>
                <input type="text" id="pekerjaan_orang_tua_ibu"
                    value="{{ strtoupper($orangTuaIbu->pekerjaan) ?: 'DATA INI KOSONG' }}" disabled
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$orangTuaIbu->pekerjaan ? 'text-red-500' : '' }}">
            </div>
            <div class="mb-4 mx-2">
                <label for="no_telp_orang_tua_ibu" class="block text-sm font-medium text-gray-700">No Telp Ibu</label>
                <input type="text" id="no_telp_orang_tua_ibu" value="{{ $orangTuaIbu->no_telp ?: 'DATA INI KOSONG' }}"
                    disabled
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$orangTuaIbu->no_telp ? 'text-red-500' : '' }}">
            </div>
        @endif
        @if($orangTuaAyah)
            <h2 class="text-2xl font-bold mb-4 mx-2 text-start">Biodata Orang Tua Ayah</h2>
            <div class="mb-4 mx-2">
                <label for="nama_orang_tua_ayah" class="block text-sm font-medium text-gray-700">Nama Lengkap Ayah</label>
                <input type="text" id="nama_orang_tua_ayah"
                    value="{{ strtoupper($orangTuaAyah->nama_lengkap) ?: 'DATA INI KOSONG' }}" disabled
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$orangTuaAyah->nama_lengkap ? 'text-red-500' : '' }}">
            </div>
            <div class="mb-4 mx-2">
                <label for="nik_orang_tua_ayah" class="block text-sm font-medium text-gray-700">NIK Ayah</label>
                <input type="text" id="nik_orang_tua_ayah" value="{{ $orangTuaAyah->nik ?: 'DATA INI KOSONG' }}" disabled
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$orangTuaAyah->nik ? 'text-red-500' : '' }}">
            </div>
            <div class="mb-4 mx-2">
                <label for="pekerjaan_orang_tua_ayah" class="block text-sm font-medium text-gray-700">Pekerjaan Ayah</label>
                <input type="text" id="pekerjaan_orang_tua_ayah"
                    value="{{ strtoupper($orangTuaAyah->pekerjaan) ?: 'DATA INI KOSONG' }}" disabled
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$orangTuaAyah->pekerjaan ? 'text-red-500' : '' }}">
            </div>
            <div class="mb-4 mx-2">
                <label for="no_telp_orang_tua_ayah" class="block text-sm font-medium text-gray-700">No Telp Ayah</label>
                <input type="text" id="no_telp_orang_tua_ayah" value="{{ $orangTuaAyah->no_telp ?: 'DATA INI KOSONG' }}"
                    disabled
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$orangTuaAyah->no_telp ? 'text-red-500' : '' }}">
            </div>
        @endif
        @if($orangTuaWali != null)
            <h2 class="text-2xl font-bold mb-4 mx-2 text-start">Biodata Orang Tua Wali</h2>
            <div class="mb-4 mx-2">
                <label for="nama_orang_tua_ayah" class="block text-sm font-medium text-gray-700">Nama Lengkap Wali</label>
                <input type="text" id="nama_orang_tua_ayah"
                    value="{{ strtoupper($orangTuaWali->nama_lengkap) ?: 'DATA INI KOSONG' }}" disabled
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$orangTuaWali->nama_lengkap ? 'text-red-500' : '' }}">
            </div>
            <div class="mb-4 mx-2">
                <label for="nik_orang_tua_ayah" class="block text-sm font-medium text-gray-700">NIK Ayah</label>
                <input type="text" id="nik_orang_tua_ayah" value="{{ $orangTuaWali->nik ?: 'DATA INI KOSONG' }}" disabled
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$orangTuaWali->nik ? 'text-red-500' : '' }}">
            </div>
            <div class="mb-4 mx-2">
                <label for="pekerjaan_orang_tua_ayah" class="block text-sm font-medium text-gray-700">Pekerjaan Ayah</label>
                <input type="text" id="pekerjaan_orang_tua_ayah"
                    value="{{ strtoupper($orangTuaWali->pekerjaan) ?: 'DATA INI KOSONG' }}" disabled
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$orangTuaWali->pekerjaan ? 'text-red-500' : '' }}">
            </div>
            <div class="mb-4 mx-2">
                <label for="no_telp_orang_tua_ayah" class="block text-sm font-medium text-gray-700">No Telp Ayah</label>
                <input type="text" id="no_telp_orang_tua_ayah" value="{{ $orangTuaWali->no_telp ?: 'DATA INI KOSONG' }}"
                    disabled
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$orangTuaWali->no_telp ? 'text-red-500' : '' }}">
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="navigation-buttons justify-between flex items-center py-10 sm:py-6 px-2 sm:px-4 max-w-7xl mx-auto">
            <button onclick="window.location.href='/siswa/daftar-step-satu?t=2'"
                class="px-3 py-1 sm:px-6 sm:py-2 flex items-center justify-center hover:bg-secondary rounded-xl text-secondary font-medium bg-tertiary hover:text-tertiary"
                type="button" id="nextBtn">Previous</button>
            <button onclick="document.getElementById('info-popup').classList.remove('hidden')"
                class="px-3 py-1 sm:px-6 sm:py-2 flex items-center justify-center hover:bg-secondary rounded-xl text-secondary font-medium bg-tertiary hover:text-tertiary"
                type="button" id="submitBtn">Submit</button>
        </div>
    </div>
    <div id="info-popup" tabindex="-1"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <div class="relative p-6 bg-white rounded-lg shadow md:p-10">
                <button id="close-modal-icon" type="button"
                    class="absolute top-3 right-3 p-2 text-gray-500 hover:text-white bg-white rounded-lg border border-gray-200 hover:border-red-900 hover:bg-red-900 focus:ring-4 focus:outline-none focus:ring-gray-300 focus:z-10"
                    onclick="document.getElementById('info-popup').classList.add('hidden')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
                <div class="mb-6 text-base font-light text-gray-500">
                    <h3 class="mb-4 text-3xl font-bold text-gray-900">Konfirmasi Pengisian Data</h3>
                    <p class="text-md text-justify ">
                        Dengan ini saya menyatakan bahwa saya meyakini sepenuhnya bahwa data isian biodata dan data
                        orang tua yang telah saya masukkan ke dalam sistem adalah <span class="font-bold text-tertiary">
                            Valid, Benar, dan Dapat Dipertanggungjawabkan.</span>
                    </p>
                    <p class="text-md text-justify">
                        Saya memahami bahwa kebenaran informasi tersebut sangat penting untuk
                        kelancaran proses administrasi, dan saya siap mempertanggungjawabkan kebenaran setiap data yang
                        telah saya berikan sesuai dengan ketentuan yang berlaku.
                    </p>
                </div>
                <div class="justify-between items-center pt-0 space-y-4 sm:flex sm:space-y-0">
                    <div class="items-center space-y-4 sm:space-x-4 sm:flex sm:space-y-0">
                        <button id="close-modal" type="button"
                            class="py-3 px-5 w-full text-base font-medium text-white bg-red-900 rounded-lg border border-red-900 sm:w-auto hover:bg-red-500 focus:ring-4 focus:outline-none focus:ring-red-500  focus:z-10"
                            onclick="document.getElementById('info-popup').classList.add('hidden')">Batal</button>
                        <button id="confirm-button" type="button"
                            class="py-3 px-5 w-full text-base font-medium text-center text-secondary rounded-lg bg-tertiary sm:w-auto hover:bg-secondary hover:text-tertiary focus:ring-4 focus:outline-none focus:ring-tertiary"
                            wire:click="updateStatus">Ya, Saya Yakin</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>