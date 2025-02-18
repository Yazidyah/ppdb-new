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
                    <p class="text-xs font-medium">Nama Lengkap</p>
                    <p>{{ ucfirst($siswa->nama_lengkap) }}</p>
                </div>

                <div>
                    <p class="text-xs font-medium">Jenis Kelamin</p>
                    <p>{{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                </div>

                <div>
                    <p class="text-xs font-medium">Nomor Induk Kependidikan</p>
                    <p>{{ @$siswa->NIK ?? 'Belum Di Lengkapi' }}</p>
                </div>

                <div>
                    <p class="text-xs font-medium">NISN</p>
                    <p>{{ @$siswa->NISN ?? 'Belum Di Lengkapi' }}</p>
                </div>

                <div>
                    <p class="text-xs font-medium">Email</p>
                    <p>{{ @$siswa->user->email }}</p>
                </div>

                <div>
                    <p class="text-xs font-medium">Alamat Domisili</p>
                    <p>{{ @$siswa->alamat_domisili ?? 'Belum Di Lengkapi' }}</p>
                </div>

                <div>
                    <p class="text-xs font-medium">Tempat Lahir</p>
                    <p>{{ @$siswa->tempat_lahir ?? 'Belum Di Lengkapi' }}</p>
                </div>

                <div>
                    <p class="text-xs font-medium">Tanggal Lahir</p>
                    <p> {{ \Carbon\Carbon::parse(@$siswa->tanggal_lahir)->locale('id')->isoFormat('D MMMM YYYY') }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-medium">NPSN</p>
                    <p>{{ @$siswa->NPSN ?? 'Belum Di Lengkapi' }}</p>
                </div>

                <div>
                    <p class="text-xs font-medium">Sekolah Asal</p>
                    <p>{{ @$siswa->sekolah_asal_formatted ?? 'Belum Di Lengkapi' }}</p>
                </div>

                <div>
                    <p class="text-xs font-medium">Provinsi</p>
                    <p>{{ @$siswa->provinsi ?? 'Belum Di Lengkapi' }}</p>
                </div>

                <div>
                    <p class="text-xs font-medium">Kota</p>
                    <p>{{ @$siswa->kota ?? 'Belum Di Lengkapi' }}</p>
                </div>

            </div>
        </div>
    </div>
</div>
