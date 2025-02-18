<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14  w-[1460px]">
        <div class="container mx-auto">
            <div class="overflow-x-auto rounded-lg shadow-sm">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-3 w-12 text-center">No</th>
                            <th scope="col" class="px-4 py-3 min-w-[160px]">Nama</th>
                            <th scope="col" class="px-4 py-3 w-32">NISN</th>
                            <th scope="col" class="px-4 py-3 min-w-[200px]">Asal Sekolah</th>
                            <th scope="col" class="px-4 py-3 w-36">Jenis Kelamin</th>
                            <th scope="col" class="px-4 py-3 w-40">Nilai Rata-rata</th>
                            <th scope="col" class="px-4 py-3 w-40">Domisili</th>
                            <th scope="col" class="px-4 py-3 w-32">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <div>
                            @foreach ($pendaftarans as $pendaftaran)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-4 py-2 text-center">{{ $pendaftaran->id_calon_siswa }}</td>
                                    <td class="px-4 py-2 font-medium  whitespace-nowrap">
                                        {{ ucwords(@$pendaftaran->nama_lengkap ?? 'Belum Di Lengkapi') }}
                                    </td>
                                    <td class="px-4 py-2">{{ @$pendaftaran->NISN ?? 'Belum Di Lengkapi' }}</td>
                                    <td class="px-4 py-2"> {{ @$pendaftaran->sekolah_asal ?? 'Belum Di Lengkapi' }}
                                    </td>
                                    <td class="px-4 py-2"> {{ @$siswa->jenis_kelamin ?? 'Belum Di Lengkapi' }}
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ @$siswa->dataRegistrasi->rapot->total_rata_nilai ?? 'Belum Di Lengkapi' }}
                                    </td>
                                    <td class="px-4 py-2">Dalam Kota</td>
                                    <td class="px-4 py-2">
                                        <span
                                            class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                            Lulus
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </div>
                        <div class="mt-3">
                            {{ $pendaftarans->links() }}
                        </div>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
