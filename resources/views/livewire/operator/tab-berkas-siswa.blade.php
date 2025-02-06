<div>
    <div class="p-8 bg-white rounded-lg ">
        <div class="text-left">
            <div>
                <h5 class="font-medium">Berkas</h5>
                <p class="text-sm text-gray-400">Data yang diisikan pada saat pendaftaran.</p>
            </div>
        </div>
        <hr class="w-full mt-3 mb-5">

        @php
            $persyaratan = $siswa->dataRegistrasi->syarat;
        @endphp

        @forelse ($persyaratan as $syarat)
            @php
                $berkas = $syarat->berkas->where('deleted_at', null)->first();
            @endphp

            @if ($berkas != null)
                <div class="mb-4">
                    <h1 class="text-left text-sm mb-2 ml-3 font-semibold ">
                        {{ $syarat->nama_persyaratan }}</h1>
                    @livewire('pemberkasan.berkas', ['berkas' => $berkas, 'editable' => false], key($syarat->id_persyaratan . 'berkas-operator-' . $syarat->id))
                </div>
            @endif
        @empty
            <p class="text-sm text-gray-500">Tidak ada persyaratan yang tersedia.</p>
        @endforelse
    </div>
</div>
