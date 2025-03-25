<div>
<button wire:click="$set('modalOpen', true)" type="button"
        class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors {{ $buttonColor }} border rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none">
        {!! $buttonIcon !!}
    </button>
    @if ($modalOpen)
        <div class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen">
            <div class="absolute inset-0 w-full h-full bg-black backdrop-blur-sm bg-opacity-70"
                wire:click="$set('modalOpen', false)"></div>
            <div class="relative w-full py-6 bg-white border shadow-lg px-7 border-neutral-200 sm:max-w-2xl sm:rounded-lg">
                <div class="flex items-center justify-between pb-3">
                    <h3 class="text-lg font-semibold">Verifikasi {{ ucwords($siswa->nama_lengkap) }}</h3>
                    <button wire:click="$set('modalOpen', false)"
                    class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-red-400 rounded-full hover:text-white hover:bg-red-400">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                </div>
                <div class="relative w-auto pb-8">
                    <input type="hidden" wire:model="id_registrasi">
                    <input type="hidden" wire:model="id_jadwal_tes">
                    <table class="w-full mb-4">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">No.</th>
                                <th class="px-4 py-2">Dokumen (Klik untuk lihat)</th>
                                <th class="px-4 py-2">Verif</th>
                                <th class="px-4 py-2">Catatan</th>
                            </tr>
                        </thead>
                        <tbody id="dokumenTableBody">
                            @foreach ($syarat as $index => $item)
                                @forelse ($item->berkas->where('uploader_id', $siswa->id_user) as $berkas)
                                    <tr>
                                        <td class="px-4 py-2">{{ $loop->parent->index + 1 }}</td>
                                        <td class="px-4 py-2">
                                            {{-- <a wire:click="$toggle('preview')">{{ $item->nama_persyaratan }}</a> --}}
                                            @livewire('operator.berkas-verif', ['syarat' => $item, 'berkas' => $berkas], key($siswa->id_user . 'berkas' . $berkas->id))
                                        </td>
                                        <td class="px-4 py-2">
                                            <input type="checkbox" wire:model="verif.{{ $berkas->id }}" value="1" {{ $berkas->verify ? 'checked' : '' }}>
                                        </td>
                                        <td class="px-4 py-2">
                                            <input wire:model="catatan.{{ $berkas->id }}" type="text"
                                                name="catatan[{{ $berkas->id }}]" class="w-full border rounded-md" value="{{ $berkas->verify_notes }}">
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="px-4 py-2">{{ $index + 1 }}</td>
                                        <td class="px-4 py-2">
                                            <p>{{ $item->nama_persyaratan }}</p>
                                        </td>
                                        <td class="px-4 py-2" colspan="2">
                                            <p>Berkas Belum Di Upload</p>
                                        </td>
                                    </tr>
                                @endforelse
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mb-4 grid grid-cols-2 gap-4 items-center">
                        <label for="status" class="text-sm font-medium text-gray-700 text-left">Update Status</label>
                        <select id="status" wire:model="status"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option value="3">Pilih Status</option>
                            <option value="4">Tidak Lolos</option>
                            <option value="5">Lolos</option>
                        </select>
                    </div>
                    <div class="mb-4 grid grid-cols-2 gap-4 items-center">
                        <label for="sesi_bq_wawancara" class="text-sm font-medium text-gray-700 text-left">Sesi BQ &
                            Wawancara</label>
                        <select id="sesi_bq_wawancara" wire:model="sesi_bq_wawancara"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option value="">Tidak dijadwalkan</option>
                            @foreach ($jadwalTesBqWawancara as $jadwalBq)
                                <option class="" value="{{ $jadwalBq['id'] }}">{{ $jadwalBq['label'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4 grid grid-cols-2 gap-4 items-center">
                        <label for="sesi_japres_tes_akademik" class="text-sm font-medium text-gray-700 text-left">Sesi
                            Japres/Tes Akademik</label>
                        <select id="sesi_japres_tes_akademik" wire:model="sesi_japres_tes_akademik"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option value="">Tidak dijadwalkan</option>
                            @foreach ($jadwalTesJapresTesAkademik as $jadwalJa)
                                <option value="{{ $jadwalJa['id'] }}">{{ $jadwalJa['label'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-2">
                    <button wire:click="$set('modalOpen', false)" type="button"
                        class="inline-flex justify-center items-center px-4 py-2 bg-red-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500  focus:bg-red-900 active:bg-red-900 active:border active:border-red-900 focus:outline-none focus:ring-2 focus:ring-red-900 focus:ring-offset-2  transition ease-in-out duration-150">Cancel</button>
                    <button wire:click="simpan" type="button"
                        class="inline-flex justify-center items-center px-4 py-2 bg-tertiary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-secondary hover:text-tertiary focus:bg-tertiary active:bg-tertiary active:border active:border-tertiary focus:outline-none focus:ring-2 focus:ring-tertiary focus:ring-offset-2  transition ease-in-out duration-150">Simpan</button>
                </div>
            </div>
        </div>
    @endif
</div>