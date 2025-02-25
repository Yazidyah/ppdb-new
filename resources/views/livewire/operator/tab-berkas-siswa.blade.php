<div>
    <div class="p-8 bg-white rounded-lg ">
        <div class="text-left">
            <div>
                <h5 class="font-medium">Berkas</h5>
                <p class="text-sm text-gray-400">Data yang diisikan pada saat pendaftaran.</p>
            </div>
        </div>
        <hr class="w-full mt-3 mb-5">
        @forelse ($persyaratan as $data)
            <h1 class="p-2">{{ $data->nama_persyaratan }}</h1>
            @if (count($data->berkas) !== 0)
                @forelse ($data->berkas->where('uploader_id', $user->id) as $berkas)
                    <div class="mt-2 mb-2">
                        @livewire('pemberkasan.berkas', ['berkas' => $berkas, 'editable' => true], key($user->id . 'berkas' . $berkas->id))
                    </div>
                @empty
                @endforelse
                <div class="mt-2">
                    <input type="file" name="berkas" id="berkas" wire:model.live="berkas"
                        wire:change="setSyarat({{ $data->id_persyaratan }})"
                        class="block w-full px-3 py-2 text-gray-900 transition transform border-0 rounded-md shadow-sm uploader ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 hover:scale-105">
                </div>
            @endif
        @empty
            <p class="text-sm text-gray-500">Tidak ada berkas persyaratan yang tersedia.</p>
        @endforelse

    </div>
</div>
