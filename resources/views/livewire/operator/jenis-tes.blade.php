<div>
    {{-- Tabel Jenis Tes --}}
    <div class="flex justify-end mb-3">
        <button wire:click="create" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Jenis Tes</button>
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
                            class="bg-blue-500 text-white px-4 py-2 rounded">Edit</button>
                        <button wire:click="delete({{ $item->id}})"
                            class="bg-red-500 text-white px-4 py-2 rounded">Hapus</button>
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
                    <h5 class="text-lg font-semibold">{{ $isEdit ? 'update' : 'store' }} Jenis Tes</h5>
                    <button wire:click="closeModal" class="text-gray-500">&times;</button>
                </div>
                <div class="p-4">
                    <input type="text" wire:model="nama" class="border rounded w-full py-2 px-3 mb-3" placeholder="Nama">
                    <select wire:model="no_jalur" class="border rounded w-full py-2 px-3">
                        <option disabled="disabled" value="">Pilih Jalur</option> <!-- Add a default option -->
                        <option value="0">Semua Jalur</option>
                        <option value="1">Reguler</option>
                        <option value="2">Afirmasi</option>
                    </select>
                </div>
                <div class="flex justify-end px-4 py-2 border-t">
                    <button wire:click="closeModal" class="bg-gray-300 text-black px-4 py-2 rounded mr-2">Batal</button>
                    <button wire:click.prevent="{{ $isEdit ? 'update' : 'store' }}"
                        class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
                </div>
            </div>
        </div>
    @endif
</div>