<div>
    <div class="p-8 bg-white rounded-lg">
        <div>
            <div class="text-left">
                <div>
                    <h5 class="font-medium">Data Siswa</h5>
                    <p class="text-sm text-gray-400">Data yang diisikan pada saat pendaftaran.</p>
                </div>
            </div>
            <hr class="w-full mt-3 mb-5">
            <div class="grid grid-cols-2 gap-4 text-gray-700 text-left">
                <div>
                    <label class="text-xs font-medium">Nama Lengkap</label>
                    <input type="text" value="{{ ucfirst($siswa->nama_lengkap) }}" class="border p-2 w-full">
                </div>
                <div>
                    <label class="text-xs font-medium">Jenis Kelamin</label>
                    <input type="text" value="{{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}" class="border p-2 w-full">
                </div>
                <div>
                    <label class="text-xs font-medium">Nomor Induk Kependidikan</label>
                    <input type="text" value="{{ $siswa->NIK ?? 'Belum Di Lengkapi' }}" class="border p-2 w-full">
                </div>
                <div>
                    <label class="text-xs font-medium">NISN</label>
                    <input type="text" value="{{ $siswa->NISN ?? 'Belum Di Lengkapi' }}" class="border p-2 w-full">
                </div>
                <div>
                    <label class="text-xs font-medium">Email</label>
                    <input type="text" value="{{ $siswa->user->email }}" class="border p-2 w-full">
                </div>
                <div>
                    <label class="text-xs font-medium">Alamat Domisili</label>
                    <input type="text" value="{{ ucwords($siswa->alamat_domisili ?? 'Belum Di Lengkapi') }}" class="border p-2 w-full">
                </div>
                <div>
                    <label class="text-xs font-medium">Tempat Lahir</label>
                    <input type="text" value="{{ ucwords($siswa->tempat_lahir) ?? 'Belum Di Lengkapi' }}" class="border p-2 w-full">
                </div>
                <div>
                    <label class="text-xs font-medium">Tanggal Lahir</label>
                    <input type="text" value="{{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->locale('id')->isoFormat('D MMMM YYYY') }}" class="border p-2 w-full">
                </div>
                <div>
                    <label class="text-xs font-medium">NPSN</label>
                    <input type="text" value="{{ $siswa->NPSN ?? 'Belum Di Lengkapi' }}" class="border p-2 w-full">
                </div>
                <div>
                    <label class="text-xs font-medium">Sekolah Asal</label>
                    <input type="text" value="{{ strtoupper($siswa->sekolah_asal_formatted ?? 'Belum Di Lengkapi') }}" class="border p-2 w-full">
                </div>
                <div>
                    <label class="text-xs font-medium">Provinsi</label>
                    <input type="text" value="{{ $siswa->provinsi ?? 'Belum Di Lengkapi' }}" class="border p-2 w-full">
                </div>
                <div>
                    <label class="text-xs font-medium">Kota</label>
                    <input type="text" value="{{ $siswa->kota ?? 'Belum Di Lengkapi' }}" class="border p-2 w-full">
                </div>
            </div>
        </div>
    </div>
</div>