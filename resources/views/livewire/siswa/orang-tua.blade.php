<div>
    {{-- Stop trying to control. --}}
    <div class="steps max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex w-3/4 items-center justify-center border-2 border-dasar2 rounded-lg py-2 gap-2 mx-auto">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-7 h-7">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
            </svg>
            <h1 class=" block text-xs lg:text-base items-center text-center justify-center font-semibold">Peringatan :
                Isi Data yang Sebenar-benarnya.</h1>
        </div>
        @foreach ($orangTua as $index => $ortu)
            @if ($ortu->id_hubungan == 1)
                <h2 class="font-semibold py-2">Isi Informasi Ibu Kandung</h2>
                @livewire('orang-tua-form', ['orangTua' => $ortu], key('form-orang-tua-' . $ortu->id_orang_tua))
            @elseif ($ortu->id_hubungan == 2)
                <h2 class="font-semibold py-2">Isi Informasi Ayah Kandung</h2>
                @livewire('orang-tua-form', ['orangTua' => $ortu], key('form-orang-tua-' . $ortu->id_orang_tua))
            @elseif ($ortu->id_hubungan == 3)
                <h2 class="font-semibold py-2">Isi Informasi Wali</h2>
                @livewire('orang-tua-form', ['orangTua' => $ortu], key('form-orang-tua-' . $ortu->id_orang_tua))
                <button wire:click="batalTambahOrtu"
                    class="mt-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    Hapus data wali
                </button>
            @endif
        @endforeach
        @if (count($orangTua) < 3)
            <button wire:click="tambahOrtu"
                class="mt-4 bg-tertiary hover:bg-secondary hover:text-tertiary text-white font-bold py-2 px-4 rounded">
                Tambah Data Wali
            </button>
        @endif
    </div>
</div>
