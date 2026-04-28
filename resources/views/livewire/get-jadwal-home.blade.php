<div>
    <!-- Jalur Cards Section -->
    <section class="mb-12 md:mb-16">
        <!-- Section Header -->
        <div class="text-center mb-10">
            <div class="inline-block bg-primary/10 rounded-full px-5 py-2 mb-4">
                <span class="text-primary font-semibold text-sm">🎓 Jalur Pendaftaran</span>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-tertiary mb-3">
                Pilih Jalur Pendaftaran Anda
            </h2>
            <p class="text-gray-600 text-base md:text-lg max-w-2xl mx-auto">
                Tiga jalur pendaftaran tersedia untuk calon siswa baru
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
            <!-- Jalur Afirmatif Card -->
            <div class="relative bg-white rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1 overflow-hidden border border-gray-100">
                <!-- Icon Header -->
                <div class="bg-gradient-to-br from-primary to-tertiary p-6 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-full -mr-12 -mt-12"></div>
                    <div class="relative z-10">
                        <div class="bg-white/20 backdrop-blur-sm rounded-xl w-14 h-14 flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h5 class="text-2xl font-bold text-white">Jalur Afirmasi</h5>
                    </div>
                </div>
                
                <div class="p-6">
                    <p class="text-gray-700 text-sm md:text-base mb-6 leading-relaxed">
                        Untuk siswa dari keluarga ekonomi tidak mampu atau berkebutuhan khusus
                    </p>
                    <div class="flex items-center text-sm text-gray-600 mb-4">
                        <svg class="w-5 h-5 mr-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="font-semibold">{{ $tanggalBukaAfirmatif }} - {{ $tanggalTutupAfirmatif }}</span>
                    </div>
                    <a href="#afirmatif"
                        class="w-full inline-flex items-center justify-center px-5 py-3 text-sm font-bold text-white bg-gradient-to-r from-primary to-tertiary rounded-xl hover:shadow-md transition-all duration-200">
                        Lihat Detail
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Jalur Prestasi Card -->
            <div class="relative bg-white rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1 overflow-hidden border border-gray-100">
                <!-- Icon Header -->
                <div class="bg-gradient-to-br from-tertiary to-primary p-6 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-full -mr-12 -mt-12"></div>
                    <div class="relative z-10">
                        <div class="bg-white/20 backdrop-blur-sm rounded-xl w-14 h-14 flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                            </svg>
                        </div>
                        <h5 class="text-2xl font-bold text-white">Jalur Prestasi</h5>
                    </div>
                </div>
                
                <div class="p-6">
                    <p class="text-gray-700 text-sm md:text-base mb-6 leading-relaxed">
                        Untuk siswa berprestasi akademik maupun non-akademik tingkat Nasional/Internasional
                    </p>
                    <div class="flex items-center text-sm text-gray-600 mb-4">
                        <svg class="w-5 h-5 mr-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="font-semibold">{{ $tanggalBukaAfirmatif }} - {{ $tanggalTutupAfirmatif }}</span>
                    </div>
                    <a href="#afirmatif"
                        class="w-full inline-flex items-center justify-center px-5 py-3 text-sm font-bold text-white bg-gradient-to-r from-tertiary to-primary rounded-xl hover:shadow-md transition-all duration-200">
                        Lihat Detail
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Jalur Reguler Card -->
            <div class="relative bg-white rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1 overflow-hidden border border-gray-100">
                <!-- Icon Header -->
                <div class="bg-gradient-to-br from-primary to-tertiary p-6 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-full -mr-12 -mt-12"></div>
                    <div class="relative z-10">
                        <div class="bg-white/20 backdrop-blur-sm rounded-xl w-14 h-14 flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <h5 class="text-2xl font-bold text-white">Jalur Reguler</h5>
                    </div>
                </div>
                
                <div class="p-6">
                    <p class="text-gray-700 text-sm md:text-base mb-6 leading-relaxed">
                        Jalur umum untuk semua calon siswa yang memenuhi persyaratan akademik
                    </p>
                    <div class="flex items-center text-sm text-gray-600 mb-4">
                        <svg class="w-5 h-5 mr-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="font-semibold">{{ $tanggalBukaReguler }} - {{ $tanggalTutupReguler }}</span>
                    </div>
                    <a href="#reguler"
                        class="w-full inline-flex items-center justify-center px-5 py-3 text-sm font-bold text-white bg-gradient-to-r from-primary to-tertiary rounded-xl hover:shadow-md transition-all duration-200">
                        Lihat Detail
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Jadwal Title -->
    <section class="mb-12 md:mb-16">
        <div class="relative overflow-hidden bg-gradient-to-br from-white to-secondary/10 border-2 border-primary/20 rounded-2xl text-center py-10 md:py-12 shadow-xl">
            <!-- Decorative Elements -->
            <div class="absolute top-0 left-0 w-32 h-32 bg-primary/5 rounded-full -ml-16 -mt-16"></div>
            <div class="absolute bottom-0 right-0 w-40 h-40 bg-tertiary/5 rounded-full -mr-20 -mb-20"></div>
            
            <div class="relative z-10">
                <div class="inline-block bg-primary/10 rounded-full px-5 py-2 mb-4">
                    <span class="text-primary font-semibold text-sm">📅 Jadwal Lengkap</span>
                </div>
                <h2 class="font-bold text-2xl md:text-3xl lg:text-4xl text-tertiary px-4 mb-3">
                    Jadwal Penerimaan Murid Baru Madrasah
                </h2>
                <div class="inline-flex items-center gap-2 bg-white rounded-full px-6 py-3 shadow-md">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span class="text-tertiary font-bold text-lg">Tahun Pelajaran {{ date('Y') }}/{{ date('Y') + 1 }}</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Jalur Afirmasi dan Prestasi -->
    <div id="afirmatif" class="mb-12 md:mb-16">
        <div class="flex items-center justify-center gap-3 mb-8">
            <div class="h-1 w-12 bg-gradient-to-r from-transparent to-primary rounded-full"></div>
            <h3 class="font-bold text-2xl md:text-3xl text-center text-tertiary">Jalur Afirmasi dan Prestasi</h3>
            <div class="h-1 w-12 bg-gradient-to-l from-transparent to-primary rounded-full"></div>
        </div>
        
        <!-- Mobile View -->
        <div class="block md:hidden space-y-3">
            @php
            $jadwalAfirmatif = [
                ['no' => 1, 'kegiatan' => 'Pendaftaran', 'detail' => 'Jalur Afirmasi Keluarga Ekonomi Tidak Mampu (PIP/PKH/KKS), Jalur Afirmasi Anak Berkebutuhan Khusus, Jalur Prestasi (Akademik dan Non Akademik)', 'waktu' => '01 - 06 Mei 2026', 'keterangan' => 'Pendaftaran online melalui website www.man1kotabogor.id'],
                ['no' => 2, 'kegiatan' => 'Verifikasi, Validasi berkas dan Pencetakan Kartu Ujian', 'detail' => '', 'waktu' => '07 Mei 2026', 'keterangan' => 'Verifikasi dan Validasi dilakukan secara Tatap muka sesuai Jadwal'],
                ['no' => 3, 'kegiatan' => 'Tes Kemampuan Prestasi (Jalur Prestasi)', 'detail' => '', 'waktu' => '08 Mei 2026', 'keterangan' => 'Tes dilakukan secara Tatap muka sesuai Jadwal di Kartu Peserta'],
                ['no' => 4, 'kegiatan' => 'Tes Baca Quran dan Wawancara', 'detail' => '', 'waktu' => '11 - 12 Mei 2026', 'keterangan' => 'Tes dilakukan secara Tatap muka sesuai Jadwal di Kartu Peserta'],
                ['no' => 5, 'kegiatan' => 'Pengumuman', 'detail' => '', 'waktu' => '18 Mei 2026', 'keterangan' => 'Pengumuman Online'],
                ['no' => 6, 'kegiatan' => 'Daftar Ulang', 'detail' => '', 'waktu' => '20 - 21 Mei 2026', 'keterangan' => 'Daftar Ulang dilakukan secara Tatap muka dengan membawa Berkas-berkas'],
            ];
            @endphp
            
            @foreach($jadwalAfirmatif as $item)
            <div class="relative group">
                <div class="absolute -inset-0.5 bg-gradient-to-r from-primary/20 to-tertiary/20 rounded-xl blur opacity-50 group-hover:opacity-75 transition duration-300"></div>
                <div class="relative bg-white border-2 border-primary/20 rounded-xl p-5 shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-primary to-tertiary rounded-xl flex items-center justify-center text-white font-bold text-lg shadow-md">
                            {{ $item['no'] }}
                        </div>
                        <div class="flex-1">
                            <h4 class="font-bold text-tertiary text-lg mb-2">{{ $item['kegiatan'] }}</h4>
                            @if($item['detail'])
                            <div class="bg-gray-50 rounded-lg p-3 mb-3">
                                <ul class="space-y-1.5 text-xs text-gray-700">
                                    @foreach(explode(', ', $item['detail']) as $detail)
                                    <li class="flex items-start gap-2">
                                        <svg class="w-4 h-4 text-primary flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                        <span>{{ $detail }}</span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="space-y-3">
                        <div class="flex items-center gap-3 bg-primary/5 rounded-lg p-3">
                            <div class="bg-primary/10 rounded-lg p-2">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-600 mb-0.5">Waktu Pelaksanaan</p>
                                <p class="font-bold text-tertiary">{{ $item['waktu'] }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-3 bg-secondary/10 rounded-lg p-3">
                            <div class="bg-secondary/20 rounded-lg p-2 flex-shrink-0">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-xs text-gray-600 mb-0.5">Keterangan</p>
                                <p class="text-sm text-gray-800 leading-relaxed">{{ $item['keterangan'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Desktop View -->
        <div class="hidden md:block border-2 border-tertiary rounded-xl overflow-hidden shadow-lg">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-tertiary text-white">
                        <tr>
                            <th class="px-4 py-4 text-center font-bold text-sm lg:text-base w-16">No</th>
                            <th class="px-4 py-4 text-center font-bold text-sm lg:text-base">Kegiatan</th>
                            <th class="px-4 py-4 text-center font-bold text-sm lg:text-base w-40">Waktu</th>
                            <th class="px-4 py-4 text-center font-bold text-sm lg:text-base">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-4 text-center text-tertiary font-semibold">1</td>
                            <td class="px-4 py-4 text-tertiary">
                                <div class="font-semibold mb-2">Pendaftaran</div>
                                <ul class="list-disc list-inside text-sm space-y-1">
                                    <li>Jalur Afirmasi Keluarga Ekonomi Tidak Mampu (PIP/PKH/KKS)</li>
                                    <li>Jalur Afirmasi Anak Berkebutuhan Khusus</li>
                                    <li>Jalur Prestasi (Akademik dan Non Akademik)</li>
                                </ul>
                            </td>
                            <td class="px-4 py-4 text-center text-tertiary font-semibold">01 - 06 Mei 2026</td>
                            <td class="px-4 py-4 text-tertiary text-sm">Pendaftaran online melalui website <a href="https://www.man1kotabogor.id" class="text-tertiary hover:underline">www.man1kotabogor.id</a></td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-4 text-center text-tertiary font-semibold">2</td>
                            <td class="px-4 py-4 text-tertiary font-semibold">Verifikasi, Validasi berkas dan Pencetakan Kartu Ujian</td>
                            <td class="px-4 py-4 text-center text-tertiary font-semibold">07 Mei 2026</td>
                            <td class="px-4 py-4 text-tertiary text-sm">Verifikasi dan Validasi dilakukan secara Tatap muka sesuai Jadwal</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-4 text-center text-tertiary font-semibold">3</td>
                            <td class="px-4 py-4 text-tertiary font-semibold">Tes Kemampuan Prestasi (Jalur Prestasi)</td>
                            <td class="px-4 py-4 text-center text-tertiary font-semibold">08 Mei 2026</td>
                            <td class="px-4 py-4 text-tertiary text-sm">Tes dilakukan secara Tatap muka sesuai Jadwal di Kartu Peserta</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-4 text-center text-tertiary font-semibold">4</td>
                            <td class="px-4 py-4 text-tertiary font-semibold">Tes Baca Quran dan Wawancara</td>
                            <td class="px-4 py-4 text-center text-tertiary font-semibold">11 - 12 Mei 2026</td>
                            <td class="px-4 py-4 text-tertiary text-sm">Tes dilakukan secara Tatap muka sesuai Jadwal di Kartu Peserta</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-4 text-center text-tertiary font-semibold">5</td>
                            <td class="px-4 py-4 text-tertiary font-semibold">Pengumuman</td>
                            <td class="px-4 py-4 text-center text-tertiary font-semibold">18 Mei 2026</td>
                            <td class="px-4 py-4 text-tertiary text-sm">Pengumuman Online</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-4 text-center text-tertiary font-semibold">6</td>
                            <td class="px-4 py-4 text-tertiary font-semibold">Daftar Ulang</td>
                            <td class="px-4 py-4 text-center text-tertiary font-semibold">20 - 21 Mei 2026</td>
                            <td class="px-4 py-4 text-tertiary text-sm">Daftar Ulang dilakukan secara Tatap muka dengan membawa Berkas-berkas</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Jalur Reguler -->
    <div id="reguler" class="mb-12 md:mb-16">
        <div class="flex items-center justify-center gap-3 mb-8">
            <div class="h-1 w-12 bg-gradient-to-r from-transparent to-primary rounded-full"></div>
            <h3 class="font-bold text-2xl md:text-3xl text-center text-tertiary">Jalur Reguler</h3>
            <div class="h-1 w-12 bg-gradient-to-l from-transparent to-primary rounded-full"></div>
        </div>
        
        <!-- Mobile View -->
        <div class="block md:hidden space-y-3">
            @php
            $jadwalReguler = [
                ['no' => 1, 'kegiatan' => 'Pendaftaran', 'waktu' => '01 Mei - 04 Juni 2026', 'keterangan' => 'Pendaftaran online melalui website www.man1kotabogor.id'],
                ['no' => 2, 'kegiatan' => 'Verifikasi dan Validasi berkas', 'waktu' => '05, 08 - 09 Juni 2026', 'keterangan' => 'Online dilakukan oleh panitia'],
                ['no' => 3, 'kegiatan' => 'Pencetakan Kartu Ujian', 'waktu' => '09 Juni 2026', 'keterangan' => 'Online dilakukan oleh calon siswa'],
                ['no' => 4, 'kegiatan' => 'Tes Akademik', 'waktu' => '10 - 12 dan 15 Juni 2026', 'keterangan' => 'Tes dilakukan secara Tatap muka sesuai Jadwal di Kartu Peserta'],
                ['no' => 5, 'kegiatan' => "Tes Baca Qur'an dan Wawancara", 'waktu' => '17 - 19 dan 22 Juni 2026', 'keterangan' => 'Tes dilakukan secara Tatap muka sesuai Jadwal di Kartu Peserta'],
                ['no' => 6, 'kegiatan' => 'Pengumuman', 'waktu' => '25 Juni 2026', 'keterangan' => 'Pengumuman Online'],
                ['no' => 7, 'kegiatan' => 'Daftar Ulang', 'waktu' => '29, 30 Juni - 01 Juli 2026', 'keterangan' => 'Daftar Ulang dilakukan secara Tatap muka dengan membawa Berkas-berkas'],
            ];
            @endphp
            
            @foreach($jadwalReguler as $item)
            <div class="relative group">
                <div class="absolute -inset-0.5 bg-gradient-to-r from-primary/20 to-tertiary/20 rounded-xl blur opacity-50 group-hover:opacity-75 transition duration-300"></div>
                <div class="relative bg-white border-2 border-primary/20 rounded-xl p-5 shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-primary to-tertiary rounded-xl flex items-center justify-center text-white font-bold text-lg shadow-md">
                            {{ $item['no'] }}
                        </div>
                        <div class="flex-1">
                            <h4 class="font-bold text-tertiary text-lg">{{ $item['kegiatan'] }}</h4>
                        </div>
                    </div>
                    
                    <div class="space-y-3">
                        <div class="flex items-center gap-3 bg-primary/5 rounded-lg p-3">
                            <div class="bg-primary/10 rounded-lg p-2">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-600 mb-0.5">Waktu Pelaksanaan</p>
                                <p class="font-bold text-tertiary">{{ $item['waktu'] }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-3 bg-secondary/10 rounded-lg p-3">
                            <div class="bg-secondary/20 rounded-lg p-2 flex-shrink-0">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-xs text-gray-600 mb-0.5">Keterangan</p>
                                <p class="text-sm text-gray-800 leading-relaxed">{{ $item['keterangan'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Desktop View -->
        <div class="hidden md:block border-2 border-tertiary rounded-xl overflow-hidden shadow-lg">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-tertiary text-white">
                        <tr>
                            <th class="px-4 py-4 text-center font-bold text-sm lg:text-base w-16">No</th>
                            <th class="px-4 py-4 text-center font-bold text-sm lg:text-base">Kegiatan</th>
                            <th class="px-4 py-4 text-center font-bold text-sm lg:text-base w-48">Waktu</th>
                            <th class="px-4 py-4 text-center font-bold text-sm lg:text-base">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-4 text-center text-tertiary font-semibold">1</td>
                            <td class="px-4 py-4 text-tertiary font-semibold">Pendaftaran</td>
                            <td class="px-4 py-4 text-center text-tertiary font-semibold">01 Mei - 04 Juni 2026</td>
                            <td class="px-4 py-4 text-tertiary text-sm">Pendaftaran online melalui website <a href="https://www.man1kotabogor.id" class="text-tertiary hover:underline">www.man1kotabogor.id</a></td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-4 text-center text-tertiary font-semibold">2</td>
                            <td class="px-4 py-4 text-tertiary font-semibold">Verifikasi dan Validasi berkas</td>
                            <td class="px-4 py-4 text-center text-tertiary font-semibold">05, 08 - 09 Juni 2026</td>
                            <td class="px-4 py-4 text-tertiary text-sm">Online dilakukan oleh panitia</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-4 text-center text-tertiary font-semibold">3</td>
                            <td class="px-4 py-4 text-tertiary font-semibold">Pencetakan Kartu Ujian</td>
                            <td class="px-4 py-4 text-center text-tertiary font-semibold">09 Juni 2026</td>
                            <td class="px-4 py-4 text-tertiary text-sm">Online dilakukan oleh calon siswa</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-4 text-center text-tertiary font-semibold">4</td>
                            <td class="px-4 py-4 text-tertiary font-semibold">Tes Akademik</td>
                            <td class="px-4 py-4 text-center text-tertiary font-semibold">10 - 12 dan 15 Juni 2026</td>
                            <td class="px-4 py-4 text-tertiary text-sm">Tes dilakukan secara Tatap muka sesuai Jadwal di Kartu Peserta</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-4 text-center text-tertiary font-semibold">5</td>
                            <td class="px-4 py-4 text-tertiary font-semibold">Tes Baca Qur'an dan Wawancara</td>
                            <td class="px-4 py-4 text-center text-tertiary font-semibold">17 - 19 dan 22 Juni 2026</td>
                            <td class="px-4 py-4 text-tertiary text-sm">Tes dilakukan secara Tatap muka sesuai Jadwal di Kartu Peserta</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-4 text-center text-tertiary font-semibold">6</td>
                            <td class="px-4 py-4 text-tertiary font-semibold">Pengumuman</td>
                            <td class="px-4 py-4 text-center text-tertiary font-semibold">25 Juni 2026</td>
                            <td class="px-4 py-4 text-tertiary text-sm">Pengumuman Online</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-4 text-center text-tertiary font-semibold">7</td>
                            <td class="px-4 py-4 text-tertiary font-semibold">Daftar Ulang</td>
                            <td class="px-4 py-4 text-center text-tertiary font-semibold">29, 30 Juni - 01 Juli 2026</td>
                            <td class="px-4 py-4 text-tertiary text-sm">Daftar Ulang dilakukan secara Tatap muka dengan membawa Berkas-berkas</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Catatan Penting -->
    <div class="relative overflow-hidden">
        <!-- Background decoration -->
        <div class="absolute inset-0 bg-gradient-to-br from-primary/5 to-tertiary/5 rounded-2xl"></div>
        
        <div class="relative bg-white border-2 border-primary/30 rounded-2xl p-6 md:p-10 shadow-2xl">
            <!-- Header -->
            <div class="flex items-center justify-center gap-3 mb-8">
                <div class="bg-gradient-to-r from-primary to-tertiary rounded-full p-3">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl md:text-3xl text-center font-bold text-tertiary">Catatan Penting Pemberkasan</h3>
            </div>

            <!-- Alert Box -->
            <div class="bg-gradient-to-r from-orange-50 to-red-50 border-l-4 border-orange-500 rounded-lg p-4 mb-6">
                <div class="flex items-start gap-3">
                    <svg class="w-6 h-6 text-orange-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <div>
                        <p class="font-bold text-orange-800 mb-1">Perhatian!</p>
                        <p class="text-sm text-orange-700">Pastikan semua dokumen sesuai dengan format dan ukuran yang ditentukan</p>
                    </div>
                </div>
            </div>

            <!-- Document List -->
            <div class="space-y-4">
                <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-xl hover:bg-primary/5 transition-colors group">
                    <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-primary to-tertiary rounded-lg flex items-center justify-center text-white font-bold shadow-md group-hover:scale-110 transition-transform">
                        1
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-800 leading-relaxed">
                            <span class="font-semibold text-tertiary">Foto Terbaru 3x4</span> Berwarna Background Merah 
                            <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-1 rounded ml-2">JPEG / Max 200KB</span>
                        </p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-xl hover:bg-primary/5 transition-colors group">
                    <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-primary to-tertiary rounded-lg flex items-center justify-center text-white font-bold shadow-md group-hover:scale-110 transition-transform">
                        2
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-800 leading-relaxed">
                            <span class="font-semibold text-tertiary">Scan Akta Kelahiran</span>
                            <span class="inline-block bg-red-100 text-red-800 text-xs font-semibold px-2 py-1 rounded ml-2">PDF / Max 200KB</span>
                        </p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-xl hover:bg-primary/5 transition-colors group">
                    <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-primary to-tertiary rounded-lg flex items-center justify-center text-white font-bold shadow-md group-hover:scale-110 transition-transform">
                        3
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-800 leading-relaxed">
                            <span class="font-semibold text-tertiary">Scan Kartu Keluarga</span>
                            <span class="inline-block bg-red-100 text-red-800 text-xs font-semibold px-2 py-1 rounded ml-2">PDF / Max 200KB</span>
                        </p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-xl hover:bg-primary/5 transition-colors group">
                    <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-primary to-tertiary rounded-lg flex items-center justify-center text-white font-bold shadow-md group-hover:scale-110 transition-transform">
                        4
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-800 leading-relaxed">
                            <span class="font-semibold text-tertiary">Scan Sertifikat Akreditasi Sekolah Asal</span>
                            <span class="inline-block bg-red-100 text-red-800 text-xs font-semibold px-2 py-1 rounded ml-2">PDF / Max 200KB</span>
                        </p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-xl hover:bg-primary/5 transition-colors group">
                    <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-primary to-tertiary rounded-lg flex items-center justify-center text-white font-bold shadow-md group-hover:scale-110 transition-transform">
                        5
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-800 leading-relaxed">
                            <span class="font-semibold text-tertiary">Scan Rapor Semester 1 - 5</span> dari aslinya
                            <span class="inline-block bg-red-100 text-red-800 text-xs font-semibold px-2 py-1 rounded ml-2">PDF / Max 3MB</span>
                        </p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-xl hover:bg-primary/5 transition-colors group">
                    <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-primary to-tertiary rounded-lg flex items-center justify-center text-white font-bold shadow-md group-hover:scale-110 transition-transform">
                        6
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-800 leading-relaxed">
                            <span class="font-semibold text-tertiary">Screenshot NISN</span> dari Website 
                            <a href="https://nisn.data.kemdikbud.go.id" target="_blank" class="text-primary hover:text-tertiary font-semibold underline decoration-2 underline-offset-2">https://nisn.data.kemdikbud.go.id</a>
                            <span class="inline-block bg-red-100 text-red-800 text-xs font-semibold px-2 py-1 rounded ml-2">PDF / Max 200KB</span>
                        </p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-xl hover:bg-primary/5 transition-colors group">
                    <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-primary to-tertiary rounded-lg flex items-center justify-center text-white font-bold shadow-md group-hover:scale-110 transition-transform">
                        7
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-800 leading-relaxed">
                            <span class="font-semibold text-tertiary">Dokumen Pendukung Lainnya</span>
                            <span class="inline-block bg-red-100 text-red-800 text-xs font-semibold px-2 py-1 rounded ml-2">PDF / Max 200KB</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Footer Note -->
            <div class="mt-8 pt-6 border-t-2 border-dashed border-gray-300">
                <div class="flex items-start gap-3 text-sm text-gray-600">
                    <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="leading-relaxed">
                        <span class="font-semibold text-tertiary">Catatan:</span> Pastikan semua file yang diunggah dapat dibaca dengan jelas. File yang tidak sesuai ketentuan akan ditolak oleh sistem.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>