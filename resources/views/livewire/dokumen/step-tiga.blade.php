<div>
    <div>
        {{-- Be like water. --}}
        <div class="mb-7">
            <div class="">
                <div class="pt-6 pb-12">
                    <h1 class="text-3xl text-center font-bold">UPLOAD DOKUMEN</h1>
                </div>
            </div>

            {{-- <p>{{ $tab }}</p> --}}
            <div class="flex flex-row justify-center px-4 sm:px-40 items-center mx-auto bg-secondary">
                <button wire:click="$set('tab', 1)"
                    class="step-indicator w-16 h-16 sm:w-24 sm:h-24 rounded-xl flex flex-col items-center justify-center {{ $tab == 1 ? 'bg-tertiary text-white' : '' }}">
                    <a class="">
                        <h1 class="text-wrap text-xs md:text-xl font-semibold flex text-center">Upload Dokumen syarat
                        </h1>
                    </a>
                </button>
            </div>
        </div>
        <div id="exampleModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm" onclick="closeExample()">
            <div class="bg-white p-6 rounded-lg shadow-lg w-[32rem]" onclick="event.stopPropagation()">
            <h2 class="text-lg font-semibold">Contoh File</h2>
            <img id="exampleImage" href="exampleFiles()" alt="Contoh File" class="mt-4 w-full rounded">
            <button onclick="closeExample()" class="mt-4 px-4 py-2 bg-red-500 text-white rounded-lg">Tutup</button>
            </div>
        </div>

        {{-- <div id="rapotModal" class=" fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                <h2 class="text-lg font-semibold">Isi Data Rapot</h2>
                <div>
                    @livewire('dokumen.rapot', key('rapot'))
                </div>
                <button onclick="rapotModal()" class="mt-4 px-4 py-2 bg-red-500 text-white rounded-lg">Tutup</button>
            </div>
        </div> --}}

        <div>
            @if ($tab == 1)
                @livewire('dokumen.upload-dokumen', key($user->id . '-upload-dokumen-' . rand()))

                <div>
                    @livewire('dokumen.rapot-modal', ['t' => $tab, 'regis' => $user->registrasi], key($user->id . '-rapot-' . rand()))
                </div>

                <div>
                    @livewire('dokumen.berkas-modal', ['t' => $tab, 'regis' => $user->registrasi], key($user->id . '-berkas-' . rand()))
                </div>
            @endif
        </div>
    </div>
</div>
