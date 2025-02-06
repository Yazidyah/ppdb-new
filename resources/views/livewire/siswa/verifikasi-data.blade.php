<div>
    <div class="container mx-auto">
        <h2 class="text-2xl font-bold mb-4 mx-2 text-center">Verifikasi Data</h2>
        <h2 class="text-2xl font-bold mb-4 mx-2 text-start">Biodata Diri</h2>
        <div class="mx-auto md:grid md:grid-cols-4 gap-2">
        <div class="mb-4 mx-2 col-span-4">
            <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
            <input type="text" id="nama_lengkap" value="{{ $calonSiswa->nama_lengkap }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>
        <div class="mb-4 mx-2">
            <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
            <input type="text" id="nik" value="{{ $calonSiswa->NIK }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>
        <div class="mb-4 mx-2">
            <label for="nisn" class="block text-sm font-medium text-gray-700">NISN</label>
            <input type="text" id="nisn" value="{{ $calonSiswa->NISN }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>
        <div class="mb-4 mx-2">
            <label for="no_telp" class="block text-sm font-medium text-gray-700">No Telp</label>
            <input type="text" id="no_telp" value="{{ $calonSiswa->no_telp }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>
        <div class="mb-4 mx-2">
            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
            <input type="text" id="jenis_kelamin" value="{{ $calonSiswa->jenis_kelamin_readable }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>
        <div class="mb-4 mx-2">
            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
            <input type="text" id="tanggal_lahir" value="{{ $calonSiswa->tanggal_lahir_formatted }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>
        <div class="mb-4 mx-2">
            <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
            <input type="text" id="tempat_lahir" value="{{ $calonSiswa->tempat_lahir }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>
        <div class="mb-4 mx-2">
            <label for="npsn" class="block text-sm font-medium text-gray-700">NPSN</label>
            <input type="text" id="npsn" value="{{ $calonSiswa->NPSN }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>
        <div class="mb-4 mx-2">
            <label for="sekolah_asal" class="block text-sm font-medium text-gray-700">Sekolah Asal</label>
            <input type="text" id="sekolah_asal" value="{{ $calonSiswa->sekolah_asal }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>
        <div class="mb-4 mx-2">
            <label for="provinsi" class="block text-sm font-medium text-gray-700">Provinsi Tinggal</label>
            <input type="text" id="provinsi" value="{{ $calonSiswa->provinsi }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>
        <div class="mb-4 mx-2">
            <label for="kota" class="block text-sm font-medium text-gray-700">Kota Tinggal</label>
            <input type="text" id="kota" value="{{ $calonSiswa->kota }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>
        <div class="mb-4 mx-2">
            <label for="alamat_domisili" class="block text-sm font-medium text-gray-700">Alamat Domisili</label>
            <input type="text" id="alamat_domisili" value="{{ $calonSiswa->alamat_domisili }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>
        <div class="mb-4 mx-2">
            <label for="alamat_kk" class="block text-sm font-medium text-gray-700">Alamat KK</label>
            <input type="text" id="alamat_kk" value="{{ $calonSiswa->alamat_kk }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>
        </div>
        @if($orangTuaIbu)
        <h2 class="text-2xl font-bold mb-4 mx-2 text-start">Biodata Orang Tua Ibu</h2>
            <div class="mb-4 mx-2">
                <label for="nama_orang_tua_ibu" class="block text-sm font-medium text-gray-700">Nama Lengkap Ibu</label>
                <input type="text" id="nama_orang_tua_ibu" value="{{ $orangTuaIbu->nama_lengkap }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div class="mb-4 mx-2">
                <label for="nik_orang_tua_ibu" class="block text-sm font-medium text-gray-700">NIK Ibu</label>
                <input type="text" id="nik_orang_tua_ibu" value="{{ $orangTuaIbu->nik }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div class="mb-4 mx-2">
                <label for="pekerjaan_orang_tua_ibu" class="block text-sm font-medium text-gray-700">Pekerjaan Ibu</label>
                <input type="text" id="pekerjaan_orang_tua_ibu" value="{{ $orangTuaIbu->pekerjaan }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div class="mb-4 mx-2">
                <label for="no_telp_orang_tua_ibu" class="block text-sm font-medium text-gray-700">No Telp Ibu</label>
                <input type="text" id="no_telp_orang_tua_ibu" value="{{ $orangTuaIbu->no_telp }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
        @endif
        @if($orangTuaAyah)
        <h2 class="text-2xl font-bold mb-4 mx-2 text-start">Biodata Orang Tua Ayah</h2>
            <div class="mb-4 mx-2">
                <label for="nama_orang_tua_ayah" class="block text-sm font-medium text-gray-700">Nama Lengkap Ayah</label>
                <input type="text" id="nama_orang_tua_ayah" value="{{ $orangTuaAyah->nama_lengkap }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div class="mb-4 mx-2">
                <label for="nik_orang_tua_ayah" class="block text-sm font-medium text-gray-700">NIK Ayah</label>
                <input type="text" id="nik_orang_tua_ayah" value="{{ $orangTuaAyah->nik }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div class="mb-4 mx-2">
                <label for="pekerjaan_orang_tua_ayah" class="block text-sm font-medium text-gray-700">Pekerjaan Ayah</label>
                <input type="text" id="pekerjaan_orang_tua_ayah" value="{{ $orangTuaAyah->pekerjaan }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div class="mb-4 mx-2">
                <label for="no_telp_orang_tua_ayah" class="block text-sm font-medium text-gray-700">No Telp Ayah</label>
                <input type="text" id="no_telp_orang_tua_ayah" value="{{ $orangTuaAyah->no_telp }}" disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
        @endif
    </div>
</div>
