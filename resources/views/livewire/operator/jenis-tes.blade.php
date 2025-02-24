<div>
    {{-- Tabel Jenis Tes --}}
    <div class="flex justify-between mb-3">
        <diV></diV>
        <div class="inline-flex justify-center items-center px-4 py-2 bg-tertiary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-secondary hover:text-tertiary focus:bg-secondaryactive:bg-white active:border active:border-tertiary focus:outline-none focus:ring-2 focus:ring-tertiary focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
            <button wire:click="create" class="text-center flex justify-center items-center w-full">+ JENIS TES</button>

        </div>
    </div>
    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th class="px-4 py-2">Nama</th>
                <th class="px-4 py-2">Jalur Registrasi</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jenisTes as $item)
                <tr>
                    <td class="border px-4 py-2">{{ $item->nama }}</td>
                    <td class="border px-4 py-2">
                        @if ($item->no_jalur == "0")
                            Semua Jalur
                        @elseif ($item->no_jalur == "1")
                            Reguler
                        @elseif ($item->no_jalur == "2")
                            Afirmasi
                        @endif
                    </td>
                    <td class="border px-4 py-2 flex justify-center space-x-2">
                        <button wire:click="edit({{ $item->id}})"
                            class="bg-tertiary text-white px-4 py-2  hover:bg-secondary hover:text-tertiary rounded">Edit</button>
                        <button wire:click="delete({{ $item->id}})"
                            class="bg-red-900 text-white px-4 py-2 hover:bg-red-500  rounded">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Modal --}}
    @if($showModal)
        <div class="fixed inset-0 flex items-center justify-center z-50 bg-gray-900 bg-opacity-50"
            wire:keydown.escape="closeModal">
            <div class="bg-white rounded-lg shadow-lg w-1/3">
                <div class="flex justify-between items-center px-4 py-2 border-b">
                    <h5 class="text-lg font-semibold">{{ $isEdit ? 'Update' : 'store' }} Jenis Tes</h5>
                    <button wire:click="closeModal" class="text-gray-500">&times;</button>
                </div>
                <div class="p-4">
                    <input type="text" wire:model="nama" class="border rounded w-full py-2 px-3 mb-3" placeholder="Nama">
                    <select wire:model="no_jalur" class="border rounded w-full py-2 px-3">
                        <option class="" disabled="disabled" value="">Pilih Jalur</option> <!-- Add a default option -->
                        <option class="" value="0">Semua Jalur</option>
                        <option class="" value="1">Reguler</option>
                        <option class="" value="2">Afirmasi</option>
                    </select>
                </div>
                <div class="flex justify-end px-4 py-2 border-t">
                    <button wire:click="closeModal" class="bg-red-900 text-white px-4 py-2 hover:bg-red-500  rounded mr-2">Batal</button>
                    <button wire:click.prevent="{{ $isEdit ? 'Update' : 'store' }}"
                        class="bg-tertiary text-white px-4 py-2  hover:bg-secondary hover:text-tertiary rounded">Simpan</button>
                </div>
            </div>
        </div>
    @endif
</div>