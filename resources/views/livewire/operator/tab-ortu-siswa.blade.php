<div>
    <div class="p-8 bg-white rounded-lg shadow">
        <div class="mb-4">
            <h5 class="text-xl font-bold">Data Orang Tua</h5>
            <p class="text-sm text-gray-400">Data yang diisikan pada saat pendaftaran.</p>
        </div>

        {{-- Tampilkan pesan sukses apabila update berhasil --}}
        @if (session()->has('message'))
            <p class="text-green-500 mt-2">{{ session('message') }}</p>
        @endif

        {{-- Looping setiap data orang tua untuk ditampilkan --}}
        @foreach ($dataOrtu as $id_orang_tua => $ortu)
            <form wire:submit.prevent="updateOrangTua({{ $id_orang_tua }})"
                class="mb-6 bg-green-50 rounded-lg shadow-md p-6">
                <h6 class="text-lg font-semibold mb-4">
                    {{-- Menampilkan label berdasarkan id_hubungan --}}
                    @if ($ortu['id_hubungan'] == 1)
                        Ibu
                    @elseif ($ortu['id_hubungan'] == 2)
                        Ayah
                    @elseif ($ortu['id_hubungan'] == 3)
                        Wali
                    @endif
                </h6>

                {{-- Pilihan Hubungan --}}
                <div class="mb-4">
                    <label for="id_hubungan_{{ $id_orang_tua }}" class="block text-sm font-medium mb-1">Hubungan</label>
                    <input type="text" id="id_hubungan_{{ $id_orang_tua }}" 
                           value="@if ($ortu['id_hubungan'] == 1) Ibu @elseif ($ortu['id_hubungan'] == 2) Ayah @elseif ($ortu['id_hubungan'] == 3) Wali @endif" 
                           class="border p-2 w-full rounded-lg bg-gray-100 text-gray-500 shadow-sm" disabled>
                </div>

                {{-- Input Data Lengkap --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
                    <div>
                        <label for="nama_lengkap_{{ $id_orang_tua }}" class="block text-xs font-medium mb-1">Nama
                            Lengkap</label>
                        <input id="nama_lengkap_{{ $id_orang_tua }}" type="text"
                            wire:model="dataOrtu.{{ $id_orang_tua }}.nama_lengkap" class="border p-2 w-full rounded-lg focus:border-tertiary  focus:ring-tertiary shadow-sm">
                        @error("dataOrtu.{$id_orang_tua}.nama_lengkap")
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="nik_{{ $id_orang_tua }}" class="block text-xs font-medium mb-1">NIK</label>
                        <input id="nik_{{ $id_orang_tua }}" type="text" wire:model="dataOrtu.{{ $id_orang_tua }}.nik"
                            class="border p-2 w-full rounded-lg focus:border-tertiary  focus:ring-tertiary shadow-sm">
                        @error("dataOrtu.{$id_orang_tua}.nik")
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="no_telp_{{ $id_orang_tua }}" class="block text-xs font-medium mb-1">No Telpon</label>
                        <input id="no_telp_{{ $id_orang_tua }}" type="text"
                            wire:model="dataOrtu.{{ $id_orang_tua }}.no_telp" class="border p-2 w-full rounded-lg focus:border-tertiary  focus:ring-tertiary shadow-sm">
                        @error("dataOrtu.{$id_orang_tua}.no_telp")
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="nama_pekerjaan_{{ $id_orang_tua }}"
                            class="block text-xs font-medium mb-1">Pekerjaan</label>
                        <select id="nama_pekerjaan_{{ $id_orang_tua }}"
                            wire:model="dataOrtu.{{ $id_orang_tua }}.nama_pekerjaan" class="border p-2 w-full rounded-lg focus:border-tertiary  focus:ring-tertiary shadow-sm">
                            <option value="">Pilih Pekerjaan</option>
                            @foreach ($pekerjaanOrangTua as $pekerjaan)
                                <option value="{{ $pekerjaan->id_pekerjaan }}">
                                    {{ $pekerjaan->nama_pekerjaan }}
                                </option>
                            @endforeach
                        </select>
                        @error("dataOrtu.{$id_orang_tua}.nama_pekerjaan")
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Tombol Update untuk record ini --}}
                <div class="mt-6 flex justify-center gap-4">
                    <button type="button" wire:click="clearOrangTua({{ $id_orang_tua }})"
                        class="px-4 py-2 inline-flex justify-center items-center bg-red-500 border border-transparent font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-600 focus:bg-red-500 active:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 rounded">
                        Hapus Data Orang Tua
                    </button>
                    <button type="submit"
                        class="px-4 py-2 inline-flex justify-center items-center bg-tertiary border border-transparent font-semibold text-xs text-white uppercase tracking-widest hover:bg-secondary hover:text-tertiary focus:bg-tertiary active:bg-tertiary active:border active:border-tertiary focus:outline-none focus:ring-2 focus:ring-tertiary focus:ring-offset-2 transition ease-in-out duration-150 rounded">
                        Update Data Orang Tua
                    </button>
                </div>
            </form>
        @endforeach
    </div>
</div>