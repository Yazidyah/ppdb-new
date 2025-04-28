<div>
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
                        <h1 class="font-semibold flex text-sm md:text-base text-center text-wrap">Verifikasi</h1>
                    </a>
                </button>
            </div>

        </div>

        <div>
            @if ($tab === 1)
                @livewire('verifikasi.finalisasi-dokumen', key('finalisasi-dokumen-' . $user->id))
                <div
                    class="navigation-buttons justify-between flex items-center py-10 sm:py-6 px-2 sm:px-4 max-w-7xl mx-auto">
                    <button onclick="window.location.href='/siswa/daftar-step-tiga?t=1'"
                        class="px-3 py-1 sm:px-6 sm:py-2 flex items-center justify-center hover:bg-secondary rounded-xl text-secondary font-medium bg-tertiary hover:text-tertiary"
                        type="button" id="nextBtn">Previous</button>
                    <button onclick="document.getElementById('info-popup').classList.remove('hidden')" class="px-3 py-1 sm:px-6 sm:py-2 flex items-center justify-center rounded-xl font-medium
                            @if (!$isValid)
                                cursor-not-allowed bg-tertiary hover:bg-secondary hover:text-black text-secondary
                            @else
                                bg-tertiary hover:bg-secondary hover:text-black text-secondary
                            @endif" type="button" id="submitBtn" @if (!$isValid) disabled @endif
                        data-tooltip-target="tooltip-incomplete">
                        Submit
                    </button>
                    @if (!$isValid)
                        <div id="tooltip-incomplete" role="tooltip"
                            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                            Harap lengkapi dokumen terlebih dahulu
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
    <div id="info-popup" tabindex="-1"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <div class="relative p-6 bg-white rounded-lg shadow md:p-10">
                <button id="close-modal-icon" type="button"
                    class="absolute top-3 right-3 p-2 text-gray-500 hover:text-white bg-white rounded-lg border border-gray-200 hover:border-red-900 hover:bg-red-900 focus:ring-4 focus:outline-none focus:ring-gray-300 focus:z-10"
                    onclick=" document.getElementById('info-popup').classList.add('hidden')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
                <div class="mb-6 text-base font-light text-gray-500">
                    <h3 class="mb-4 text-3xl font-bold text-gray-900">Konfirmasi Unggah Dokumen</h3>
                    <p class="text-md text-justify">
                        Dengan ini saya menyatakan bahwa saya meyakini sepenuhnya bahwa dokumen yang telah saya unggah
                        merupakan dokumen yang <span class="font-bold text-tertiary"> Sah, Valid</span>, dan memuat
                        informasi yang <span class="font-bold text-tertiary"> Akurat sesuai dengan kondisi
                            sebenarnya.</span></p>
                    <p class="text-md text-justify">
                        Saya juga bersedia untuk <span class="font-bold text-tertiary">mempertanggungjawabkan</span>
                        keabsahan serta kebenaran data yang tercantum di dalam dokumen tersebut sesuai dengan peraturan
                        dan standar yang berlaku.
                    </p>
                </div>
                <div class="justify-between items-center pt-0 space-y-4 sm:flex sm:space-y-0">
                    <div class="items-center space-y-4 sm:space-x-4 sm:flex sm:space-y-0">
                        <button id="close-modal" type="button"
                            class="py-3 px-5 w-full text-base font-medium text-white bg-red-900 rounded-lg border border-red-900 sm:w-auto hover:bg-red-500 focus:ring-4 focus:outline-none focus:ring-red-500  focus:z-10"
                            onclick="document.getElementById('info-popup').classList.add('hidden')">Batal</button>
                        <button id="confirm-button" type="button"
                            class="py-3 px-5 w-full text-base font-medium text-center text-secondary rounded-lg bg-tertiary sm:w-auto hover:bg-secondary hover:text-tertiary focus:ring-4 focus:outline-none focus:ring-tertiary"
                            wire:click="updateStatus">Ya, Saya Yakin</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>