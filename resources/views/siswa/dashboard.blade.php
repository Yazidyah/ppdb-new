<x-app-layout>

    @if (session()->has('message'))
        <div id="toast-default"
            class="fixed top-5 left-1/2 transform -translate-x-1/2 z-50 flex items-center w-full max-w-sm p-4 text-gray-600 bg-white rounded-xl shadow-lg border border-red-100"
            role="alert">
            <div class="inline-flex items-center justify-center shrink-0 w-9 h-9 text-red-500 bg-red-100 rounded-full">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                </svg>
            </div>
            <div class="ms-3 text-sm font-medium">{{ session('message') }}</div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-700 rounded-lg p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 transition"
                data-dismiss-target="#toast-default" aria-label="Close">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    @endif

    {{-- Hero Banner --}}
    <div class="relative overflow-hidden bg-tertiary">
        <div class="absolute inset-0 opacity-10">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                        <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid)"/>
            </svg>
        </div>
        <div class="relative container mx-auto px-4 py-10 md:py-14">
            @if ($status >= 3)
                <div class="text-center text-white">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-400/20 mb-4">
                        <svg class="w-9 h-9 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h2 class="font-bold text-3xl md:text-4xl mb-2">Pendaftaran Berhasil!</h2>
                    <p class="text-lg text-green-200">Silakan Cek Email/Akun Kamu untuk Informasi Lebih Lanjut.</p>
                    <p class="text-sm text-green-300 mt-1">Screenshot halaman ini untuk bukti pendaftaran</p>
                </div>
            @else
                <div class="flex flex-col md:flex-row items-center md:items-start gap-5">
                    <div class="flex-1 text-white text-center md:text-left">
                        <p class="text-green-300 font-medium text-sm uppercase tracking-widest mb-1">Dashboard Siswa</p>
                        <h2 class="font-bold text-3xl md:text-4xl leading-tight">
                            Selamat Datang, <br class="hidden md:block">
                            <span class="text-secondary">Calon Siswa MAN 1 Kota Bogor</span>
                        </h2>
                        <p class="mt-3 text-green-200 text-base">Pantau status pendaftaran kamu di sini dan lengkapi semua berkas yang diperlukan.</p>
                    </div>
                    @if($calonSiswa && $calonSiswa->dataRegistrasi)
                    <div class="shrink-0 bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl px-6 py-4 text-white text-center min-w-[180px]">
                        <p class="text-xs text-green-200 uppercase tracking-widest mb-1">Jalur Pendaftaran</p>
                        <p class="font-bold text-xl">{{ $calonSiswa->dataRegistrasi->jalur->nama_jalur ?? 'Belum Dipilih' }}</p>
                        <div class="mt-3 pt-3 border-t border-white/20">
                            <p class="text-xs text-green-200 uppercase tracking-widest mb-1">No. Peserta</p>
                            <p class="font-semibold text-lg">{{ $calonSiswa->dataRegistrasi->nomor_peserta ?: '-' }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            @endif
        </div>
    </div>

    {{-- Progress Stepper --}}
    <div class="bg-white border-b border-gray-100 shadow-sm">
        <div class="container mx-auto px-4 py-6">
            <div class="flex items-center justify-center max-w-3xl mx-auto">

                {{-- Step 1 --}}
                <div class="flex flex-col items-center text-center flex-1">
                    <div class="flex items-center justify-center w-11 h-11 rounded-full font-bold text-base transition
                        {{ $activeStep >= 1 ? 'bg-tertiary text-white shadow-md shadow-tertiary/30' : 'bg-gray-100 text-gray-400 border-2 border-gray-200' }}">
                        @if($activeStep > 1)
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        @else
                            1
                        @endif
                    </div>
                    <p class="mt-2 text-sm font-semibold {{ $activeStep >= 1 ? 'text-tertiary' : 'text-gray-400' }}">Daftar Diri</p>
                    <p class="text-xs {{ $activeStep >= 1 ? 'text-gray-500' : 'text-gray-300' }} mt-0.5">{{ $daftarDiriDetail }}</p>
                </div>

                {{-- Connector 1-2 --}}
                <div class="flex-1 h-0.5 mx-2 mb-7 rounded {{ $activeStep >= 2 ? 'bg-tertiary' : 'bg-gray-200' }}"></div>

                {{-- Step 2 --}}
                <div class="flex flex-col items-center text-center flex-1">
                    <div class="flex items-center justify-center w-11 h-11 rounded-full font-bold text-base transition
                        {{ $activeStep >= 2 ? 'bg-tertiary text-white shadow-md shadow-tertiary/30' : 'bg-gray-100 text-gray-400 border-2 border-gray-200' }}">
                        @if($activeStep > 2)
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        @else
                            2
                        @endif
                    </div>
                    <p class="mt-2 text-sm font-semibold {{ $activeStep >= 2 ? 'text-tertiary' : 'text-gray-400' }}">Verifikasi Berkas</p>
                    <p class="text-xs {{ $activeStep >= 2 ? 'text-gray-500' : 'text-gray-300' }} mt-0.5">{{ $verifikasiDetail }}</p>
                </div>

                {{-- Connector 2-3 --}}
                <div class="flex-1 h-0.5 mx-2 mb-7 rounded {{ $activeStep >= 3 ? 'bg-tertiary' : 'bg-gray-200' }}"></div>

                {{-- Step 3 --}}
                <div class="flex flex-col items-center text-center flex-1">
                    <div class="flex items-center justify-center w-11 h-11 rounded-full font-bold text-base transition
                        {{ $activeStep >= 3 ? 'bg-tertiary text-white shadow-md shadow-tertiary/30' : 'bg-gray-100 text-gray-400 border-2 border-gray-200' }}">
                        @if($activeStep > 3)
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        @else
                            3
                        @endif
                    </div>
                    <p class="mt-2 text-sm font-semibold {{ $activeStep >= 3 ? 'text-tertiary' : 'text-gray-400' }}">Tes & Wawancara</p>
                    <p class="text-xs {{ $activeStep >= 3 ? 'text-gray-500' : 'text-gray-300' }} mt-0.5">{{ $tesWawancaraDetail }}</p>
                </div>

            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8 space-y-8">

        {{-- CTA Pendaftaran --}}
        @if ($status < 3 || (in_array($status, [4, 6]) && (($calonSiswa->dataRegistrasi->id_jalur ?? null) != 1)))
            @php
                $isDaftarUlang = in_array($status, [4, 6]) && (($calonSiswa->dataRegistrasi->id_jalur ?? null) != 1);
                $ctaLabel = $isDaftarUlang ? 'Daftar Ulang' : ($status != 0 ? 'Lanjutkan Pendaftaran' : 'Mulai Pendaftaran');
                $ctaDesc  = $isDaftarUlang ? 'Kamu bisa mendaftar ulang dengan memilih jalur baru.' : ($status != 0 ? 'Segera lengkapi berkas dan data pendaftaranmu.' : 'Klik tombol di bawah untuk memulai proses pendaftaran.');
            @endphp
            <div class="relative overflow-hidden bg-gradient-to-r from-primary to-tertiary rounded-2xl shadow-lg p-6 flex flex-col md:flex-row items-center gap-5">
                <div class="absolute right-0 top-0 bottom-0 w-48 opacity-10 hidden md:block">
                    <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" class="w-full h-full text-white fill-current">
                        <path d="M37.9,-65.5C49.4,-58.8,59.3,-49.5,66.4,-38.1C73.5,-26.7,77.8,-13.4,76.4,-0.8C75.1,11.8,68.1,23.6,60.2,34.3C52.3,45,43.6,54.6,32.7,61.1C21.9,67.6,9,71,-2.9,75.3C-14.8,79.6,-29.6,84.9,-40.9,79.7C-52.1,74.5,-59.8,59,-64.3,44C-68.7,28.9,-70,14.4,-70.7,-0.4C-71.4,-15.3,-71.5,-30.5,-64.8,-42.1C-58.2,-53.6,-44.8,-61.5,-31.8,-67.2C-18.9,-72.9,-6.4,-76.4,4.8,-83.9C15.9,-91.4,26.4,-72.3,37.9,-65.5Z" transform="translate(100 100)"/>
                    </svg>
                </div>
                <div class="flex-shrink-0 w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <div class="flex-1 text-white text-center md:text-left">
                    <h3 class="font-bold text-xl">{{ strtoupper($ctaLabel) }}</h3>
                    <p class="text-green-200 text-sm mt-1">{{ $ctaDesc }}</p>
                </div>
                <a href="{{ route('siswa.daftar-step-satu', ['t' => 1]) }}"
                    class="relative z-10 inline-flex items-center gap-2 px-6 py-3 bg-white text-tertiary font-bold rounded-xl hover:bg-secondary transition-all duration-200 shadow-md hover:shadow-lg text-sm shrink-0">
                    {{ strtoupper($ctaLabel) }}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        @endif

        {{-- Data Cards --}}
        @if ($calonSiswa && $calonSiswa->dataRegistrasi)
            <div>
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <span class="w-1 h-6 bg-tertiary rounded-full inline-block"></span>
                    Data yang Telah Diisi
                </h3>

                {{-- Registrasi Card --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-5">
                    <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-50 bg-gray-50/50">
                        <div class="w-9 h-9 bg-tertiary/10 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-tertiary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <h4 class="font-semibold text-gray-800">Data Registrasi</h4>
                    </div>
                    <div class="p-5 grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="col-span-1">
                            <p class="text-xs font-medium text-gray-400 uppercase tracking-wide mb-1">Nomor Peserta</p>
                            <p class="font-semibold text-gray-800 text-sm bg-gray-50 rounded-lg px-3 py-2 border border-gray-100">
                                {{ $calonSiswa->dataRegistrasi->nomor_peserta ?: 'Tidak Ada' }}
                            </p>
                        </div>
                        <div class="col-span-1">
                            <p class="text-xs font-medium text-gray-400 uppercase tracking-wide mb-1">Jalur</p>
                            <p class="font-semibold text-gray-800 text-sm bg-gray-50 rounded-lg px-3 py-2 border border-gray-100">
                                {{ $calonSiswa->dataRegistrasi->jalur->nama_jalur ?? 'Belum Dipilih' }}
                            </p>
                        </div>
                        <div class="col-span-1">
                            <p class="text-xs font-medium text-gray-400 uppercase tracking-wide mb-1">Tes BQ & Wawancara</p>
                            <p class="font-semibold text-sm bg-gray-50 rounded-lg px-3 py-2 border border-gray-100 {{ $jadwalTesBQ ? 'text-gray-800' : 'text-amber-500' }}">
                                {{ $jadwalTesBQ ?: 'Belum Dijadwalkan' }}
                            </p>
                        </div>
                        <div class="col-span-1">
                            <p class="text-xs font-medium text-gray-400 uppercase tracking-wide mb-1">Seleksi</p>
                            <p class="font-semibold text-sm bg-gray-50 rounded-lg px-3 py-2 border border-gray-100 {{ $jadwalTesJapres ? 'text-gray-800' : 'text-amber-500' }}">
                                {{ $jadwalTesJapres ?: 'Belum Dijadwalkan' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    {{-- Informasi Pribadi Card --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-50 bg-gray-50/50">
                            <div class="w-9 h-9 bg-tertiary/10 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-tertiary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <h4 class="font-semibold text-gray-800">Informasi Pribadi</h4>
                        </div>
                        <div class="p-5 space-y-3">
                            @php
                                $pribadi = [
                                    'Nama Lengkap'     => ucwords($calonSiswa->nama_lengkap ?? '-'),
                                    'NIK'              => $calonSiswa->NIK ?? '-',
                                    'No. Telepon'      => $calonSiswa->no_telp ?? '-',
                                    'Jenis Kelamin'    => $calonSiswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan',
                                    'Tempat Lahir'     => ucwords($calonSiswa->tempat_lahir ?? '-'),
                                    'Tanggal Lahir'    => $calonSiswa->tanggal_lahir ? \Carbon\Carbon::parse($calonSiswa->tanggal_lahir)->locale('id')->translatedFormat('d F Y') : '-',
                                    'Alamat Domisili'  => ucwords($calonSiswa->alamat_domisili ?? '-'),
                                ];
                            @endphp
                            @foreach($pribadi as $label => $value)
                                <div class="flex items-start justify-between gap-3 py-2 {{ !$loop->last ? 'border-b border-gray-50' : '' }}">
                                    <span class="text-xs font-medium text-gray-400 uppercase tracking-wide shrink-0 w-32">{{ $label }}</span>
                                    <span class="text-sm font-medium text-gray-800 text-right">{{ $value }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Informasi Pendidikan Card --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-50 bg-gray-50/50">
                            <div class="w-9 h-9 bg-tertiary/10 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-tertiary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                                </svg>
                            </div>
                            <h4 class="font-semibold text-gray-800">Informasi Pendidikan</h4>
                        </div>
                        <div class="p-5 space-y-3">
                            @php
                                $pendidikan = [
                                    'NISN'             => $calonSiswa->NISN ?? '-',
                                    'NPSN'             => strtoupper($calonSiswa->NPSN ?? '-'),
                                    'Sekolah Asal'     => strtoupper($calonSiswa->sekolah_asal ?? '-'),
                                    'Status Sekolah'   => strtoupper($calonSiswa->status_sekolah ?? '-'),
                                ];
                            @endphp
                            @foreach($pendidikan as $label => $value)
                                <div class="flex items-start justify-between gap-3 py-2 {{ !$loop->last ? 'border-b border-gray-50' : '' }}">
                                    <span class="text-xs font-medium text-gray-400 uppercase tracking-wide shrink-0 w-32">{{ $label }}</span>
                                    <span class="text-sm font-medium text-gray-800 text-right">{{ $value }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        @endif

    </div>

</x-app-layout>