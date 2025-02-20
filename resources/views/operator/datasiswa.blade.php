<x-app-layout>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="container mx-auto text-center pt-7">
                <div class="container mx-auto text-center pt-7 ">
                    <h1 @click="tahun = !tahun" class="font-bold text-[32px] pt-7 pb-7 ">Siswa Terdaftar</h1>
                    <!-- Search and Filter Form -->
                    <form method="GET" action="{{ route('operator.datasiswa') }}" class="mb-4 flex justify-between"
                        id="searchForm">
                        <div>
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari Nama atau NISN" class="px-4 py-2 border rounded-lg" id="searchInput">
                                <input type="text" name="sekolah_asal" value="{{ request('sekolah_asal') }}" placeholder="Cari Asal Sekolah" class="px-4 py-2 border rounded-lg" id="sekolahAsalInput">
                        </div>
                        <div>
                            <select name="filter" class="px-4 py-2 border rounded-lg"
                                onchange="document.getElementById('searchForm').submit()">
                                <option value="" {{ !request('filter') ? 'selected' : '' }}>Tidak ada filter status
                                </option>
                                <option value="0" {{ request('filter') == '0' ? 'selected' : '' }}>Jalur</option>
                                <option value="1" {{ request('filter') == '1' ? 'selected' : '' }}>Upload</option>
                                <option value="2" {{ request('filter') == '2' ? 'selected' : '' }}>Submit</option>
                                <option value="3" {{ request('filter') == '3' ? 'selected' : '' }}>Tidak Lolos Verifikasi Berkas</option>
                                <option value="4" {{ request('filter') == '4' ? 'selected' : '' }}>Lolos Verifikasi Berkas</option>
                                <option value="5" {{ request('filter') == '5' ? 'selected' : '' }}>Belum Ditentukan</option>
                                <option value="6" {{ request('filter') == '6' ? 'selected' : '' }}>Tidak Diterima</option>
                                <option value="7" {{ request('filter') == '7' ? 'selected' : '' }}>Diterima</option>
                                <option value="7" {{ request('filter') == '8' ? 'selected' : '' }}>Dicadangkan</option>
                            </select>
                            <select name="jalur" class="px-4 py-2 border rounded-lg"
                                onchange="document.getElementById('searchForm').submit()">
                                <option value="" {{ !request('jalur') ? 'selected' : '' }}>Tidak ada filter jalur
                                </option>
                                @foreach ($jalurRegistrasi as $jalur)
                                    <option value="{{ $jalur->id_jalur }}" {{ request('jalur') == $jalur->id_jalur ? 'selected' : '' }}>
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
                    <div x-show="tahun"
                        class="w-full overflow-x-auto   mx-auto flex  items-center relative shadow-md sm:rounded-lg my-6">
                        <table class="w-full max-w-full rtl:justify-left text-sm text-left text-gray-500  my-3">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
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
                                        <button type="submit" form="searchForm" name="sort_by" value="NISN"
                                            class="text-gray-700">NISN</button>
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
                                        <button type="submit" form="searchForm" name="sort_by" value="status"
                                            class="text-gray-700">Status</button>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <button type="submit" form="searchForm" name="sort_by" value="status"
                                            class="text-gray-700">Tanggal Daftar</button>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Verifikasi
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Penerimaan
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $siswa)
                                    <!-- <tr onclick="window.location.href='{{ route('operator.datasiswa-detail', $siswa->id_calon_siswa) }}'" -->
                                    <tr
                                        class="hover:bg-gray-200 transition duration-200 cursor-pointer">
                                        <td scope="col" class="px-6 py-3 text-center">
                                            {{ $siswa->id_calon_siswa }}
                                        </td>
                                        <td scope="col" class="px-6 py-3 text-center">
                                            {{ @$siswa->nama_lengkap ?? 'Belum Di Lengkapi' }}
                                        </td>
                                        <td scope="col" class="px-6 py-3 text-center">
                                            {{ @$siswa->NISN ?? 'Belum Di Lengkapi' }}
                                        </td>
                                        <td scope="col" class="px-6 py-3 text-center">
                                            {{ strtoupper(@$siswa->sekolah_asal ?? 'Belum Di Lengkapi') }}
                                        </td>
                                        <td scope="col" class="px-6 py-3 text-center">
                                            {{ @$siswa->jenis_kelamin ?? 'Belum Di Lengkapi' }}
                                        </td>
                                        <td scope="col" class="px-6 py-3 text-center">
                                            {{ @$siswa->dataRegistrasi->rapot->total_rata_nilai ?? '-' }}
                                        </td>
                                        <td scope="col" class="px-6 py-3 text-center">
                                            @switch($siswa->dataRegistrasi->status)
                                                @case(0)
                                                    Jalur
                                                    @break
                                                @case(1)
                                                    Upload
                                                    @break
                                                @case(2)
                                                    Submit
                                                    @break
                                                @case(3)
                                                    Tidak Lolos Verifikasi Berkas
                                                    @break
                                                @case(4)
                                                    Lolos Verifikasi Berkas
                                                    @break
                                                @case(5)
                                                    Belum Ditentukan
                                                    @break
                                                @case(6)
                                                    Tidak Diterima
                                                    @break
                                                @case(7)
                                                    Diterima
                                                    @break
                                                @case(8)
                                                    Dicadangkan
                                                    @break
                                                @default
                                                    -
                                            @endswitch
                                        </td>
                                        <td scope="col" class="px-6 py-3 text-center">
                                            {{ @$siswa->dataRegistrasi->created_at ? @$siswa->dataRegistrasi->created_at->format('d-m-Y') : '-' }}
                                        </td>
                                        <td scope="col" class="px-6 py-3 text-center">
                                            <button onclick="openModalVerif({{ $siswa->id_calon_siswa }})"
                                                class="px-4 py-2 bg-tertiary text-white font-medium rounded-lg hover:bg-secondary hover:text-tertiary">Verif</button>
                                        </td>
                                        <td scope="col" class="px-6 py-3 text-center">
                                            <button onclick="openModalStatus({{ $siswa->id_calon_siswa }})" class="px-4 py-2 bg-tertiary text-white font-medium rounded-lg hover:bg-secondary hover:text-tertiary">Update</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-3 text-center text-red-500">
                                            DATA TIDAK DITEMUKAN
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div id="verifModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg">
        <h2 class="text-xl font-bold mb-4">Verifikasi {{ $siswa->nama_lengkap }}</h2>
        <!-- Form untuk update verifikasi berkas -->
        <form method="POST" action="{{ route('operator.updateVerifBerkas') }}" id="verifForm">
            @csrf
            <input type="hidden" name="id_calon_siswa" id="modalVerifSiswaId">
            <table class="w-full mb-4">
                <thead>
                    <tr>
                        <th class="px-4 py-2">No.</th>
                        <th class="px-4 py-2">Dokumen (Klik untuk lihat)</th>
                        <th class="px-4 py-2">Verif</th>
                        <th class="px-4 py-2">Catatan</th>
                    </tr>
                </thead>
                <tbody id="dokumenTableBody">
                    <tr>
                        <td colspan="4" class="border px-4 py-2 text-center">Memuat...</td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Simpan Berkas</button>
        </form>
        
        <form method="POST" action="{{ route('operator.updateVerifStatus') }}" id="statusForm" class="mt-4">
            @csrf
            <input type="hidden" name="id_calon_siswa" id="modalStatusSiswaId">
            <select name="status" id="modalVerifStatus" class="px-4 py-2 border rounded-lg mb-4">
                <option value="3">Tidak</option>
                <option value="4">Lolos</option>
            </select>
            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg">Simpan Status</button>
        </form>
        
        <div class="flex justify-end mt-4">
            <button type="button" onclick="closeModalVerif()" class="px-4 py-2 bg-gray-500 text-white rounded-lg mr-2">Batal</button>
        </div>
    </div>
