<div>
    {{-- Tabel Jenis Tes --}}
    <div class="border-2 border-gray-300 rounded p-4">
        <div class="flex justify-between mb-3">
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
            <div
                class="inline-flex justify-center items-center px-4 py-2 bg-tertiary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-secondary hover:text-tertiary focus:bg-secondaryactive:bg-white active:border active:border-tertiary focus:outline-none focus:ring-2 focus:ring-tertiary focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                <button wire:click="create" class="text-center flex justify-center items-center w-full">+ JENIS
                    TES</button>
            </div>
        </div>
        <div class="w-full overflow-x-auto mx-auto flex items-center relative shadow-md sm:rounded-lg my-6 transition-all duration-500"
            style="max-height: {{ $isTableVisible ? '1000px' : '0' }};">
            <table
                class="w-full max-w-full rtl:justify-left text-sm text-left text-gray-500 my-3">
                <thead class="text-sm text-tertiary uppercase bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-center">Nama</th>
                        <th class="px-4 py-2 text-center">Jalur Registrasi</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jenisTes as $item)
                        <tr class="hover:bg-gray-200 transition duration-200 cursor-pointer items-center">
                            <td class="border text-tertiary text-center px-4 py-2">{{ $item->nama }}</td>
                            <td class="border text-tertiary text-center px-4 py-2 my-auto">
                                @if ($item->no_jalur == "0")
                                    Semua Jalur
                                @elseif ($item->no_jalur == "1")
                                    Reguler
                                @elseif ($item->no_jalur == "2")
                                    Afirmasi/Prestasi
                                @endif
                            </td>
                            <td class="border px-4 py-2 flex justify-center mx-auto   space-x-2 items-center">
                                <button wire:click="edit({{ $item->id}})"
                                    class="bg-tertiary text-white px-4 py-2 flex justify-center items-center  hover:bg-secondary hover:text-tertiary rounded">Edit</button>
                                <button wire:click="delete({{ $item->id}})"
                                    class="bg-red-900 text-white px-4 py-2 flex justify-center items-center  hover:bg-red-500  rounded">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal --}}
    @if($showModal)
        <div class="fixed inset-0 flex items-center justify-center z-50 bg-gray-900 bg-opacity-50"
            wire:keydown.escape="closeModal">
            <div class="bg-white rounded-lg shadow-lg md:w-1/3">
                <div class="flex justify-between items-center px-4 py-2 border-b">
                    <h5 class="text-lg font-semibold">{{ $isEdit ? 'Update' : 'store' }} Jenis Tes</h5>
                    <button wire:click="closeModal" class="text-gray-500">&times;</button>
                </div>
                <div class="p-4">
                    <input type="text" wire:model="nama" class="border rounded w-full py-2 px-3 mb-3" placeholder="Nama">
                    <select wire:model="no_jalur" class="border border-tertiary rounded w-full py-2 px-3">
                        <option class="" disabled="disabled" value="">Pilih Jalur</option>
                        <option class="" value="0">Semua Jalur</option>
                        <option class="" value="1">Reguler</option>
                        <option class="" value="2">Afirmasi</option>
                    </select>
                </div>
                <div class="flex justify-between px-4 py-2 border-t">
                <div>
                        <button wire:click="closeModal" class="bg-red-900 text-white px-4 py-2 hover:bg-red-500  rounded mr-2">Batal</button>
                    </div>
                    <div>
                        <button wire:click.prevent="{{ $isEdit ? 'update' : 'store' }}" class="bg-tertiary text-white px-4 py-2  hover:bg-secondary hover:text-tertiary rounded">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>