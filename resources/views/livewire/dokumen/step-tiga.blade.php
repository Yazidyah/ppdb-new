<div>
    {{-- Be like water. --}}
    <div class="mb-7">
        <div class="">
            <div class="pt-6 pb-12">
                <h1 class="text-3xl text-center font-bold">UPLOAD DOKUMEN</h1>
            </div>
        </div>

        {{-- <p>{{ $tab }}</p> --}}
        <div class="flex flex-row justify-center lg:justify-between px-4 sm:px-40 items-center mx-auto bg-secondary">
            <button wire:click="$set('tab', 1)"
                class="step-indicator w-16 h-16 sm:w-24 sm:h-24 rounded-xl flex flex-col items-center justify-center {{ $tab == 1 ? 'bg-tertiary text-white' : '' }}">
                <a class="bg-white rounded-full items-center justify-center flex w-8 h-8 sm:w-12 sm:h-12">
                    <h1 class="font-bold text-primary text-center text-sm sm:text-3xl">1</h1>
                </a>
                <a class="text-[8px] md:text-[13px]">
                    <h1 class="font-semibold flex text-center">Upload Dokumen syarat</h1>
                </a>
            </button>
        </div>

    </div>
<<<<<<< HEAD

=======
    <div id="exampleModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-lg font-semibold">Contoh File</h2>
        <img id="exampleImage" href="exampleFiles()" alt="Contoh File" class="mt-4 w-full rounded">
        <button onclick="closeExample()" class="mt-4 px-4 py-2 bg-red-500 text-white rounded-lg">Tutup</button>
    </div>
    </div>
    
>>>>>>> da45044 (Del Dark Fix FE n Rapot)
    <div>
        @if ($tab === 1)
            @livewire('dokumen.upload-dokumen', key('upload-dokumen' . rand()))
            <div
                class="navigation-buttons justify-between flex items-center py-10 sm:py-6 px-2 sm:px-4 max-w-7xl mx-auto">
                <button wire:click="$set('tab', 2)"
                    class="px-3 py-1 sm:px-6 sm:py-2 flex items-center justify-center hover:bg-secondary rounded-xl text-secondary font-medium bg-tertiary hover:text-tertiary"
                    type="button" id="nextBtn">Next</button>
            </div>
        @endif
    </div>
</div>
