<div>
    <button wire:click="$set('showModalJenis', true)" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Jenis
        Tes</button>
    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th class="px-4 py-2">Nama Jenis Tes</th>
                <th class="px-4 py-2">Jalur</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jenisTes as $item)
                <tr>
                    <td class="border px-4 py-2">{{ $item->nama }}</td>
                    <td class="border px-4 py-2">{{ $item->jalurRegistrasi->nama_jalur }}</td>
                    <td class="border px-4 py-2 flex justify-center space-x-2">
                        <button wire:click="editJenis({{ $item->id_jenis_tes }})"
                            class="bg-blue-500 text-white px-4 py-2 rounded">Edit</button>
                        <button wire:click="hapus({{ $item->id_jenis_tes }})"
                            class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <button wire:click="$set('showModalJadwal', true)" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Jadwal
        Tes</button>
    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th class="px-4 py-2">Jenis Tes</th>
                <th class="px-4 py-2">Ruang</th>
                <th class="px-4 py-2">Tanggal</th>
                <th class="px-4 py-2">Jam Mulai</th>
                <th class="px-4 py-2">Jam Selesai</th>
                <th class="px-4 py-2">Kuota</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jadwalTes as $item)
                <tr>
                    <td class="border px-4 py-2">{{ $item->jenisTes->nama }}</td>
                    <td class="border px-4 py-2">{{ $item->ruang }}</td>
                    <td class="border px-4 py-2">{{ $item->tanggal }}</td>
                    <td class="border px-4 py-2">{{ $item->jam_mulai }}</td>
                    <td class="border px-4 py-2">{{ $item->jam_selesai }}</td>
                    <td class="border px-4 py-2">{{ $item->kuota }}</td>
                    <td class="border px-4 py-2 flex justify-center space-x-2">
                        <button wire:click="editJadwal({{ $item->id_tes }})"
                            class="bg-blue-500 text-white px-4 py-2 rounded">Edit</button>
                        <button wire:click="hapus({{ $item->id_tes }})"
                            class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($showModalJenis)
        <div class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    {{ $editId ? 'Edit Jenis Tes' : 'Tambah Jenis Tes' }}
                                </h3>
                                <div class="mt-2">
                                    <input type="text" wire:model="nama_tes" placeholder="Nama Tes"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <select wire:model="id_jalur"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mt-2">
                                        <option value="">Pilih Jalur Registrasi</option>
                                        @foreach($jalurOptions as $jalurRegistrasi)
                                            <option value="{{ $jalurRegistrasi->id_jalur }}">{{ $jalurRegistrasi->nama_jalur }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        @if($editId)
                            <button wire:click="simpanJenis"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">Update</button>
                        @else
                            <button wire:click="tambahJenis"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">Tambah</button>
                        @endif
                        <button wire:click="$set('showModalJenis', false)"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($showModalJadwal)
        <div class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    {{ $editId ? 'Edit Jadwal Tes' : 'Tambah Jadwal Tes' }}
                                </h3>
                                <div class="mt-2">
                                    <select wire:model="id_jenis_tes"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mt-2">
                                        <option value="">Pilih Jenis Tes</option>
                                        @foreach($jenisTes as $jenis)
                                            <option value="{{ $jenis->id_jenis_tes }}">{{ $jenis->nama }}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" wire:model="ruang" placeholder="Ruang"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mt-2">
                                    <input type="date" wire:model="tanggal"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mt-2">
                                    <input type="time" wire:model="jam_mulai" step="60"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mt-2">
                                    <input type="time" wire:model="jam_selesai" step="60"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mt-2">
                                    <input type="number" wire:model="kuota" placeholder="Kuota"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mt-2">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        @if($editId)
                            <button wire:click="simpanJadwal"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">Update</button>
                        @else
                            <button wire:click="tambahJadwal"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">Tambah</button>
                        @endif
                        <button wire:click="$set('showModalJadwal', false)"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>