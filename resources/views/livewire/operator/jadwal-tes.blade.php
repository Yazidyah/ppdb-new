<div class="border-2 border-gray-300 rounded p-4 mt-2">
    {{-- Stop trying to control. --}}
    <div class="flex justify-between my-3 ">
    <div>
                <button wire:click="toggleTable"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700 transition duration-300">
                    @if($isTableVisible)
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-4">
                            <path fill-rule="evenodd"
                                d="M9.47 6.47a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 1 1-1.06 1.06L10 8.06l-3.72 3.72a.75.75 0 0 1-1.06-1.06l4.25-4.25Z"
                                clip-rule="evenodd" />
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-4">
                            <path fill-rule="evenodd"
                                d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                                clip-rule="evenodd" />
                        </svg>
                    @endif
                </button>
            </div>   
    <div class="inline-flex justify-center items-center px-4 py-2 bg-tertiary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-secondary hover:text-tertiary focus:bg-secondaryactive:bg-white active:border active:border-tertiary focus:outline-none focus:ring-2 focus:ring-tertiary focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
            <button wire:click="create" class="text-center flex justify-center items-center w-full">+ JADWAL TES</button>
        </div>
    </div>
    <div class="w-full overflow-x-auto mx-auto flex items-center relative shadow-md sm:rounded-lg my-6 transition-all duration-500"  style="max-height: {{ $isTableVisible ? '1000px' : '0' }};">
    <table class="table-auto overflow-x-auto mx-auto items-center relative shadow-md sm:rounded-lg my-6 w-full max-w-full rtl:justify-left text-sm text-left text-gray-500">
        <thead class="w-full max-w-full rtl:justify-left text-lg text-left text-gray-500 my-3">
            <tr class="text-sm text-tertiary uppercase bg-gray-50">
                <th class="px-4 py-2 text-center">Nama Jenis Tes</th>
                <th class="px-4 py-2 text-center">Ruang</th>
                <th class="px-4 py-2 text-center">Tanggal</th>
                <th class="px-4 py-2 text-center">Jam Mulai</th>
                <th class="px-4 py-2 text-center">Jam Selesai</th>
                <th class="px-4 py-2 text-center">Kuota</th>
                <th class="px-4 py-2 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody >
            @foreach ($jadwalTes as $item)
                <tr class="hover:bg-gray-200 transition duration-200 cursor-pointer">
                    <td class="border px-4 py-2 text-tertiary text-center">{{ $item->jenisTes->nama }}</td>
                    <td class="border px-4 py-2 text-tertiary text-center">{{ $item->ruang }}</td>
                    <td class="border px-4 py-2 text-tertiary text-center">{{ $item->tanggal }}</td>
                    <td class="border px-4 py-2 text-tertiary text-center">{{ $item->jam_mulai }}</td>
                    <td class="border px-4 py-2 text-tertiary text-center">{{ $item->jam_selesai }}</td>
                    <td class="border px-4 py-2 text-tertiary text-center">{{ $item->terisi }}/{{ $item->kuota }}</td>
                    <td class="border px-4 py-2 flex justify-center space-x-2">
                        <button wire:click="edit({{ $item->id }})"
                            class="bg-tertiary text-white px-4 py-2  hover:bg-secondary hover:text-tertiary rounded">Edit</button>
                        <button wire:click="delete({{ $item->id }})"
                            class="bg-red-900 text-white px-4 py-2 hover:bg-red-500  rounded">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    @if($showModal)
        <div class="fixed inset-0 flex items-center justify-center z-50 bg-gray-900 bg-opacity-50"
            wire:keydown.escape="closeModal">
            <div class="bg-white rounded-lg shadow-lg w-1/3">
                <div class="flex justify-between items-center px-4 py-2 border-b">
                    <h5 class="text-lg font-semibold">{{ $isEdit ? 'Update' : 'Tambah' }} Jadwal Tes</h5>
                    <button wire:click="closeModal" class="text-gray-500">&times;</button>
                </div>
                <div class="p-4">
                    <select wire:model="id_jenis_tes" class="border rounded w-full py-2 px-3 mb-3">
                        <option>Pilih Jenis Tes</option>
                        @foreach($jenisTes as $jenis)
                            <option value="{{ $jenis->id }}">{{ $jenis->nama }}</option>
                        @endforeach
                    </select>
                    <input type="text" wire:model="ruang" class="border rounded w-full py-2 px-3 mb-3" placeholder="Ruang">
                    <input type="date" wire:model="tanggal" class="border rounded w-full py-2 px-3 mb-3"
                        placeholder="Tanggal">
                    <input type="time" wire:model.lazy="jam_mulai" class="border rounded w-full py-2 px-3 mb-3" step="60"
                        placeholder="Jam Mulai">
                    <input type="time" wire:model.lazy="jam_selesai" class="border rounded w-full py-2 px-3 mb-3" step="60"
                        placeholder="Jam Selesai">
                    <input type="number" wire:model="kuota" class="border rounded w-full py-2 px-3 mb-3"
                        placeholder="Kuota">
                </div>
                <div class="flex justify-end px-4 py-2 border-t">
                    <button wire:click="closeModal" class="bg-red-900 text-white px-4 py-2 hover:bg-red-500  rounded mr-2">Batal</button>
                    <button wire:click.prevent="{{ $isEdit ? 'update' : 'store' }}"
                        class="bg-tertiary text-white px-4 py-2  hover:bg-secondary hover:text-tertiary rounded">Simpan</button>
                </div>
            </div>
        </div>
    @endif
</div>