</div>
        <div id="statusModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-6 rounded-lg">
                <h2 class="text-xl font-bold mb-4">Ubah Status</h2>
                <form method="POST" action="{{ route('operator.updateStatus') }}">
                    @csrf
                    <input type="hidden" name="id_calon_siswa" id="modalSiswaId">
                    <select name="status" id="modalStatus" class="px-4 py-2 border rounded-lg mb-4">
                        <option value="5">Belum Ditentukan</option>
                        <option value="6">Tidak Diterima</option>
                        <option value="7">Diterima</option>
                        <option value="8">Dicadangkan</option>
                    </select>
                    <div class="flex justify-end">
                        <button type="button" onclick="closeModalStatus()" class="px-4 py-2 bg-gray-500 text-white rounded-lg mr-2">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        <script>
            async function openModalStatus(id) {
                document.getElementById('modalSiswaId').value = id;
                const response = await fetch(`/operator/get-status-verif/${id}`);
                const data = await response.json();
                document.getElementById('modalStatus').value = data.status;
                document.getElementById('statusModal').classList.remove('hidden');
            }

            function closeModalStatus() {
                document.getElementById('statusModal').classList.add('hidden');
            }

            async function openModalVerif(id) {
        document.getElementById('modalVerifSiswaId').value = id;
        document.getElementById('modalStatusSiswaId').value = id;

        // Fetch status verifikasi
        const responseStatus = await fetch(`/operator/get-status-verif/${id}`);
        const dataStatus = await responseStatus.json();
        document.getElementById('modalVerifStatus').value = dataStatus.status;

        // Fetch data berkas
        const responseBerkas = await fetch(`/operator/get-berkas/${id}`);
        const dataBerkas = await responseBerkas.json();

        const dokumenTableBody = document.getElementById('dokumenTableBody');
        dokumenTableBody.innerHTML = '';

        if (dataBerkas.dokumen && dataBerkas.dokumen.length > 0) {
            // Sort berkas by kategori_berkas_id
            dataBerkas.dokumen.sort((a, b) => a.kategori_berkas_id - b.kategori_berkas_id);

            dataBerkas.dokumen.forEach((dokumen, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="border px-4 py-2">${index + 1}</td>
                    <td class="border px-4 py-2"><a href="${dokumen.path}" target="_blank">${dokumen.nama}</a></td>
                    <td class="border px-4 py-2 text-center"><input type="checkbox" name="verif[${dokumen.id}]" value="1" ${dokumen.verif ? 'checked' : ''}></td>
                    <td class="border px-4 py-2"><input type="text" name="catatan[${dokumen.id}]" value="${dokumen.catatan || ''}" class="w-full px-2 py-1 border rounded-lg"></td>
                `;
                dokumenTableBody.appendChild(row);
            });
        } else {
            dokumenTableBody.innerHTML = `<tr><td colspan="4" class="border px-4 py-2 text-center">Tidak ada dokumen</td></tr>`;
        }

        document.getElementById('verifModal').classList.remove('hidden');
    }

    function closeModalVerif() {
        document.getElementById('verifModal').classList.add('hidden');
    }

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
</x-app-layout>