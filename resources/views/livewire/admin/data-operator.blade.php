<div>
<div class="p-4 sm:ml-64 ">
<div class="p-4 border-2 border-gray-700 border-dashed rounded-lg  mt-14">
    {{-- Modal --}}
    @if($isOpen)
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen bg-black bg-opacity-50">
                <div class="bg-white p-6 rounded shadow-lg w-1/3">
                    <h2 class="text-lg font-bold">{{ $operator_id ? 'Edit' : 'Tambah' }} Operator</h2>
                    <form wire:submit.prevent="{{ $operator_id ? 'update' : 'store' }}">
                        <div class="mt-4">
                            <label for="name" class="block text-sm font-medium">Nama</label>
                            <input type="text" wire:model="name" id="name" class="w-full border-gray-300 rounded shadow-sm">
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="mt-4">
                            <label for="email" class="block text-sm font-medium">Email</label>
                            <input type="email" wire:model="email" id="email"
                                class="w-full border-gray-300 rounded shadow-sm">
                            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        @if(!$operator_id)
                            <div class="mt-4">
                                <label for="password" class="block text-sm font-medium">Password</label>
                                <input type="password" wire:model="password" id="password"
                                    class="w-full border-gray-300 rounded shadow-sm">
                                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        @endif
                        @if($operator_id)
                            <div class="mt-4">
                                <label for="new_password" class="block text-sm font-medium">New Password</label>
                                <input type="password" wire:model="new_password" id="new_password"
                                    class="w-full border-gray-300 rounded shadow-sm">
                                @error('new_password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        @endif
                        <div class="mt-6 flex justify-end space-x-2">
                            <button type="button" wire:click="closeModal"
                                class="bg-red-900 text-white px-4 py-2 hover:bg-red-500  rounded">Batal</button>
                            <button type="submit" class="bg-tertiary text-white px-4 py-2 hover:bg-secondary hover:text-tertiary rounded">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    {{-- Table --}}
   
            <div class="container mx-auto text-center pt-7 ">
                <div class="flex justify-between mb-4">
            <h1 class="text-lg font-bold">Kelola Akun Operator</h1>
            <button wire:click="create" class="bg-tertiary text-white px-4 py-2 hover:bg-secondary hover:text-tertiary rounded">Tambah Operator</button>
        </div>
        <div class="container mx-auto overflow-x-auto min-w-screen">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-center bg-gray-200">
                    <tr>
                        <th scope="col" class="px-6 py-3 whitespace-nowrap">No</th>
                        <th scope="col" class="px-6 py-3 whitespace-nowrap">Name</th>
                        <th scope="col" class="px-6 py-3 whitespace-nowrap">Email</th>
                        <th scope="col" class="px-6 py-3 whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($operators as $index => $operator)
                        <tr class="border-b">
                            <td class="px-6 py-3">{{ $operator->id }}</td>
                            <td class="px-6 py-3">{{ $operator->name }}</td>
                            <td class="px-6 py-3">{{ $operator->email }}</td>
                            <td class="px-6 py-3 space-x-2">
                                <button wire:click="edit({{ $operator->id }})"
                                    class="bg-tertiary text-white px-4 py-2 hover:bg-secondary hover:text-tertiary rounded">Edit</button>
                                <button wire:click="delete({{ $operator->id }})"
                                    class="bg-red-900 text-white px-4 py-2 hover:bg-red-500  rounded">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $operators->links() }}
        </div>
    </div>
    </div>
    </div>
    
</div>