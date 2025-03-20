<div class="flex">
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="p-4 sm:ml-64">
    <div class="p-4  rounded-lg dark:border-gray-700 mt-14">
            <div class="container mx-auto text-center pt-3">
                <div class="container mx-auto mt-10">
            <h1 class="text-3xl font-bold">DATA PENDAFTAR CALON SISWA MAN 1 KOTA BOGOR</h1>
                <table class="table-auto overflow-x-auto mx-auto items-center relative shadow-md sm:rounded-lg my-6 w-full max-w-full rtl:justify-left text-sm text-left text-gray-500">
                    <thead class="w-full max-w-full rtl:justify-left text-lg text-left text-gray-500 my-3">
                        <tr class="text-sm text-tertiary uppercase bg-gray-50">
                            <th scope="col" class="px-4 py-2 text-center">No</th>
                            <th scope="col" class="px-4 py-2 text-center">Nama</th>
                            <th scope="col" class="px-4 py-2 text-center">NISN</th>
                            <th scope="col" class="px-4 py-2 text-center">Asal Sekolah</th>
                            <th scope="col" class="px-4 py-2 text-center">Jenis Kelamin</th>
                            <th scope="col" class="px-4 py-2 text-center">Nilai Rata-rata</th>
                            <th scope="col" class="px-4 py-2 text-center">Domisili</th>
                            <th scope="col" class="px-4 py-2 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            @foreach ($pendaftarans as $pendaftaran)
                                <tr onclick="window.location.href='{{ route('admin.data-siswa', ['id' => $pendaftaran->id_calon_siswa]) }}'"
                                    class="hover:bg-gray-200 transition duration-200 cursor-pointer">
                                    <td class="border text-tertiary text-center px-4 py-2 ">{{ $pendaftaran->id_calon_siswa }}</td>
                                    <td class="border text-tertiary text-center px-4 py-2 font-medium  whitespace-nowrap">
                                        {{ ucwords(@$pendaftaran->nama_lengkap ?? 'Belum Di Lengkapi') }}
                                    </td>
                                    <td class="border text-tertiary text-center px-4 py-2">{{ @$pendaftaran->NISN ?? 'Belum Di Lengkapi' }}</td>
                                    <td class="border text-tertiary text-center px-4 py-2"> {{ @$pendaftaran->sekolah_asal ?? 'Belum Di Lengkapi' }}
                                    </td>
                                    <td class="border text-tertiary text-center px-4 py-2"> {{ @$siswa->jenis_kelamin ?? 'Belum Di Lengkapi' }}
                                    </td>
                                    <td class="border text-tertiary text-center px-4 py-2">
                                        {{ @$siswa->dataRegistrasi->rapot->total_rata_nilai ?? 'Belum Di Lengkapi' }}
                                    </td>
                                    <td class="border text-tertiary text-center px-4 py-2">Dalam Kota</td>
                                    <td class="border text-tertiary text-center px-4 py-2">
                                        <span
                                            class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                            Lulus
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        
                        <div class="mt-3">
                            {{ $pendaftarans->links() }}
                        </div>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    
</div>
