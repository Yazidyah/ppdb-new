<div class="p-6 lg:p-8 space-y-6">

    {{-- Back button & breadcrumb --}}
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.dashboard') }}"
            class="inline-flex items-center gap-2 text-sm font-semibold text-tertiary bg-secondary hover:bg-primary hover:text-white px-4 py-2 rounded-xl transition-colors duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Dashboard
        </a>
        <span class="text-gray-300">/</span>
        <span class="text-sm text-gray-400">Detail Siswa</span>
    </div>

    {{-- Hero Card --}}
    <div class="relative overflow-hidden bg-tertiary rounded-2xl shadow-lg text-white">
        <div class="absolute inset-0 opacity-10">
            <svg viewBox="0 0 400 160" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                <circle cx="370" cy="20" r="100" fill="white"/>
                <circle cx="20" cy="140" r="70" fill="white"/>
            </svg>
        </div>
        <div class="relative px-6 py-6 flex flex-col sm:flex-row sm:items-center gap-5">
            {{-- Avatar --}}
            <div class="w-16 h-16 rounded-2xl bg-white/15 flex items-center justify-center flex-shrink-0">
                <svg class="w-9 h-9 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                </svg>
            </div>
            {{-- Info --}}
            <div class="flex-1">
                <h1 class="text-2xl font-extrabold leading-tight">{{ Str::title(@$siswa->nama_lengkap ?? '—') }}</h1>
                <p class="text-secondary text-sm font-medium mt-0.5">{{ strtoupper(@$siswa->sekolah_asal ?? 'Sekolah belum diisi') }}</p>
                <p class="text-white/50 text-xs mt-1">
                    Terdaftar sejak {{ \Carbon\Carbon::parse(@$siswa->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}
                </p>
            </div>
            {{-- Meta badges --}}
            <div class="flex flex-wrap gap-3 sm:flex-col sm:items-end">
                <div class="bg-white/10 rounded-xl px-4 py-2 text-center">
                    <p class="text-secondary text-xs font-semibold uppercase tracking-wider">Kode Registrasi</p>
                    <p class="text-white font-bold text-sm mt-0.5">{{ @$siswa->DataRegistrasi->nomor_peserta ?? '—' }}</p>
                </div>
                <div class="bg-white/10 rounded-xl px-4 py-2 text-center">
                    <p class="text-secondary text-xs font-semibold uppercase tracking-wider">Jalur</p>
                    <p class="text-white font-bold text-sm mt-0.5">{{ @$siswa->dataRegistrasi->jalur->nama_jalur ?? '—' }}</p>
                </div>
            </div>
        </div>
        {{-- Quick info strip --}}
        <div class="relative border-t border-white/10 grid grid-cols-2 sm:grid-cols-4 divide-x divide-white/10">
            @foreach([
                ['label' => 'NISN',         'value' => @$siswa->NISN ?? '—'],
                ['label' => 'Email',        'value' => @$siswa->user->email ?? '—'],
                ['label' => 'Jenis Kelamin','value' => (@$siswa->jenis_kelamin == 'L') ? 'Laki-laki' : ((@$siswa->jenis_kelamin == 'P') ? 'Perempuan' : '—')],
                ['label' => 'Domisili',     'value' => (@$siswa->kota == 'KOTA BOGOR') ? 'Dalam Kota' : (@$siswa->kota ? 'Luar Kota' : '—')],
            ] as $item)
            <div class="px-5 py-3">
                <p class="text-white/50 text-xs">{{ $item['label'] }}</p>
                <p class="text-white text-sm font-semibold mt-0.5 truncate">{{ $item['value'] }}</p>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Tab Navigation --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="flex border-b border-gray-100">
            @foreach([
                ['key' => 'detail',    'label' => 'Data Siswa',  'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                ['key' => 'orangtua', 'label' => 'Orang Tua',   'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'],
                ['key' => 'nilai',    'label' => 'Nilai',        'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                ['key' => 'berkas',   'label' => 'Berkas',       'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
            ] as $t)
            <button onclick="setTab('{{ $t['key'] }}')"
                id="tab-btn-{{ $t['key'] }}"
                class="flex-1 flex items-center justify-center gap-2 py-3.5 text-sm font-medium transition-colors duration-200
                    {{ $tab == $t['key'] ? 'text-tertiary border-b-2 border-tertiary bg-secondary/30' : 'text-gray-400 hover:text-tertiary border-b-2 border-transparent hover:bg-gray-50' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $t['icon'] }}"/>
                </svg>
                {{ $t['label'] }}
            </button>
            @endforeach
        </div>

        {{-- Tab Panels --}}
        <div class="p-5">
            <div id="detail-content" class="tab-content" style="display: {{ $tab == 'detail' ? 'block' : 'none' }};">
                @livewire('operator.tab-detail-siswa', ['siswa' => $siswa], key('tab-detail-' . $siswa->id_calon_siswa))
            </div>
            <div id="orangtua-content" class="tab-content" style="display: {{ $tab == 'orangtua' ? 'block' : 'none' }};">
                @livewire('operator.tab-ortu-siswa', ['siswa' => $siswa], key('tab-ortu-' . $siswa->id_calon_siswa))
            </div>
            <div id="nilai-content" class="tab-content" style="display: {{ $tab == 'nilai' ? 'block' : 'none' }};">
                @livewire('operator.tab-nilai-siswa', ['siswa' => $siswa], key('tab-nilai-' . $siswa->id_calon_siswa))
            </div>
            <div id="berkas-content" class="tab-content" style="display: {{ $tab == 'berkas' ? 'block' : 'none' }};">
                @livewire('operator.tab-berkas-siswa', ['siswa' => $siswa], key('tab-berkas-' . $siswa->id_calon_siswa))
            </div>
        </div>
    </div>

    <script>
        function setTab(tab) {
            // Reset all tabs
            document.querySelectorAll('[id^="tab-btn-"]').forEach(btn => {
                btn.classList.remove('text-tertiary', 'border-tertiary', 'bg-secondary/30', 'border-b-2');
                btn.classList.add('text-gray-400', 'border-transparent');
            });
            // Activate selected
            const active = document.getElementById('tab-btn-' + tab);
            if (active) {
                active.classList.add('text-tertiary', 'border-b-2', 'border-tertiary', 'bg-secondary/30');
                active.classList.remove('text-gray-400', 'border-transparent');
            }
            // Show/hide panels
            document.querySelectorAll('.tab-content').forEach(c => c.style.display = 'none');
            const panel = document.getElementById(tab + '-content');
            if (panel) panel.style.display = 'block';
        }
    </script>
</div>
