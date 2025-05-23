<div class="w-screen bg-gray-100 min-h-screen p-4 sm:ml-64">
    <div class="p-6 mx-auto flex justify-center">
        <div class="container mx-auto text-center pt-6">
            <div class="w-full container mx-auto mt-10">
                <h1 class="text-4xl font-extrabold text-gray-800 mb-6">Data Pendaftar Calon Siswa MAN 1 Kota Bogor
                </h1>
                <div wire:ignore class="mb-6">
                    @livewire('operator.export-data-siswa', ['key' => 'export-data-admin-' . uniqid()])
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
                                    <td class="border px-6 py-3 text-left font-medium">
                                        {{ ucwords(@$pendaftaran->nama_lengkap ?? 'Belum Di Lengkapi') }}
                                    </td>
                                    <td class="border px-6 py-3 text-center">
                                        {{ @$pendaftaran->NISN ?? 'Belum Di Lengkapi' }}
                                    </td>
                                    <td class="border px-6 py-3 text-left">
                                        {{ @$pendaftaran->sekolah_asal === null ? 'Belum Dilengkapi' : strtoupper(@$pendaftaran->sekolah_asal) }}
                                    </td>
                                    <td class="border px-6 py-3 text-center">
                                        {{ @$pendaftaran->jenis_kelamin == 'L' ? 'Laki-laki' : (@$pendaftaran->jenis_kelamin == 'P' ? 'Perempuan' : 'Belum Di Lengkapi') }}
                                    </td>
                                    <td class="border px-6 py-3 text-center">
                                        {{ (@$pendaftaran->dataRegistrasi->rapot->total_rata_nilai ?? null) === null || @$pendaftaran->dataRegistrasi->rapot->total_rata_nilai == 0.00 ? 'Belum Di Lengkapi' : @$pendaftaran->dataRegistrasi->rapot->total_rata_nilai }}
                                    </td>
                                    <td class="border px-6 py-3 text-center">
                                        {{ @$pendaftaran->kota === null ? 'Belum Dilengkapi' : (@$pendaftaran->kota === 'KOTA BOGOR' ? 'Dalam Kota' : 'Luar Kota') }}
                                    </td>
                                    <td class="border px-6 py-3 text-center">
                                        @php
                                            $statusMapping = [
                                                7 => [
                                                    'label' => 'Tidak Diterima',
                                                    'color' => 'bg-red-100 text-red-800',
                                                ],
                                                8 => ['label' => 'Diterima', 'color' => 'bg-green-100 text-green-800'],
                                                9 => [
                                                    'label' => 'Dicadangkan',
                                                    'color' => 'bg-yellow-100 text-yellow-800',
                                                ],
                                            ];
                                            if (($pendaftaran->dataRegistrasi->status ?? 6) <= 6) {
                                                $status = [
                                                    'label' => 'Dalam Proses',
                                                    'color' => 'bg-gray-100 text-gray-800',
                                                ];
                                            } else {
                                                $status = $statusMapping[$pendaftaran->dataRegistrasi->status] ?? [
                                                    'label' => 'Unknown',
                                                    'color' => 'bg-gray-100 text-gray-800',
                                                ];
                                            }
                                        @endphp
                                        <span class="{{ $status['color'] }} text-xs font-medium px-3 py-1 rounded">
                                            {{ $status['label'] }}
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
