<div>
    <div class="container mx-auto">
        <h2 class="text-2xl font-bold mb-4 mx-2 text-center">Verifikasi Data</h2>
        <h2 class="text-2xl font-bold mb-4 mx-2 text-start">Biodata Diri</h2>
        <div class="mx-auto md:grid md:grid-cols-4 gap-2">
        <div class="mb-4 mx-2 col-span-4">
            <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
            <input type="text" id="nama_lengkap" value="{{ strtoupper($calonSiswa->nama_lengkap) ?: 'DATA INI KOSONG' }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$calonSiswa->nama_lengkap ? 'text-red-500' : '' }}">
        </div>
        <div class="mb-4 mx-2">
            <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
            <input type="text" id="nik" value="{{ $calonSiswa->NIK ?: 'DATA INI KOSONG' }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$calonSiswa->NIK ? 'text-red-500' : '' }}">
        </div>
        <div class="mb-4 mx-2">
            <label for="nisn" class="block text-sm font-medium text-gray-700">NISN</label>
            <input type="text" id="nisn" value="{{ $calonSiswa->NISN ?: 'DATA INI KOSONG' }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$calonSiswa->NISN ? 'text-red-500' : '' }}">
        </div>
        <div class="mb-4 mx-2">
            <label for="no_telp" class="block text-sm font-medium text-gray-700">No Telp</label>
            <input type="text" id="no_telp" value="{{ $calonSiswa->no_telp ?: 'DATA INI KOSONG' }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$calonSiswa->no_telp ? 'text-red-500' : '' }}">
        </div>
        <div class="mb-4 mx-2">
            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
            <input type="text" id="jenis_kelamin" value="{{ strtoupper($calonSiswa->jenis_kelamin_readable) ?: 'DATA INI KOSONG' }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$calonSiswa->jenis_kelamin_readable ? 'text-red-500' : '' }}">
        </div>
        <div class="mb-4 mx-2">
            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
            <input type="text" id="tanggal_lahir" value="{{ strtoupper($calonSiswa->tanggal_lahir_formatted) ?: 'DATA INI KOSONG' }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$calonSiswa->tanggal_lahir_formatted ? 'text-red-500' : '' }}">
        </div>
        <div class="mb-4 mx-2">
            <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
            <input type="text" id="tempat_lahir" value="{{ strtoupper($calonSiswa->tempat_lahir) ?: 'DATA INI KOSONG' }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$calonSiswa->tempat_lahir ? 'text-red-500' : '' }}">
        </div>
        <div class="mb-4 mx-2">
            <label for="npsn" class="block text-sm font-medium text-gray-700">NPSN</label>
            <input type="text" id="npsn" value="{{ strtoupper($calonSiswa->NPSN) ?: 'DATA INI KOSONG' }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$calonSiswa->NPSN ? 'text-red-500' : '' }}">
        </div>
        <div class="mb-4 mx-2">
            <label for="sekolah_asal" class="block text-sm font-medium text-gray-700">Sekolah Asal</label>
            <input type="text" id="sekolah_asal" value="{{ strtoupper($calonSiswa->sekolah_asal) ?: 'DATA INI KOSONG' }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$calonSiswa->sekolah_asal ? 'text-red-500' : '' }}">
        </div>
        <div class="mb-4 mx-2">
            <label for="provinsi" class="block text-sm font-medium text-gray-700">Provinsi Tinggal</label>
            <input type="text" id="provinsi" value="{{ $calonSiswa->provinsi ?: 'DATA INI KOSONG' }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$calonSiswa->provinsi ? 'text-red-500' : '' }}">
        </div>
        <div class="mb-4 mx-2">
            <label for="kota" class="block text-sm font-medium text-gray-700">Kota Tinggal</label>
            <input type="text" id="kota" value="{{ $calonSiswa->kota ?: 'DATA INI KOSONG' }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$calonSiswa->kota ? 'text-red-500' : '' }}">
        </div>
        <div class="mb-4 mx-2">
            <label for="alamat_domisili" class="block text-sm font-medium text-gray-700">Alamat Domisili</label>
            <input type="text" id="alamat_domisili" value="{{ strtoupper($calonSiswa->alamat_domisili) ?: 'DATA INI KOSONG' }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$calonSiswa->alamat_domisili ? 'text-red-500' : '' }}">
        </div>
        <div class="mb-4 mx-2">
            <label for="alamat_kk" class="block text-sm font-medium text-gray-700">Alamat KK</label>
            <input type="text" id="alamat_kk" value="{{ strtoupper($calonSiswa->alamat_kk) ?: 'DATA INI KOSONG' }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$calonSiswa->alamat_kk ? 'text-red-500' : '' }}">
        </div>
        <div class="mb-4 mx-2">
            <label for="predikat_akreditasi_sekolah" class="block text-sm font-medium text-gray-700">Predikat Akreditasi Sekolah</label>
            <input type="text" id="predikat_akreditasi_sekolah" value="{{ strtoupper($calonSiswa->predikat_akreditasi_sekolah) ?: 'DATA INI KOSONG' }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$calonSiswa->predikat_akreditasi_sekolah ? 'text-red-500' : '' }}">
        </div>
        <div class="mb-4 mx-2">
            <label for="nilai_akreditasi_sekolah" class="block text-sm font-medium text-gray-700">Nilai Akreditasi Sekolah</label>
            <input type="text" id="nilai_akreditasi_sekolah" value="{{ $calonSiswa->nilai_akreditasi_sekolah ?: 'DATA INI KOSONG' }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$calonSiswa->nilai_akreditasi_sekolah ? 'text-red-500' : '' }}">
        </div>
        </div>
        @if($orangTuaIbu)
        <h2 class="text-2xl font-bold mb-4 mx-2 text-start">Biodata Orang Tua Ibu</h2>
            <div class="mb-4 mx-2">
                <label for="nama_orang_tua_ibu" class="block text-sm font-medium text-gray-700">Nama Lengkap Ibu</label>
                <input type="text" id="nama_orang_tua_ibu" value="{{ strtoupper($orangTuaIbu->nama_lengkap) ?: 'DATA INI KOSONG' }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$orangTuaIbu->nama_lengkap ? 'text-red-500' : '' }}">
            </div>
            <div class="mb-4 mx-2">
                <label for="nik_orang_tua_ibu" class="block text-sm font-medium text-gray-700">NIK Ibu</label>
                <input type="text" id="nik_orang_tua_ibu" value="{{ $orangTuaIbu->nik ?: 'DATA INI KOSONG' }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$orangTuaIbu->nik ? 'text-red-500' : '' }}">
            </div>
            <div class="mb-4 mx-2">
                <label for="pekerjaan_orang_tua_ibu" class="block text-sm font-medium text-gray-700">Pekerjaan Ibu</label>
                <input type="text" id="pekerjaan_orang_tua_ibu" value="{{ strtoupper($orangTuaIbu->pekerjaan) ?: 'DATA INI KOSONG' }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$orangTuaIbu->pekerjaan ? 'text-red-500' : '' }}">
            </div>
            <div class="mb-4 mx-2">
                <label for="no_telp_orang_tua_ibu" class="block text-sm font-medium text-gray-700">No Telp Ibu</label>
                <input type="text" id="no_telp_orang_tua_ibu" value="{{ $orangTuaIbu->no_telp ?: 'DATA INI KOSONG' }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$orangTuaIbu->no_telp ? 'text-red-500' : '' }}">
            </div>
        @endif
        @if($orangTuaAyah)
        <h2 class="text-2xl font-bold mb-4 mx-2 text-start">Biodata Orang Tua Ayah</h2>
            <div class="mb-4 mx-2">
                <label for="nama_orang_tua_ayah" class="block text-sm font-medium text-gray-700">Nama Lengkap Ayah</label>
                <input type="text" id="nama_orang_tua_ayah" value="{{ strtoupper($orangTuaAyah->nama_lengkap) ?: 'DATA INI KOSONG' }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$orangTuaAyah->nama_lengkap ? 'text-red-500' : '' }}">
            </div>
            <div class="mb-4 mx-2">
                <label for="nik_orang_tua_ayah" class="block text-sm font-medium text-gray-700">NIK Ayah</label>
                <input type="text" id="nik_orang_tua_ayah" value="{{ $orangTuaAyah->nik ?: 'DATA INI KOSONG' }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$orangTuaAyah->nik ? 'text-red-500' : '' }}">
            </div>
            <div class="mb-4 mx-2">
                <label for="pekerjaan_orang_tua_ayah" class="block text-sm font-medium text-gray-700">Pekerjaan Ayah</label>
                <input type="text" id="pekerjaan_orang_tua_ayah" value="{{ strtoupper($orangTuaAyah->pekerjaan) ?: 'DATA INI KOSONG' }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$orangTuaAyah->pekerjaan ? 'text-red-500' : '' }}">
            </div>
            <div class="mb-4 mx-2">
                <label for="no_telp_orang_tua_ayah" class="block text-sm font-medium text-gray-700">No Telp Ayah</label>
                <input type="text" id="no_telp_orang_tua_ayah" value="{{ $orangTuaAyah->no_telp ?: 'DATA INI KOSONG' }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm {{ !$orangTuaAyah->no_telp ? 'text-red-500' : '' }}">
            </div>
        @endif
    </div>
</div>
