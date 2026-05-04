<div class="p-6 lg:p-8 space-y-6">

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-tertiary">Data Pendaftaran</h1>
            <p class="text-sm text-gray-500 mt-0.5">Daftar seluruh calon peserta didik MAN 1 Kota Bogor</p>
        </div>
        <div wire:ignore>
            @livewire('operator.export-data-siswa', ['key' => 'export-data-admin-' . uniqid()])
        </div>
    </div>

    {{-- Table Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        <div class="px-5 py-4 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center gap-3">

            <div class="relative flex-1 max-w-sm">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35M17 11A6 6 0 1 0 5 11a6 6 0 0 0 12 0z"/>
                    </svg>
                </div>
                <input
                    wire:model.live.debounce.300ms="search"
                    type="text"
                    placeholder="Cari nama, NISN, atau asal sekolah..."
                    class="w-full rounded-xl border border-gray-200 bg-gray-50 py-2.5 pl-9 pr-9 text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition"
                />
                @if($search !== '')
                <button wire:click="$set('search', '')"
                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
                @endif
            </div>

            <div class="flex items-center gap-2 sm:ml-auto">
                <label class="text-xs text-gray-500 whitespace-nowrap">Tampilkan</label>
                <select wire:model.live="perPage"
                    class="rounded-xl border border-gray-200 bg-gray-50 py-2 px-3 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    {{-- <option value="100">100</option> --}}
                </select>
                <span class="text-xs text-gray-500 whitespace-nowrap">data</span>
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto" wire:loading.class="opacity-60 pointer-events-none">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="bg-tertiary text-white">
                        <th class="px-5 py-3.5 text-center font-semibold text-xs uppercase tracking-wide whitespace-nowrap">No</th>
                        <th class="px-5 py-3.5 font-semibold text-xs uppercase tracking-wide whitespace-nowrap">Nama</th>
                        <th class="px-5 py-3.5 text-center font-semibold text-xs uppercase tracking-wide whitespace-nowrap">NISN</th>
                        <th class="px-5 py-3.5 font-semibold text-xs uppercase tracking-wide whitespace-nowrap">Asal Sekolah</th>
                        <th class="px-5 py-3.5 text-center font-semibold text-xs uppercase tracking-wide whitespace-nowrap">Kelamin</th>
                        <th class="px-5 py-3.5 text-center font-semibold text-xs uppercase tracking-wide whitespace-nowrap">Nilai Rata-rata</th>
                        <th class="px-5 py-3.5 text-center font-semibold text-xs uppercase tracking-wide whitespace-nowrap">Domisili</th>
                        <th class="px-5 py-3.5 text-center font-semibold text-xs uppercase tracking-wide whitespace-nowrap">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($pendaftarans as $index => $pendaftaran)
                        @php
                            $statusMapping = [
                                7 => ['label' => 'Tidak Diterima', 'color' => 'bg-red-100 text-red-700'],
                                8 => ['label' => 'Diterima',       'color' => 'bg-green-100 text-green-700'],
                                9 => ['label' => 'Dicadangkan',    'color' => 'bg-yellow-100 text-yellow-700'],
                            ];
                            if (($pendaftaran->dataRegistrasi->status ?? 6) <= 6) {
                                $status = ['label' => 'Dalam Proses', 'color' => 'bg-secondary text-tertiary'];
                            } else {
                                $status = $statusMapping[$pendaftaran->dataRegistrasi->status] ?? ['label' => 'Tidak Diketahui', 'color' => 'bg-gray-100 text-gray-600'];
                            }
                            $nilai = (@$pendaftaran->dataRegistrasi->rapot->total_rata_nilai ?? null);
                            $nilaiDisplay = ($nilai === null || $nilai == 0.00) ? '-' : $nilai;
                            $jk = @$pendaftaran->jenis_kelamin;
                            $domisili = @$pendaftaran->kota;
                            $domisiliDisplay = $domisili === null ? '-' : ($domisili === 'KOTA BOGOR' ? 'Dalam Kota' : 'Luar Kota');
                        @endphp
                        <tr onclick="window.location.href='{{ route('admin.data-siswa', ['id' => $pendaftaran->id_calon_siswa]) }}'"
                            class="hover:bg-secondary/20 transition-colors duration-150 cursor-pointer group">
                            <td class="px-5 py-3.5 text-center text-gray-400 text-xs font-mono">
                                {{ $pendaftarans->firstItem() + $loop->index }}
                            </td>
                            <td class="px-5 py-3.5">
                                <span class="font-semibold text-gray-800 group-hover:text-tertiary transition-colors">
                                    {{ ucwords(@$pendaftaran->nama_lengkap ?? '—') }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5 text-center text-gray-500 font-mono text-xs">
                                {{ @$pendaftaran->NISN ?? '—' }}
                            </td>
                            <td class="px-5 py-3.5 text-gray-600 max-w-[200px] truncate">
                                {{ @$pendaftaran->sekolah_asal === null ? '—' : strtoupper(@$pendaftaran->sekolah_asal) }}
                            </td>
                            <td class="px-5 py-3.5 text-center">
                                @if($jk == 'L')
                                    <span class="inline-flex items-center gap-1 text-xs font-medium text-blue-700 bg-blue-50 px-2.5 py-0.5 rounded-full">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/></svg>
                                        L
                                    </span>
                                @elseif($jk == 'P')
                                    <span class="inline-flex items-center gap-1 text-xs font-medium text-pink-600 bg-pink-50 px-2.5 py-0.5 rounded-full">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/></svg>
                                        P
                                    </span>
                                @else
                                    <span class="text-gray-300">—</span>
                                @endif
                            </td>
                            <td class="px-5 py-3.5 text-center">
                                @if($nilaiDisplay === '-')
                                    <span class="text-gray-300">—</span>
                                @else
                                    <span class="font-semibold text-tertiary">{{ $nilaiDisplay }}</span>
                                @endif
                            </td>
                            <td class="px-5 py-3.5 text-center">
                                @if($domisiliDisplay === '-')
                                    <span class="text-gray-300">—</span>
                                @elseif($domisiliDisplay === 'Dalam Kota')
                                    <span class="inline-flex items-center text-xs font-medium text-primary bg-secondary px-2.5 py-0.5 rounded-full">Dalam Kota</span>
                                @else
                                    <span class="inline-flex items-center text-xs font-medium text-gray-600 bg-gray-100 px-2.5 py-0.5 rounded-full">Luar Kota</span>
                                @endif
                            </td>
                            <td class="px-5 py-3.5 text-center">
                                <span class="{{ $status['color'] }} text-xs font-semibold px-2.5 py-1 rounded-full whitespace-nowrap">
                                    {{ $status['label'] }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-5 py-16 text-center">
                                <div class="flex flex-col items-center gap-3 text-gray-400">
                                    <svg class="w-12 h-12 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    @if($search !== '')
                                        <p class="text-sm font-medium">Tidak ada hasil untuk "<span class="text-tertiary font-semibold">{{ $search }}</span>"</p>
                                        <button wire:click="$set('search', '')"
                                            class="mt-1 text-xs text-primary hover:underline font-medium">
                                            Hapus pencarian
                                        </button>
                                    @else
                                        <p class="text-sm font-medium">Belum ada data pendaftaran</p>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination Footer --}}
        <div class="px-5 py-4 border-t border-gray-100">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">

                <p class="text-xs text-gray-400">
                    @if($pendaftarans->total() > 0)
                        Menampilkan
                        <span class="font-semibold text-gray-600">{{ $pendaftarans->firstItem() }}</span>–<span class="font-semibold text-gray-600">{{ $pendaftarans->lastItem() }}</span>
                        dari <span class="font-semibold text-gray-600">{{ number_format($pendaftarans->total()) }}</span> pendaftar
                        @if($search !== '')
                            <span class="text-primary font-medium">(hasil pencarian)</span>
                        @endif
                    @else
                        Tidak ada data
                    @endif
                </p>

                @if($pendaftarans->hasPages())
                @php
                    $currentPage = $pendaftarans->currentPage();
                    $lastPage    = $pendaftarans->lastPage();
                    $window      = 2;
                    $pages       = collect(range(
                        max(1, $currentPage - $window),
                        min($lastPage, $currentPage + $window)
                    ));
                @endphp
                <div class="flex items-center gap-1">

                    @if($pendaftarans->onFirstPage())
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-gray-300 cursor-not-allowed select-none">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </span>
                    @else
                        <button wire:click="previousPage"
                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-tertiary transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>
                    @endif

                    @if($pages->first() > 1)
                        <button wire:click="gotoPage(1)"
                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-xs text-gray-500 hover:bg-gray-100 hover:text-tertiary transition">1</button>
                        @if($pages->first() > 2)
                            <span class="px-0.5 text-gray-300 text-xs select-none">...</span>
                        @endif
                    @endif

                    @foreach($pages as $page)
                        @if($page === $currentPage)
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-tertiary text-white text-xs font-semibold shadow-sm">{{ $page }}</span>
                        @else
                            <button wire:click="gotoPage({{ $page }})"
                                class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-xs text-gray-500 hover:bg-gray-100 hover:text-tertiary transition">{{ $page }}</button>
                        @endif
                    @endforeach

                    @if($pages->last() < $lastPage)
                        @if($pages->last() < $lastPage - 1)
                            <span class="px-0.5 text-gray-300 text-xs select-none">...</span>
                        @endif
                        <button wire:click="gotoPage({{ $lastPage }})"
                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-xs text-gray-500 hover:bg-gray-100 hover:text-tertiary transition">{{ $lastPage }}</button>
                    @endif

                    @if($pendaftarans->hasMorePages())
                        <button wire:click="nextPage"
                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-tertiary transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    @else
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-gray-300 cursor-not-allowed select-none">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </span>
                    @endif

                </div>
                @endif

            </div>
        </div>
    </div>
</div>
