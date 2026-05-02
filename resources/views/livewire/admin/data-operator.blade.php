<div>
<div class="p-6 lg:p-8 space-y-6">

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-tertiary">Kelola Operator</h1>
            <p class="text-sm text-gray-500 mt-0.5">Manajemen akun operator PPDB MAN 1 Kota Bogor</p>
        </div>
        <button wire:click="create"
            class="inline-flex items-center gap-2 bg-tertiary text-white text-sm font-semibold px-4 py-2.5 rounded-xl hover:bg-primary transition-colors duration-200 shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Operator
        </button>
    </div>

    {{-- Flash Message --}}
    @if (session()->has('message'))
        <div class="flex items-center gap-3 bg-secondary border border-primary/20 text-tertiary text-sm font-medium px-4 py-3 rounded-xl">
            <svg class="w-5 h-5 flex-shrink-0 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('message') }}
        </div>
    @endif

    {{-- Table Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="bg-tertiary text-white">
                        <th class="px-5 py-3.5 text-center font-semibold text-xs uppercase tracking-wide w-16">No</th>
                        <th class="px-5 py-3.5 font-semibold text-xs uppercase tracking-wide">Nama</th>
                        <th class="px-5 py-3.5 font-semibold text-xs uppercase tracking-wide">Email</th>
                        <th class="px-5 py-3.5 text-center font-semibold text-xs uppercase tracking-wide w-40">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($operators as $operator)
                        <tr class="hover:bg-secondary/20 transition-colors duration-150 group">
                            <td class="px-5 py-3.5 text-center text-gray-400 text-xs font-mono">
                                {{ $operators->firstItem() + $loop->index }}
                            </td>
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-secondary flex items-center justify-center flex-shrink-0">
                                        <span class="text-tertiary font-bold text-xs">{{ strtoupper(substr($operator->name, 0, 1)) }}</span>
                                    </div>
                                    <span class="font-semibold text-gray-800 group-hover:text-tertiary transition-colors">
                                        {{ $operator->name }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-5 py-3.5 text-gray-500">
                                {{ $operator->email }}
                            </td>
                            <td class="px-5 py-3.5 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button wire:click="edit({{ $operator->id }})"
                                        class="inline-flex items-center gap-1.5 text-xs font-semibold text-tertiary bg-secondary hover:bg-primary hover:text-white px-3 py-1.5 rounded-lg transition-colors duration-200">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit
                                    </button>
                                    <button wire:click="delete({{ $operator->id }})"
                                        wire:confirm="Yakin ingin menghapus operator ini?"
                                        class="inline-flex items-center gap-1.5 text-xs font-semibold text-red-600 bg-red-50 hover:bg-red-600 hover:text-white px-3 py-1.5 rounded-lg transition-colors duration-200">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-5 py-16 text-center">
                                <div class="flex flex-col items-center gap-3 text-gray-400">
                                    <svg class="w-12 h-12 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <p class="text-sm font-medium">Belum ada data operator</p>
                                    <button wire:click="create" class="text-xs text-tertiary font-semibold hover:underline">+ Tambah operator pertama</button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($operators->hasPages())
        <div class="px-5 py-4 border-t border-gray-100 flex items-center justify-between gap-4">
            <p class="text-xs text-gray-400">
                Menampilkan <span class="font-semibold text-gray-600">{{ $operators->firstItem() }}–{{ $operators->lastItem() }}</span>
                dari <span class="font-semibold text-gray-600">{{ $operators->total() }}</span> operator
            </p>
            <div class="text-sm">
                {{ $operators->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

{{-- ===== MODAL ===== --}}
@if($isOpen)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-modal="true" role="dialog">
        {{-- Backdrop --}}
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" wire:click="closeModal"></div>

        {{-- Dialog --}}
        <div class="relative flex items-center justify-center min-h-screen p-4">
            <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md z-10">

                {{-- Modal Header --}}
                <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="bg-secondary rounded-lg p-2">
                            <svg class="w-5 h-5 text-tertiary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="{{ $operator_id ? 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z' : 'M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z' }}"/>
                            </svg>
                        </div>
                        <h2 class="text-base font-bold text-tertiary">
                            {{ $operator_id ? 'Edit Operator' : 'Tambah Operator Baru' }}
                        </h2>
                    </div>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                {{-- Modal Body --}}
                <form wire:submit.prevent="{{ $operator_id ? 'update' : 'store' }}" class="px-6 py-5 space-y-4">

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap</label>
                        <input type="text" wire:model="name" id="name" placeholder="Masukkan nama operator"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition">
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Alamat Email</label>
                        <input type="email" wire:model="email" id="email" placeholder="operator@example.com"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition">
                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    @if(!$operator_id)
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                            <input type="password" wire:model="password" id="password" placeholder="Minimal 6 karakter"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition">
                            @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    @endif

                    @if($operator_id)
                        <div>
                            <label for="new_password" class="block text-sm font-medium text-gray-700 mb-1.5">
                                Password Baru
                                <span class="text-gray-400 font-normal">(kosongkan jika tidak diubah)</span>
                            </label>
                            <input type="password" wire:model="new_password" id="new_password" placeholder="Minimal 6 karakter"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition">
                            @error('new_password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    @endif

                    {{-- Footer Buttons --}}
                    <div class="flex justify-end gap-3 pt-2">
                        <button type="button" wire:click="closeModal"
                            class="px-4 py-2.5 text-sm font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-5 py-2.5 text-sm font-semibold text-white bg-tertiary hover:bg-primary rounded-xl transition-colors shadow-sm">
                            {{ $operator_id ? 'Simpan Perubahan' : 'Tambah Operator' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
</div>{{-- end Livewire root --}}