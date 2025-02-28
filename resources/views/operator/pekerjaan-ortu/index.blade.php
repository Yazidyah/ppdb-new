<x-app-layout>
<div class="p-4 sm:ml-64">
    <div class="p-4  rounded-lg dark:border-gray-700 mt-14">
            <div class="container mx-auto w-1/2 text-center pt-7">
                <h2 class="font-bold text-[24px] pb-4">Daftar Pekerjaan Orang Tua</h2>
                <div class="flex justify-between">
                    <div></div>
                    <div class="w-1/4 inline-flex justify-center items-center px-4 py-3 bg-tertiary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-secondary hover:text-tertiary focus:bg-gray-700 dark:focus:bg-white active:bg-white active:border active:border-tertiary focus:outline-none focus:ring-2 focus:ring-tertiary focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            <button wire:click="openModal(false)">
                        <button onclick="showCreateModal()" class="text-center flex justify-center items-center w-full">+ PEKERJAAN</button>
                    </div>
                </div>
                <table class="table-auto overflow-x-auto mx-auto items-center relative shadow-md sm:rounded-lg my-6 w-full max-w-full rtl:justify-left text-sm text-left text-gray-500">
                    <thead class="w-full max-w-full rtl:justify-left text-lg text-left text-gray-500 my-3">
                        <tr class="text-sm text-tertiary uppercase bg-gray-50">
                            <th class="px-4 text-center py-2">Nama Pekerjaan</th>
                            <th class="px-4 text-center py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pekerjaanOrtu as $item)
                            <tr class="hover:bg-gray-200 transition duration-200 cursor-pointer text-center">
                                <td class="border text-tertiary px-4 py-2">{{ $item->nama_pekerjaan }}</td>
                                <td class="border text-tertiary px-4 py-2 flex justify-center space-x-2">
                                    <button onclick="showEditModal({{ $item->id_pekerjaan }}, '{{ $item->nama_pekerjaan }}')" class="bg-tertiary text-white px-4 py-2  hover:bg-secondary hover:text-tertiary rounded">Edit</button>
                                    <form action="{{ route('pekerjaan-ortu.destroy', $item->id_pekerjaan) }}" method="post" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-900 text-white px-4 py-2 hover:bg-red-500  rounded">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div id="createModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white p-6 rounded shadow-lg">
                <h2 class="font-bold text-[24px] pb-4">Tambah Pekerjaan Orang Tua</h2>
                <form action="{{ route('pekerjaan-ortu.store') }}" method="post">
                    @csrf
                    <div class="mb-4">
                        <label for="create_nama_pekerjaan" class="block text-gray-700 text-sm font-bold mb-2">Nama Pekerjaan:</label>
                        <input type="text" name="nama_pekerjaan" id="create_nama_pekerjaan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        @error('nama_pekerjaan')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="bg-tertiary text-white px-4 py-2  hover:bg-secondary hover:text-tertiary rounded">Tambah</button>
                    <button type="button" onclick="hideCreateModal()" class="bg-red-900 text-white px-4 py-2 hover:bg-red-500  rounded">Cancel</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white p-6 rounded shadow-lg">
                <h2 class="font-bold text-[24px] pb-4">Edit Pekerjaan Orang Tua</h2>
                <form id="editForm" action="" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="edit_nama_pekerjaan" class="block text-gray-700 text-sm font-bold mb-2">Nama Pekerjaan:</label>
                        <input type="text" name="nama_pekerjaan" id="edit_nama_pekerjaan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        @error('nama_pekerjaan')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="bg-tertiary text-white px-4 py-2  hover:bg-secondary hover:text-tertiary rounded">Update</button>
                    <button type="button" onclick="hideEditModal()" class="bg-red-900 text-white px-4 py-2 hover:bg-red-500  rounded">Cancel</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showCreateModal() {
            document.getElementById('createModal').classList.remove('hidden');
        }

        function hideCreateModal() {
            document.getElementById('createModal').classList.add('hidden');
        }

        function showEditModal(id, nama_pekerjaan) {
            document.getElementById('editForm').action = `/pekerjaan-ortu/${id}`;
            document.getElementById('edit_nama_pekerjaan').value = nama_pekerjaan;
            document.getElementById('editModal').classList.remove('hidden');
        }

        function hideEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
