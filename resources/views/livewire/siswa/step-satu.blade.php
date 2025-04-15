<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="mb-7">
        <div class="">
            <div class="pt-6 pb-12">
                <h1 class="text-3xl text-center font-bold">BIODATA DIRI</h1>
            </div>
        </div>

        <div class="flex flex-row justify-center lg:justify-between px-4 sm:px-40 items-center mx-auto bg-secondary">
            <button wire:click="$set('tab', 1)"
                class="step-indicator w-16 h-16 sm:w-24 sm:h-24 rounded-xl flex flex-col items-center justify-center {{ $tab == 1 ? 'bg-tertiary text-white' : '' }}">
                <a class="bg-white rounded-full items-center justify-center flex w-8 h-8 sm:w-12 sm:h-12">
                    <h1 class="font-bold text-primary text-center text-sm sm:text-3xl">1</h1>
                </a>
                <a class="text-[8px] md:text-[13px]">
                    <h1 class="font-semibold flex text-center">Biodata Diri</h1>
                </a>
            </button>

            <button wire:click="$set('tab', 2)"
                class="step-indicator w-16 h-16 sm:w-24 sm:h-24 rounded-xl flex flex-col items-center justify-center {{ $tab == 2 ? 'bg-tertiary text-white' : '' }}
                @if (!$isCompleteBiodata) cursor-not-allowed @endif"
                @if (!$isCompleteBiodata) disabled @endif>
                <a class="bg-white rounded-full items-center justify-center flex w-8 h-8 sm:w-12 sm:h-12">
                    <h1 class="font-bold text-primary text-center text-sm sm:text-3xl">2</h1>
                </a>
                <a class="text-[8px] md:text-[13px]">
                    <h1 class="font-semibold flex text-center">Data Orang Tua dan Wali</h1>
                </a>
            </button>

            <button wire:click="$set('tab', 3)"
                class="step-indicator w-16 h-16 sm:w-24 sm:h-24 rounded-xl flex flex-col items-center justify-center {{ $tab == 3 ? 'bg-tertiary text-white' : '' }}
                @if (!$isCompleteOrangtua) cursor-not-allowed @endif  @if (!$isCompleteBiodata) cursor-not-allowed @endif"
                @if (!$isCompleteOrangtua) disabled @endif @if (!$isCompleteBiodata) disabled @endif>
                <a class="bg-white rounded-full items-center justify-center flex w-8 h-8 sm:w-12 sm:h-12">
                    <h1 class="font-bold text-primary text-center text-sm sm:text-3xl">3</h1>
                </a>
                <a class="text-[8px] md:text-[13px]">
                    <h1 class="font-semibold flex text-center">Verifikasi Data</h1>
                </a>
            </button>
        </div>
    </div>

    <div>
        @if ($tab === 1)
            @livewire('siswa.biodata-siswa', key('biodata-siswa-' . $siswa->id_calon_siswa))

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
                <button wire:click="$set('tab', 2)" wire:loading.attr="disabled"
                    class="px-3 py-1 sm:px-6 sm:py-2 flex items-center justify-center rounded-xl font-medium
           @if (!$isCompleteBiodata) cursor-not-allowed bg-tertiary hover:bg-secondary hover:text-black text-secondary @else bg-tertiary hover:bg-secondary hover:text-black text-secondary @endif"
                    type="button" id="nextBtn" @if (!$isCompleteBiodata) disabled @endif>
                    Next
                </button>
            </div>

            {{-- <div
                class="navigation-buttons justify-between flex items-center py-10 sm:py-6 px-2 sm:px-4 max-w-7xl mx-auto">
                <button wire:click="$set('tab', 2)" wire:loading.attr="disabled" wire:target="isBiodataComplete"
                    class="px-3 py-1 sm:px-6 sm:py-2 flex items-center justify-center hover:bg-secondary rounded-xl text-secondary font-medium bg-tertiary hover:text-tertiary"
                    type="button" id="nextBtn" @if (!$this->isBiodataComplete()) disabled @endif>Next</button>
            </div> --}}
        @endif
        @if ($tab === 2)
            @livewire('siswa.orang-tua', key('formulir-orang-tua' . $orangTua->id_calon_siswa))
            <div
                class="navigation-buttons justify-between flex items-center py-10 sm:py-6 px-2 sm:px-4 max-w-7xl mx-auto mt-5">
                <button wire:click="$set('tab', 1)"
                    class="px-3 py-1 sm:px-6 sm:py-2 flex items-center justify-center hover:bg-secondary rounded-xl text-secondary font-medium bg-tertiary hover:text-tertiary"
                    type="button" id="nextBtn">Previous</button>
                {{-- <button wire:click="$set('tab', 3)"
                    class="px-3 py-1 sm:px-6 sm:py-2 flex items-center justify-center hover:bg-secondary rounded-xl text-secondary font-medium bg-tertiary hover:text-tertiary"
                    type="button" id="nextBtn">Next</button> --}}
                <button wire:click="$set('tab', 3)" wire:loading.attr="disabled"
                    class="px-3 py-1 sm:px-6 sm:py-2 flex items-center justify-center rounded-xl font-medium
           @if (!$isCompleteOrangtua) cursor-not-allowed bg-tertiary hover:bg-secondary hover:text-black text-secondary @else bg-tertiary hover:bg-secondary hover:text-black text-secondary @endif"
                    type="button" id="nextBtn" @if (!$isCompleteOrangtua) disabled @endif>
                    Next
                </button>
            </div>
        @endif
        @if ($tab === 3)
            @livewire('siswa.verifikasi-data', key('verifikasi-data'))
        @endif
    </div>
</div>
