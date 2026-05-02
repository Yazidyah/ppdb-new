<div class="flex min-h-screen bg-gray-50">

    {{-- ===== SIDEBAR ===== --}}
    <aside class="w-64 bg-tertiary text-white fixed top-0 left-0 h-screen flex flex-col z-20 shadow-xl">

        {{-- Brand --}}
        <div class="flex items-center gap-3 px-6 py-5 border-b border-white/10 mt-[72px]">
            <div class="bg-white/10 rounded-lg p-2">
                <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 14l9-5-9-5-9 5 9 5z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                </svg>
            </div>
            <div class="leading-tight">
                <p class="text-xs text-secondary font-semibold uppercase tracking-wider">Admin Panel</p>
                <p class="text-sm font-bold text-white">MAN 1 Kota Bogor</p>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
            <p class="text-xs uppercase tracking-widest text-white/40 font-semibold px-3 mb-3">Menu Utama</p>

            <button wire:click="$set('tab', 1)" class="w-full text-left">
                <span @class([
                    'flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200',
                    'bg-white text-tertiary shadow-md' => $tab == 1,
                    'text-white/80 hover:bg-white/10 hover:text-white' => $tab != 1,
                ])>
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </span>
            </button>

            <button wire:click="$set('tab', 2)" class="w-full text-left">
                <span @class([
                    'flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200',
                    'bg-white text-tertiary shadow-md' => $tab == 2,
                    'text-white/80 hover:bg-white/10 hover:text-white' => $tab != 2,
                ])>
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Data Pendaftaran
                </span>
            </button>

            <button wire:click="$set('tab', 3)" class="w-full text-left">
                <span @class([
                    'flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200',
                    'bg-white text-tertiary shadow-md' => $tab == 3,
                    'text-white/80 hover:bg-white/10 hover:text-white' => $tab != 3,
                ])>
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Kelola Operator
                </span>
            </button>
        </nav>

        {{-- Footer --}}
        <div class="px-6 py-4 border-t border-white/10">
            <p class="text-xs text-white/40 text-center">PPDB {{ date('Y') }}/{{ date('Y') + 1 }}</p>
        </div>
    </aside>

    {{-- ===== MAIN CONTENT ===== --}}
    <div class="ml-64 flex-1 min-h-screen">

        @if ($tab === 1)
        <div class="p-6 lg:p-8 space-y-8">

            {{-- Page Header --}}
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-tertiary">Dashboard</h1>
                    <p class="text-sm text-gray-500 mt-0.5">Selamat datang, <strong>{{ Auth::user()->name }}</strong> — {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</p>
                </div>
                {{-- <div class="flex items-center gap-2">
                    @if ($isOpen->is_open)
                        <span class="inline-flex items-center gap-1.5 bg-green-100 text-green-700 text-xs font-semibold px-3 py-1.5 rounded-full border border-green-200">
                            <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                            Pendaftaran Dibuka
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 bg-red-100 text-red-600 text-xs font-semibold px-3 py-1.5 rounded-full border border-red-200">
                            <span class="w-2 h-2 rounded-full bg-red-500"></span>
                            Pendaftaran Ditutup
                        </span>
                    @endif
                </div> --}}
            </div>

            {{-- ── Hero: Total Pendaftar ── --}}
            @php $totalPendaftar = optional($statistik->whereIn('id', [1])->first())->count ?? 0; @endphp
            <div class="relative overflow-hidden rounded-2xl bg-tertiary text-white shadow-lg">
                <div class="absolute inset-0 opacity-10">
                    <svg viewBox="0 0 400 200" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                        <circle cx="350" cy="30" r="120" fill="white"/>
                        <circle cx="30" cy="170" r="80" fill="white"/>
                    </svg>
                </div>
                <div class="relative flex flex-col md:flex-row items-center justify-between px-8 py-6 gap-4">
                    <div class="flex items-center gap-5">
                        <div class="bg-white/15 rounded-2xl p-4">
                            <svg class="w-10 h-10 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-secondary text-sm font-semibold uppercase tracking-widest">Total Pendaftar</p>
                            <p class="text-5xl font-extrabold leading-none mt-1">{{ number_format($totalPendaftar) }}</p>
                            <p class="text-white/60 text-sm mt-1">Siswa telah mendaftar PPDB {{ date('Y') }}</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 text-center">
                        <div class="bg-white/10 rounded-xl px-5 py-3">
                            <p class="text-secondary text-xs font-semibold uppercase tracking-wider">Laki-laki</p>
                            <p class="text-2xl font-bold mt-0.5">{{ $countLakiLaki }}</p>
                        </div>
                        <div class="bg-white/10 rounded-xl px-5 py-3">
                            <p class="text-secondary text-xs font-semibold uppercase tracking-wider">Perempuan</p>
                            <p class="text-2xl font-bold mt-0.5">{{ $countPerempuan }}</p>
                        </div>
                        <div class="bg-white/10 rounded-xl px-5 py-3">
                            <p class="text-secondary text-xs font-semibold uppercase tracking-wider">Dalam Kota</p>
                            <p class="text-2xl font-bold mt-0.5">{{ $countDalamBogor }}</p>
                        </div>
                        <div class="bg-white/10 rounded-xl px-5 py-3">
                            <p class="text-secondary text-xs font-semibold uppercase tracking-wider">Luar Kota</p>
                            <p class="text-2xl font-bold mt-0.5">{{ $countLuarBogor }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Jalur Cards ── --}}
            <div>
                <h2 class="text-base font-semibold text-gray-700 mb-4 flex items-center gap-2">
                    <span class="w-1 h-5 rounded-full bg-primary inline-block"></span>
                    Pendaftar per Jalur
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                    @php
                        $jalurIcons = [
                            'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z',
                            'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z',
                            'M13 10V3L4 14h7v7l9-11h-7z',
                            'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
                            'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z',
                        ];
                        $jalurColors = ['from-emerald-500 to-green-600','from-teal-500 to-emerald-600','from-cyan-500 to-teal-600','from-green-600 to-primary','from-primary to-tertiary'];
                        $jalurIdx = 0;
                    @endphp
                    @foreach ($statistik->whereIn('id', [2,21,22,25,26]) as $stat)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow duration-300">
                        <div class="bg-gradient-to-br {{ $jalurColors[$jalurIdx] }} px-4 py-4 flex items-start gap-3">
                            <svg class="w-6 h-6 text-white/80 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="{{ $jalurIcons[$jalurIdx] }}"/>
                            </svg>
                            <p class="text-sm text-white font-bold leading-snug">{{ $stat->nama_statistik }}</p>
                        </div>
                        <div class="px-4 py-3">
                            <p class="text-4xl font-extrabold text-tertiary">{{ $stat->count }}</p>
                            <p class="text-xs text-gray-400 mt-0.5">pendaftar</p>
                        </div>
                    </div>
                    @php $jalurIdx++; @endphp
                    @endforeach
                </div>
            </div>

            {{-- ── Statistik Grid ── --}}
            <div>
                <h2 class="text-base font-semibold text-gray-700 mb-4 flex items-center gap-2">
                    <span class="w-1 h-5 rounded-full bg-primary inline-block"></span>
                    Statistik Pendaftar
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">

                    {{-- Jenis Kelamin --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="flex items-center gap-3 px-5 pt-5 pb-3 border-b border-gray-50">
                            <div class="bg-secondary rounded-lg p-2">
                                <svg class="w-4 h-4 text-tertiary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <h3 class="font-semibold text-sm text-gray-700">Jenis Kelamin</h3>
                        </div>
                        <div class="px-5 py-4 space-y-3">
                            @php $totalGender = $countLakiLaki + $countPerempuan ?: 1; @endphp
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-gray-600">Laki-laki</span>
                                    <span class="font-bold text-tertiary">{{ $countLakiLaki }}</span>
                                </div>
                                <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-primary rounded-full" style="width: {{ round($countLakiLaki/$totalGender*100) }}%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-gray-600">Perempuan</span>
                                    <span class="font-bold text-tertiary">{{ $countPerempuan }}</span>
                                </div>
                                <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-secondary rounded-full border border-primary/20" style="width: {{ round($countPerempuan/$totalGender*100) }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Status Sekolah --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="flex items-center gap-3 px-5 pt-5 pb-3 border-b border-gray-50">
                            <div class="bg-secondary rounded-lg p-2">
                                <svg class="w-4 h-4 text-tertiary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <h3 class="font-semibold text-sm text-gray-700">Asal Sekolah</h3>
                        </div>
                        <div class="px-5 py-4 space-y-3">
                            @php $totalSekolah = $countSekolahNegeri + $countSekolahSwasta ?: 1; @endphp
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-gray-600">Sekolah Negeri</span>
                                    <span class="font-bold text-tertiary">{{ $countSekolahNegeri }}</span>
                                </div>
                                <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-primary rounded-full" style="width: {{ round($countSekolahNegeri/$totalSekolah*100) }}%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-gray-600">Sekolah Swasta</span>
                                    <span class="font-bold text-tertiary">{{ $countSekolahSwasta }}</span>
                                </div>
                                <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-secondary rounded-full border border-primary/20" style="width: {{ round($countSekolahSwasta/$totalSekolah*100) }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Domisili --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="flex items-center gap-3 px-5 pt-5 pb-3 border-b border-gray-50">
                            <div class="bg-secondary rounded-lg p-2">
                                <svg class="w-4 h-4 text-tertiary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <h3 class="font-semibold text-sm text-gray-700">Domisili</h3>
                        </div>
                        <div class="px-5 py-4 space-y-3">
                            @php $totalDomisili = $countDalamBogor + $countLuarBogor ?: 1; @endphp
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-gray-600">Dalam Kota</span>
                                    <span class="font-bold text-tertiary">{{ $countDalamBogor }}</span>
                                </div>
                                <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-primary rounded-full" style="width: {{ round($countDalamBogor/$totalDomisili*100) }}%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-gray-600">Luar Kota</span>
                                    <span class="font-bold text-tertiary">{{ $countLuarBogor }}</span>
                                </div>
                                <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-secondary rounded-full border border-primary/20" style="width: {{ round($countLuarBogor/$totalDomisili*100) }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Status Pendaftaran --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="flex items-center gap-3 px-5 pt-5 pb-3 border-b border-gray-50">
                            <div class="bg-secondary rounded-lg p-2">
                                <svg class="w-4 h-4 text-tertiary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </div>
                            <h3 class="font-semibold text-sm text-gray-700">Status Pendaftaran</h3>
                        </div>
                        <div class="divide-y divide-gray-50">
                            @foreach([['Pilih Jalur', $countJalur, 'bg-blue-100 text-blue-700'], ['Upload Dokumen', $countUpload, 'bg-yellow-100 text-yellow-700'], ['Submit', $countSubmit, 'bg-green-100 text-green-700']] as [$label, $count, $badge])
                            <div class="flex items-center justify-between px-5 py-3">
                                <span class="text-sm text-gray-600">{{ $label }}</span>
                                <span class="text-sm font-bold px-2.5 py-0.5 rounded-full {{ $badge }}">{{ $count }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Status Administrasi --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="flex items-center gap-3 px-5 pt-5 pb-3 border-b border-gray-50">
                            <div class="bg-secondary rounded-lg p-2">
                                <svg class="w-4 h-4 text-tertiary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3 class="font-semibold text-sm text-gray-700">Status Administrasi</h3>
                        </div>
                        <div class="divide-y divide-gray-50">
                            <div class="flex items-center justify-between px-5 py-3">
                                <span class="text-sm text-gray-600">Lolos Administrasi</span>
                                <span class="text-sm font-bold px-2.5 py-0.5 rounded-full bg-green-100 text-green-700">{{ $countLolosAdministrasi }}</span>
                            </div>
                            <div class="flex items-center justify-between px-5 py-3">
                                <span class="text-sm text-gray-600">Tidak Lolos Administrasi</span>
                                <span class="text-sm font-bold px-2.5 py-0.5 rounded-full bg-red-100 text-red-600">{{ $countTidakLolosAdministrasi }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Status Penerimaan --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="flex items-center gap-3 px-5 pt-5 pb-3 border-b border-gray-50">
                            <div class="bg-secondary rounded-lg p-2">
                                <svg class="w-4 h-4 text-tertiary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                                </svg>
                            </div>
                            <h3 class="font-semibold text-sm text-gray-700">Status Penerimaan</h3>
                        </div>
                        <div class="divide-y divide-gray-50">
                            <div class="flex items-center justify-between px-5 py-3">
                                <span class="text-sm text-gray-600">Diterima</span>
                                <span class="text-sm font-bold px-2.5 py-0.5 rounded-full bg-green-100 text-green-700">{{ $countDiterima }}</span>
                            </div>
                            <div class="flex items-center justify-between px-5 py-3">
                                <span class="text-sm text-gray-600">Tidak Diterima</span>
                                <span class="text-sm font-bold px-2.5 py-0.5 rounded-full bg-red-100 text-red-600">{{ $countTidakDiterima }}</span>
                            </div>
                            <div class="flex items-center justify-between px-5 py-3">
                                <span class="text-sm text-gray-600">Dicadangkan</span>
                                <span class="text-sm font-bold px-2.5 py-0.5 rounded-full bg-yellow-100 text-yellow-700">{{ $countDicadangkan }}</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        @endif

        @if ($tab == 2)
            @livewire('admin.data-pendaftaran', key('data-pendaftaran' . rand()))
        @endif

        @if ($tab == 3)
            @livewire('admin.data-operator', key('data-operator' . rand()))
        @endif

    </div>
</div>
