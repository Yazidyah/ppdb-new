<div class="w-screen bg-gray-100 min-h-screen p-4 sm:ml-64">
    <div class="p-6 mx-auto flex justify-center">
        <div class="container mx-auto text-center pt-6">
            <div class="w-full container mx-auto mt-10">
                <h1 class="text-4xl font-extrabold text-gray-800 mb-6">Data Pendaftar Calon Siswa MAN 1 Kota Bogor</h1>
                <div wire:ignore class="mb-6">
                    @livewire('operator.export-data-siswa', key('export-data-admin' . rand()))
                </div>
                <div class="overflow-x-auto shadow-lg rounded-lg bg-white">
                    <table class="table-auto w-full text-sm text-left text-gray-600">
                        <thead class="bg-gray-200 text-gray-700 uppercase text-sm">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-center">No</th>
                                <th scope="col" class="px-6 py-3 text-center">Nama</th>
                                <th scope="col" class="px-6 py-3 text-center">NISN</th>
                                <th scope="col" class="px-6 py-3 text-center">Asal Sekolah</th>
                                <th scope="col" class="px-6 py-3 text-center">Jenis Kelamin</th>
                                <th scope="col" class="px-6 py-3 text-center">Nilai Rata-rata</th>
                                <th scope="col" class="px-6 py-3 text-center">Domisili</th>
                                <th scope="col" class="px-6 py-3 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pendaftarans as $pendaftaran)
                                <tr onclick="window.location.href='{{ route('admin.data-siswa', ['id' => $pendaftaran->id_calon_siswa]) }}'"
                                    class="hover:bg-gray-100 transition duration-200 cursor-pointer">
                                    <td class="border px-6 py-3 text-center">{{ $pendaftaran->id_calon_siswa }}</td>
                                    <td class="border px-6 py-3 text-center font-medium">
                                        {{ ucwords(@$pendaftaran->nama_lengkap ?? 'Belum Di Lengkapi') }}
                                    </td>
                                    <td class="border px-6 py-3 text-center">
                                        {{ @$pendaftaran->NISN ?? 'Belum Di Lengkapi' }}
                                    </td>
                                    <td class="border px-6 py-3 text-center">
                                        {{ @$pendaftaran->sekolah_asal ?? 'Belum Di Lengkapi' }}
                                    </td>
                                    <td class="border px-6 py-3 text-center">
                                        {{ @$siswa->jenis_kelamin ?? 'Belum Di Lengkapi' }}
                                    </td>
                                    <td class="border px-6 py-3 text-center">
                                        {{ @$siswa->dataRegistrasi->rapot->total_rata_nilai ?? 'Belum Di Lengkapi' }}
                                    </td>
                                    <td class="border px-6 py-3 text-center">Dalam Kota</td>
                                    <td class="border px-6 py-3 text-center">
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-3 py-1 rounded">
                                            Lulus
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-6">
                    {{ $pendaftarans->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
