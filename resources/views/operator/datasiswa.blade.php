<x-app-layout>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="container mx-auto text-center pt-7">


                <div class="container mx-auto text-center pt-7 ">
                    <h1 @click="tahun = !tahun" class="font-bold text-[32px] pt-7 pb-7 ">Siswa Terdaftar</h1>
                    
                    <!-- Search and Filter Form -->
                    <form method="GET" action="{{ route('operator.datasiswa') }}" class="mb-4 flex justify-between" id="searchForm">
                    <div>    
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama atau NISN" class="px-4 py-2 border rounded-lg">
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Search</button>
                        
                        </div>
                        <div>
                        <select name="filter" class="px-4 py-2 border rounded-lg" onchange="document.getElementById('searchForm').submit()">
                            <option value="" {{ !request('filter') ? 'selected' : '' }}>Tidak ada filter data</option>
                            <option value="L" {{ request('filter') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ request('filter') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            <option value="NEGERI" {{ request('filter') == 'NEGERI' ? 'selected' : '' }}>Sekolah Negeri</option>
                            <option value="SWASTA" {{ request('filter') == 'SWASTA' ? 'selected' : '' }}>Sekolah Swasta</option>
                            <option value="0" {{ request('filter') == '0' ? 'selected' : '' }}>Belum diproses</option>
                            <option value="1" {{ request('filter') == '1' ? 'selected' : '' }}>Lulus</option>
                            <option value="2" {{ request('filter') == '2' ? 'selected' : '' }}>Tidak Lulus</option>
                        </select>
                        <select name="jalur" class="px-4 py-2 border rounded-lg" onchange="document.getElementById('searchForm').submit()">
                            <option value="" {{ !request('jalur') ? 'selected' : '' }}>Tidak ada filter jalur</option>
                            @foreach($jalurRegistrasi as $jalur)
                                <option value="{{ $jalur->id_jalur }}" {{ request('jalur') == $jalur->id_jalur ? 'selected' : '' }}>{{ $jalur->nama_jalur }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="sort_by" value="{{ request('sort_by', 'id_calon_siswa') }}">
                        <input type="hidden" name="sort_order" value="{{ request('sort_order', 'asc') }}">
                        @if(request('search') || request('filter') || request('jalur'))
                            <a href="{{ route('operator.datasiswa') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg">Reset</a>
                        @endif
                    </div>
                    </form>
                    <div x-show="tahun"
                        class="w-full overflow-x-auto   mx-auto flex  items-center relative shadow-md sm:rounded-lg my-6">

                        <table class="w-full max-w-full rtl:justify-left text-sm text-left text-gray-500  my-3">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <button type="submit" form="searchForm" name="sort_by" value="id_calon_siswa" class="text-gray-700">No</button>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <button type="submit" form="searchForm" name="sort_by" value="nama_lengkap" class="text-gray-700">Nama</button>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <button type="submit" form="searchForm" name="sort_by" value="NISN" class="text-gray-700">NISN</button>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <button type="submit" form="searchForm" name="sort_by" value="sekolah_asal" class="text-gray-700">Asal Sekolah</button>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <button type="submit" form="searchForm" name="sort_by" value="jenis_kelamin" class="text-gray-700">Jenis Kelamin</button>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <button type="submit" form="searchForm" name="sort_by" value="total_rata_nilai" class="text-gray-700">Nilai rata-rata</button>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <button type="submit" form="searchForm" name="sort_by" value="status" class="text-gray-700">Status</button>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <button type="submit" form="searchForm" name="sort_by" value="status" class="text-gray-700">Status</button>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $siswa)
                                    <tr onclick="window.location.href='{{ route('operator.datasiswa-detail', $siswa->id_calon_siswa) }}'"
                                        class="hover:bg-gray-200 transition duration-200 cursor-pointer">
                                        <td scope="col" class="px-6 py-3 text-center">
                                            {{ $siswa->id_calon_siswa }}
                                        </td>
                                        <td scope="col" class="px-6 py-3 text-center">
                                            {{ $siswa->nama_lengkap }}
                                        </td>
                                        <td scope="col" class="px-6 py-3 text-center">
                                            {{ $siswa->NISN }}
                                        </td>
                                        <td scope="col" class="px-6 py-3 text-center">
                                            {{ $siswa->sekolah_asal }}
                                        </td>
                                        <td scope="col" class="px-6 py-3 text-center">
                                            {{ $siswa->jenis_kelamin }}
                                        </td>
                                        <td scope="col" class="px-6 py-3 text-center">
                                            {{ $siswa->dataRegistrasi->rapot->total_rata_nilai ?? '-' }}
                                        </td>
                                        <td scope="col" class="px-6 py-3 text-center">
                                            @if($siswa->dataRegistrasi->status == '1')
                                                <span class="px-2 py-1 bg-green-500 text-white font-medium rounded-lg">Lulus</span>
                                            @elseif($siswa->dataRegistrasi->status == '2')
                                                <span class="px-2 py-1 bg-red-500 text-white font-medium rounded-lg">Tidak Lulus</span>
                                            @else
                                                <span class="px-2 py-1 bg-yellow-500 text-white font-medium rounded-lg">Belum diproses</span>
                                            @endif
                                        <td scope="col" class="px-6 py-3 text-center">
                                            <a href="{{ route('operator.lulus', $siswa->id_calon_siswa) }}"
                                                class="px-4 py-2 bg-tertiary text-white font-medium rounded-lg hover:bg-secondary hover:text-tertiary">Lulus</a>
                                            <a href="{{ route('operator.tidaklulus', $siswa->id_calon_siswa) }}"
                                                class="px-4 py-2 bg-red-700 text-white font-medium rounded-lg hover:bg-red-900 hover:text-white">Tidak
                                                Lulus</a>
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

</x-app-layout>
