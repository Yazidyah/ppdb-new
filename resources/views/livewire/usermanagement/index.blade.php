<div>
    <div class="py-3 px-2 sm:py-6 sm:px-8 space-y-4 max-w-7xl mx-auto">
        <div class="flex justify-end gap-4 items-center p-4">
            <div class="w-full sm:w-64 flex relative items-center">
                <input type="text" wire:model.live="search" autocomplete="off"
                    class="block w-full rounded-full text-sm focus:ring-4 focus:ring-indigo-100 border-gray-300 py-1.5 shadow-sm focus:border-indigo-300 peer"
                    placeholder="search role.." autofocus>
                <div class="absolute right-3 w-6">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        class="size-5 text-gray-300 peer:focus:text-indigo-600">
                        <path fill-rule="evenodd"
                            d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>



        <div class="container mx-auto bg-white rounded-lg shadow mt-3">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr class="uppercase text-xs font-semibold text-gray-600">
                            <th class="py-4 px-6 text-left">ID</th>
                            <th class="py-4 px-6 text-left">Nama</th>
                            <th class="py-4 px-6 text-left">Email</th>
                            <th class="py-4 px-6 text-left">Peran</th>
                            <th class="py-4 px-6 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm">
                        @foreach ($users as $user)
                            <tr class="border-b border-gray-200 hover:bg-gray-100 transition duration-300">
                                <td class="py-4 px-6">{{ $user->id }}</td>
                                <td class="py-4 px-6">{{ $user->name }}</td>
                                <td class="py-4 px-6">{{ $user->email }}</td>
                                <td class="py-4 px-6">
                                    {{ $user->role }}
                                </td>
                                <td class=" py-4 pl-3 pr-4 text-sm font-medium sm:pr-6">
                                    @livewire(
                                        'usermanagement.user-detail',
                                        [
                                            'user' => $user,
                                        ],
                                        key(rand() . $user->id)
                                    )
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-3">
            {{ $users->links() }}
        </div>
    </div>
</div>
