<div class="my-3 col-span-full no-print">
    <label for="berkas{{ $kategori->id }}.'-'.{{ $model->id }}"
        class="block mb-1 text-sm font-medium leading-6 text-gray-900">{{ $kategori->nama }}</label>


    <div class="grid gap-2 mb-2 ">
        @if ($uploaded != null)
            @foreach ($uploaded as $upl)
                @livewire('pemberkasan.berkas', ['berkas' => $upl, 'editable' => $editable], key($upl->id))
            @endforeach
        @else
            <div class="py-2 text-xs text-center text-gray-600 border">Belum ada berkas diunggah</div>
        @endif
    </div>
    @if ($canUpload)
        <div class="flex gap-4">

            <input type="file" name="berkas{{ $kategori->id }}" id="berkas{{ $kategori->id }}.'-'.{{ $model->id }}"
                wire:model.live="berkas"
                class="block w-full px-3 py-2 text-gray-900 transition transform border-0 rounded-md shadow-sm uploader ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 hover:scale-105">


            <button wire:loading wire:target="berkas"
                class="px-10 text-sm font-semibold text-white transition transform bg-indigo-600 rounded-md c-button hover:scale-105 opacity-60">Mengunggah...</button>
            @error('berkas')
                {{ $message }}
            @enderror
            @if ($berkas)
                <button wire:click="simpan"
                    class="px-10 text-sm font-semibold text-white transition transform bg-indigo-600 rounded-md c-button hover:scale-105">Simpan</button>
            @endif
        </div>
    @endif

</div>
