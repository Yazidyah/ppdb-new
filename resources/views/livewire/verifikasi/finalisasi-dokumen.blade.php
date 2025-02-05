<div class="max-w-7xl mx-auto p-4">
    @forelse($persyaratan as $pr)
        <div class="mb-4">
            @forelse ($pr->berkas as $berkas)
                <div class="mb-2 p-4 bg-white shadow rounded">
                    <h1 class="p-3 font-semibold text-lg text-gray-600">{{ $pr->nama_persyaratan }}</h1>
                    @livewire('pemberkasan.berkas-verif', ['berkas' => $berkas, 'editable' => false], key('berkas-finalisasi-' . $berkas->id))
                </div>
            @empty
                <div class="mb-2 p-4 bg-white shadow rounded">
                    <p class="font-semibold text-lg text-red-600">Belum ada dokumen {{ $pr->nama_persyaratan }}</p>
                </div>
            @endforelse
        </div>
    @empty
        <p class="text-gray-500">No documents available.</p>
    @endforelse
</div>
