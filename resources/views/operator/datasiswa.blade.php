<x-app-layout>
    <div class="p-4 sm:ml-64">
        <div class="mx-auto text-center pt-3">
            <h1 class="font-bold text-[32px] pt-3 pb-3">Siswa Terdaftar</h1>
            <div class="flex justify-start items-center">
                <div>
                    <div wire:ignore>
                        @livewire('operator.export-data-siswa', ['key' => 'export-data-' . uniqid()])
                    </div>
                </div>
                <div class="inline-flex rounded-md shadow-xs mb-4" role="group" id="page_request">
                    <button type="button"
                        class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border rounded-s-lg {{ request('per_page', 10) == 10 ? 'bg-tertiary text-tertiary' : '' }} hover:bg-gray-100 hover:text-tertiary focus:z-10 focus:text-white focus:bg-tertiary"
                        title="Menampilkan 10 data" onclick="updatePerPage(10)">
                        10
                    </button>
                    <button type="button"
                        class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-l border-gray-200 {{ request('per_page', 10) == 50 ? 'bg-tertiary text-tertiary' : '' }} hover:bg-gray-100 hover:text-tertiary focus:z-10 focus:text-white focus:bg-tertiary"
                        title="Menampilkan 50 data" onclick="updatePerPage(50)">
                        50
                    </button>
                    <button type="button"
                        class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-l border-gray-200 {{ request('per_page', 10) == 100 ? 'bg-tertiary text-tertiary' : '' }} hover:bg-gray-100 hover:text-tertiary focus:z-10 focus:text-white focus:bg-tertiary"
                        title="Menampilkan 100 data" onclick="updatePerPage(100)">
                        100
                    </button>
                    <button type="button"
                        class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg {{ request('per_page', 10) == -1 ? 'bg-tertiary text-tertiary' : '' }} hover:bg-gray-100 hover:text-tertiary focus:z-10 focus:text-white focus:bg-tertiary"
                        title="Menampilkan Semua data" onclick="updatePerPage(-1)">
                        All
                    </button>
                </div>
            </div>
            <!-- Search and Filter Form -->
            <form method="GET" action="{{ route('operator.datasiswa') }}" class="mb-4 flex justify-between"
                id="searchForm">
                <div>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari Nama atau NISN" class="px-4 py-2 border rounded-lg" id="searchInput">
                    <input type="text" name="sekolah_asal" value="{{ request('sekolah_asal') }}"
                        placeholder="Cari Asal Sekolah" class="px-4 py-2 border rounded-lg" id="sekolahAsalInput">
                </div>
                <div>
                    <select name="filter" class="px-4 py-2 border rounded-lg"
                        onchange="document.getElementById('searchForm').submit()">
                        <option value="" {{ !request('filter') ? 'selected' : '' }}>Semua status</option>
                        <option value="1" {{ request('filter') == '1' ? 'selected' : '' }}>Jalur</option>
                        <option value="2" {{ request('filter') == '2' ? 'selected' : '' }}>Upload</option>
                        <option value="3" {{ request('filter') == '3' ? 'selected' : '' }}>Submit</option>
                        <option value="4" {{ request('filter') == '4' ? 'selected' : '' }}>Tidak Lolos Berkas
                        </option>
                        <option value="5" {{ request('filter') == '5' ? 'selected' : '' }}>Lolos Berkas</option>
                        <option value="6" {{ request('filter') == '6' ? 'selected' : '' }}>Tidak Diterima
                        </option>
                        <option value="7" {{ request('filter') == '7' ? 'selected' : '' }}>Diterima
                        </option>
                        <option value="8" {{ request('filter') == '8' ? 'selected' : '' }}>Dicadangkan
                        </option>
                    </select>
                    <select name="jalur" class="px-4 py-2 border rounded-lg"
                        onchange="document.getElementById('searchForm').submit()">
                        <option value="" {{ !request('jalur') ? 'selected' : '' }}>Semua jalur</option>
                        @foreach ($jalurRegistrasi as $jalur)
                            <option value="{{ $jalur->id_jalur }}"
                                {{ request('jalur') == $jalur->id_jalur ? 'selected' : '' }}>
                                {{ $jalur->nama_jalur }}
                            </option>
                        @endforeach
                    </select>
                    <input type="hidden" name="sort_by" value="{{ request('sort_by', 'id_calon_siswa') }}">
                    <input type="hidden" name="sort_order" value="{{ request('sort_order', 'asc') }}">
                    @if (request('search') || request('filter') || request('jalur') || request('sekolah_asal'))
                        <a href="{{ route('operator.datasiswa') }}"
                            class="px-4 py-2 bg-gray-500 text-white rounded-lg">Reset</a>
                    @endif
                </div>
            </form>

            <div class="w-full overflow-x-auto mx-auto flex items-center relative shadow-md sm:rounded-lg my-6">
                <table class="w-full max-w-full rtl:justify-left text-sm text-left text-gray-500 my-3">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            @php
                                $columns = [
                                    ['name' => 'NO', 'sort_by' => 'id_calon_siswa'],
                                    ['name' => 'NAMA', 'sort_by' => 'nama_lengkap'],
                                    ['name' => 'AKUN (NISN / No. Regis / Email)', 'sort_by' => null],
                                    ['name' => 'ASAL SEKOLAH', 'sort_by' => 'sekolah_asal'],
                                    ['name' => 'JENIS KELAMIN', 'sort_by' => 'jenis_kelamin'],
                                    ['name' => 'NILAI RATA-RATA', 'sort_by' => 'total_rata_nilai'],
                                    ['name' => 'JADWAL BQ/JAPRES', 'sort_by' => null],
                                    ['name' => 'STATUS', 'sort_by' => 'status'],
                                    ['name' => 'JALUR', 'sort_by' => null],
                                    ['name' => 'TANGGAL DAFTAR', 'sort_by' => 'created_at'],
                                    ['name' => 'VERIFIKASI', 'sort_by' => null],
                                    ['name' => 'PENERIMAAN', 'sort_by' => null],
                                    ['name' => 'DETAIL', 'sort_by' => null],
                                ];
                            @endphp

                            @foreach ($columns as $column)
                                <th scope="col" class="px-6 py-3 text-left">
                                    @if ($column['sort_by'])
                                        <button type="submit" form="searchForm" name="sort_by"
                                            value="{{ $column['sort_by'] }}" class="text-gray-700 text-left"
                                            onclick="toggleSortOrder('{{ $column['sort_by'] }}')">
                                            {{ $column['name'] }}
                                        </button>
                                    @else
                                        {{ $column['name'] }}
                                    @endif
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $siswa)
                            <tr class="hover:bg-gray-200 transition duration-200 cursor-pointer">
                                @php
                                    $tdClass = 'px-6 py-3 text-left';
                                @endphp

                                <td scope="col" class="{{ $tdClass }}">
                                    {{ $loop->iteration }}
                                </td>
                                <td scope="col" class="{{ $tdClass }}">
                                    {{ $siswa->nama_lengkap ?? 'Belum Di Lengkapi' }}
                                </td>
                                <td scope="col" class="{{ $tdClass }} hover-underline"
                                    onclick="if('{{ $siswa->no_telp }}') { window.open('https://api.whatsapp.com/send/?phone={{ preg_replace('/^0/', '62', $siswa->no_telp) }}&text&type=phone_number&app_absent=0', '_blank'); } else { alert('Nomor HP tidak tersedia'); }">
                                    {{ $siswa->NISN ?? 'Belum Di Lengkapi' }} /
                                    {{ $siswa->dataRegistrasi->nomor_peserta ?? '-' }} /
                                    {{ $siswa->user->email ?? '-' }}
                                </td>
                                <td scope="col" class="{{ $tdClass }}">
                                    {{ strtoupper(@$siswa->sekolah_asal ?? 'Belum Di Lengkapi') }}
                                </td>
                                <td scope="col" class="{{ $tdClass }}">
                                    {{ $siswa->jenis_kelamin ?? 'Belum Di Lengkapi' }}
                                </td>
                                <td scope="col" class="{{ $tdClass }}">
                                    {{ ($siswa->dataRegistrasi->rapot->total_rata_nilai ?? 0) == 0 ? '-' : $siswa->dataRegistrasi->rapot->total_rata_nilai }}
                                </td>
                                <td scope="col" class="{{ $tdClass }}">
                                    {{ $siswa->dataRegistrasi->dataTes->pluck('id_jadwal_tes')->isNotEmpty() ? $siswa->dataRegistrasi->dataTes->pluck('id_jadwal_tes')->join(' / ') : '-' }}
                                </td>
                                <td scope="col" class="{{ $tdClass }}">
                                    {{ $siswa->status_label ?? '-' }}
                                </td>
                                <td scope="col" class="{{ $tdClass }}">
                                    {{ $siswa->dataRegistrasi->jalur->nama_jalur ?? '-' }}
                                </td>
                                <td scope="col" class="{{ $tdClass }}">
                                    {{ $siswa->tanggal_daftar }}
                                </td>
                                <td scope="col" class="px-6 py-3 text-center" onclick="event.stopPropagation()">
                                    @livewire('operator.verif-berkas', ['siswa' => $siswa], key($siswa->user_id . '-berkas-' . $siswa->id_calon_siswa))
                                </td>
                                <td scope="col" class="px-6 py-3 text-center" onclick="event.stopPropagation()">
                                    @livewire('operator.status-acc', ['siswa' => $siswa], key($siswa->user_id . '-status-' . $siswa->id_calon_siswa))
                                </td>
                                <td scope="col" class="px-6 py-3 text-center" onclick="event.stopPropagation()">
                                    @livewire('operator.datasiswa-modal', ['siswa' => $siswa], key($siswa->user_id . '-modal-' . $siswa->id_calon_siswa))
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="13" class="px-6 py-3 text-center text-red-500">
                                    DATA TIDAK DITEMUKAN
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="flex flex-col items-center">
                <span class="text-sm text-gray-700">
                    Menampilkan <span class="font-semibold text-gray-900">{{ $data->firstItem() }}</span>-
                    <span class="font-semibold text-gray-900">{{ $data->lastItem() }}</span> dari
                    <span class="font-semibold text-gray-900">{{ $data->total() }}</span> Data
                </span>
                <div class="inline-flex mt-2 xs:mt-0">
                    @if ($data->onFirstPage())
                        <button
                            class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-tertiary bg-opacity-20 rounded-s cursor-not-allowed">
                            Prev
                        </button>
                    @else
                        <a href="{{ $data->previousPageUrl() }}"
                            class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-tertiary rounded-s hover:bg-secondary hover:text-tertiary">
                            Prev
                        </a>
                    @endif
                    @if ($data->hasMorePages())
                        <a href="{{ $data->nextPageUrl() }}"
                            class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-tertiary border-0 border-s border-gray-700 rounded-e hover:bg-secondary hover:text-tertiary">
                            Next
                        </a>
                    @else
                        <button
                            class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-tertiary bg-opacity-20 border-0 border-s border-gray-700 rounded-e cursor-not-allowed">
                            Next
                        </button>
                    @endif
                </div>
            </div>
        </div>
        <style>
            .hover-underline:hover {
                text-decoration: underline;
                text-decoration-color: blue;
            }
        </style>
        <script>
            let debounceTimer;
            const debounce = (callback, delay) => {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(callback, delay);
            };

            document.getElementById('searchInput').addEventListener('input', function() {
                debounce(() => {
                    document.getElementById('searchForm').submit();
                }, 500);
            });

            document.getElementById('sekolahAsalInput').addEventListener('input', function() {
                debounce(() => {
                    document.getElementById('searchForm').submit();
                }, 500);
            });

            function updatePerPage(perPage) {
                const url = new URL(window.location.href);
                url.searchParams.set('per_page', perPage);
                url.searchParams.delete('page'); // Reset to the first page
                window.location.href = url.toString();
            }

            function toggleSortOrder(column) {
                const currentSortBy = document.querySelector('input[name="sort_by"]').value;
                const currentSortOrder = document.querySelector('input[name="sort_order"]').value;

                if (currentSortBy === column) {
                    document.querySelector('input[name="sort_order"]').value = currentSortOrder === 'asc' ? 'desc' : 'asc';
                } else {
                    document.querySelector('input[name="sort_order"]').value = 'asc';
                }
            }
        </script>
    </div>
    </div>
</x-app-layout>
