<x-app-layout>
    <div class="p-4 sm:ml-64">

            <div class="container mx-auto text-center pt-3">
                <div class="container mx-auto text-center pt-3">
                    <h1 class="font-bold text-[32px] pt-3 pb-3">Siswa Terdaftar</h1>
                    <div wire:ignore>
                        @livewire('operator.export-data-siswa', key('export-data-' . rand()))
                    </div>
                    <!-- Search and Filter Form -->
                    <form method="GET" action="{{ route('operator.datasiswa') }}" class="mb-4 flex justify-between"
                        id="searchForm">
                        <div>
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari Nama atau NISN" class="px-4 py-2 border rounded-lg" id="searchInput">
                            <input type="text" name="sekolah_asal" value="{{ request('sekolah_asal') }}"
                                placeholder="Cari Asal Sekolah" class="px-4 py-2 border rounded-lg"
                                id="sekolahAsalInput">
                        </div>
                        <div>
                            <select name="filter" class="px-4 py-2 border rounded-lg"
                                onchange="document.getElementById('searchForm').submit()">
                                <option value="" {{ !request('filter') ? 'selected' : '' }}>Semua status</option>
                                <option value="1" {{ request('filter') == '1' ? 'selected' : '' }}>Jalur</option>
                                <option value="2" {{ request('filter') == '2' ? 'selected' : '' }}>Upload</option>
                                <option value="3" {{ request('filter') == '3' ? 'selected' : '' }}>Submit</option>
                                <option value="4" {{ request('filter') == '4' ? 'selected' : '' }}>Tidak Lolos
                                </option>
                                <option value="5" {{ request('filter') == '5' ? 'selected' : '' }}>Lolos</option>
                                <option value="6" {{ request('filter') == '6' ? 'selected' : '' }}>Belum Ditentukan
                                </option>
                                <option value="7" {{ request('filter') == '7' ? 'selected' : '' }}>Tidak Diterima
                                </option>
                                <option value="8" {{ request('filter') == '8' ? 'selected' : '' }}>Diterima
                                </option>
                                <option value="9" {{ request('filter') == '9' ? 'selected' : '' }}>Dicadangkan
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
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <button type="submit" form="searchForm" name="sort_by" value="id_calon_siswa"
                                            class="text-gray-700">No</button>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <button type="submit" form="searchForm" name="sort_by" value="nama_lengkap"
                                            class="text-gray-700">Nama</button>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Akun
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <button type="submit" form="searchForm" name="sort_by" value="sekolah_asal"
                                            class="text-gray-700">Asal Sekolah</button>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <button type="submit" form="searchForm" name="sort_by" value="jenis_kelamin"
                                            class="text-gray-700">Jenis Kelamin</button>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <button type="submit" form="searchForm" name="sort_by" value="total_rata_nilai"
                                            class="text-gray-700">Nilai rata-rata</button>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <button type="submit" form="searchForm" name="sort_by" value="total_rata_nilai"
                                            class="text-gray-700">Jadwal BQ/Japres</button>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <button type="submit" form="searchForm" name="sort_by" value="status"
                                            class="text-gray-700">Status</button>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <button type="submit" form="searchForm" name="sort_by" value="jalur"
                                            class="text-gray-700">Jalur</button>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <button type="submit" form="searchForm" name="sort_by" value="created_at"
                                            class="text-gray-700">Tanggal Daftar</button>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Verifikasi
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Penerimaan
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Detail
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $siswa)
                                    <tr class="hover:bg-gray-200 transition duration-200 cursor-pointer">
                                        <td scope="col" class="px-6 py-3 text-center">
                                            {{ $siswa->id_calon_siswa }}
                                        </td>
                                        <td scope="col" class="px-6 py-3 text-center">
                                            {{ $siswa->nama_lengkap ?? 'Belum Di Lengkapi' }}
                                        </td>
                                        <td scope="col" class="px-6 py-3 text-center hover-underline"
                                            onclick="if('{{ $siswa->no_telp }}') { window.open('https://api.whatsapp.com/send/?phone={{ preg_replace('/^0/', '62', $siswa->no_telp) }}&text&type=phone_number&app_absent=0', '_blank'); } else { alert('Nomor HP tidak tersedia'); }">
                                            {{ $siswa->NISN ?? 'Belum Di Lengkapi' }} /
                                            {{ $siswa->dataRegistrasi->nomor_peserta ?? '-' }} /
                                            {{ $siswa->user->email ?? '-' }}
                                        </td>
                                        <td scope="col" class="px-6 py-3 text-center">
                                            {{ strtoupper(@$siswa->sekolah_asal ?? 'Belum Di Lengkapi') }}
                                        </td>
                                        <td scope="col" class="px-6 py-3 text-center">
                                            {{ $siswa->jenis_kelamin ?? 'Belum Di Lengkapi' }}
                                        </td>
                                        <td scope="col" class="px-6 py-3 text-center">
                                            {{ $siswa->dataRegistrasi->rapot->total_rata_nilai ?? '-' }}
                                        </td>
                                        <td scope="col" class="px-6 py-3 text-center">
                                            {{ $siswa->dataRegistrasi->dataTes->pluck('id_jadwal_tes')->join(' / ') ?? '-' }}
                                            <!-- Display multiple id_jadwal_tes -->
                                        </td>
                                        <td scope="col" class="px-6 py-3 text-center">
                                            {{ $siswa->status_label ?? '-' }}
                                        </td>
                                        <td scope="col" class="px-6 py-3 text-center">
                                            {{ $siswa->dataRegistrasi->jalur->nama_jalur ?? '-' }}
                                        </td>
                                        <td scope="col" class="px-6 py-3 text-center">
                                            {{ @$siswa->dataRegistrasi->created_at ? @$siswa->dataRegistrasi->created_at->format('d-m-Y') : '-' }}
                                        </td>
                                        <td scope="col" class="px-6 py-3 text-center"
                                            onclick="event.stopPropagation()">
                                            @livewire('operator.verif-berkas', ['siswa' => $siswa], key($siswa->user_id . '-berkas-' . $siswa->id_calon_siswa))
                                        </td>
                                        <td scope="col" class="px-6 py-3 text-center"
                                            onclick="event.stopPropagation()">
                                            @livewire('operator.status-acc', ['siswa' => $siswa], key($siswa->user_id . '-status-' . $siswa->id_calon_siswa))
                                        </td>
                                        <td scope="col" class="px-6 py-3 text-center"
                                            onclick="event.stopPropagation()">
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
            </script>
        </div>
    </div>
</x-app-layout>
