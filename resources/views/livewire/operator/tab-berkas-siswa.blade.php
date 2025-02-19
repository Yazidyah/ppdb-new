<div>
    <div class="p-8 bg-white rounded-lg ">
        <div class="text-left">
            <div>
                <h5 class="font-medium">Berkas</h5>
                <p class="text-sm text-gray-400">Data yang diisikan pada saat pendaftaran.</p>
            </div>
        </div>
        <hr class="w-full mt-3 mb-5">

        @forelse ($persyaratan as $syarat)
            @foreach ($kbs as $kb)
                @if ($syarat->nama_persyaratan == $kb->nama)
                    @livewire('pemberkasan.uploader', ['kategori' => $kb, 'model' => $syarat, 'view' => 'view', 'verifikasi' => true], key($kb->id . '-berkas-view-' . $syarat->id_persyaratan))
                @endif
            @endforeach
        @empty
            <p class="text-sm text-gray-500">Tidak ada persyaratan yang tersedia.</p>
        @endforelse


    </div>
</div>
