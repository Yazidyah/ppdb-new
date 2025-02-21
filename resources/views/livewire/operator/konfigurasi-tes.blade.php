<div>
    <button wire:click="create" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Jadwal Tes</button>
    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th class="px-4 py-2">Nama Tes</th>
                <th class="px-4 py-2">Jadwal Tes</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($testSchedules as $item)
                <tr>
                    <td class="border px-4 py-2">{{ $item->nama_tes }}</td>
                    <td class="border px-4 py-2">{{ $item->jadwal_tes }}</td>
                    <td class="border px-4 py-2 flex justify-center space-x-2">
                        <button wire:click="edit({{ $item->id }})" class="bg-blue-500 text-white px-4 py-2 rounded">Edit</button>
                        <button wire:click="delete({{ $item->id }})" class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($editId)
        <div>
            <h2 class="font-bold text-[24px] pb-4">Edit Jadwal Tes</h2>
            <input type="text" wire:model="nama_tes" placeholder="Nama Tes" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <input type="date" wire:model="jadwal_tes" placeholder="Jadwal Tes" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <button wire:click="update" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
        </div>
    @else
        <div>
            <h2 class="font-bold text-[24px] pb-4">Tambah Jadwal Tes</h2>
            <input type="text" wire:model="nama_tes" placeholder="Nama Tes" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <input type="date" wire:model="jadwal_tes" placeholder="Jadwal Tes" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <button wire:click="create" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah</button>
        </div>
    @endif
</div>
