<div class="max-w-7xl mx-auto p-4">
    {{-- @dd($persyaratan) --}}
    @forelse($persyaratan as $pr)
        <div class="mb-4">
            @foreach ($pr->berkas as $berkas)
                <div class="mb-2 p-4 bg-white shadow rounded">
                    @livewire('pemberkasan.berkas', ['berkas' => $berkas, 'editable' => false], key('berkas-finalisasi-' . $berkas->id))
                </div>
            @endforeach
        </div>
    @empty
        <p class="text-gray-500">No documents available.</p>
    @endforelse
</div>
