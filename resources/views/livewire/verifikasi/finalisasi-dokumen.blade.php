<div class="max-w-7xl mx-auto p-4">
    {{-- @dd($persyaratan) --}}
    @forelse($persyaratan as $pr)
        <div class="mb-4">
            @forelse ($pr->berkas as $berkas)
                <div class="mb-2 p-4 bg-white shadow rounded">
                    @livewire('pemberkasan.berkas-verif', ['berkas' => $berkas, 'editable' => false], key('berkas-finalisasi-' . $berkas->id))
                </div>
            @empty
                <div class="p-4 bg-yellow-100 text-yellow-700 rounded">
                    <p>Belum ada dokumen {{ $pr->nama_persyaratan }}</p>
                </div>
            @endforelse
        </div>
    @empty
        <p class="text-gray-500">No documents available.</p>
    @endforelse
</div>
