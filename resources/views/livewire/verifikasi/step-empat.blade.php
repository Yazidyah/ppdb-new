<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
        <div class="mb-7">
        <div class="">
            <div class="pt-6 pb-12">
                <h1 class="text-3xl text-center font-bold">FINALISASI PENDAFTARAN</h1>
            </div>
        </div>

        {{-- <p>{{ $tab }}</p> --}}
        <div class="flex flex-row justify-center px-4 sm:px-40 items-center mx-auto bg-secondary">
            <button wire:click="$set('tab', 1)"
                class="step-indicator w-16 h-16 sm:w-24 sm:h-24 rounded-xl flex flex-col items-center justify-center {{ $tab == 1 ? 'bg-tertiary text-white' : '' }}">
                <a class="">
                    <h1 class="font-semibold flex text-center text-wrap">Verifikasi</h1>
                </a>
            </button>
        </div>

    </div>

    <div>
        @if ($tab === 1)
            @livewire('verifikasi.finalisasi-dokumen', key('finalisasi-dokumen'))
            <div class="navigation-buttons justify-between flex items-center py-10 sm:py-6 px-2 sm:px-4 max-w-7xl mx-auto">
            </div>
        @endif
    </div>
</div>
