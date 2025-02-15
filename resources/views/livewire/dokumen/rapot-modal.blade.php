<div>
    <div class="navigation-buttons justify-center flex items-center py-10 sm:py-6 px-2 sm:px-4 max-w-7xl mx-auto">
        <button
            class="px-3 w-full py-1 sm:px-6 sm:py-2 flex items-center justify-center hover:bg-secondary rounded-xl text-secondary font-medium bg-tertiary hover:text-tertiary"
            wire:click="$set('modalSubmit', true)">
            Isi data rapot
        </button>
    </div>


    @if ($modalSubmit)
        <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"></div>
            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex items-end justify-center min-h-full p-4 text-center sm:items-center sm:p-0">
                    <div
                        class="relative overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:w-full sm:max-w-lg p-4">
                        {{-- tab semester --}}
                        <div x-data="{ currentStep: @entangle('sem').defer }" x-init="currentStep = parseInt(new URLSearchParams(window.location.search).get('sem')) || 1"
                            class="flex flex-row justify-center lg:justify-between px-4 sm:px-6 items-center mx-auto bg-secondary mb-6 rounded-lg">

                            <template x-for="(step, index) in 5" :key="index">
                                <div @click="currentStep = (index + 1); window.history.pushState({}, '', '?sem=' + (index + 1) + '&t={{ $t }}'); $wire.set('sem', (index + 1))"
                                    :class="{
                                        'bg-tertiary text-white': currentStep === (index + 1),
                                        ' text-gray-700': currentStep !== (index + 1)
                                    }"
                                    class="step-indicator w-16 h-16 sm:w-24 sm:h-24 rounded-2xl flex flex-col items-center justify-center cursor-pointer">
                                    <div
                                        class="bg-white rounded-full flex items-center justify-center w-8 h-8 sm:w-12 sm:h-12">
                                        <h1 class="font-bold text-gray-700 text-center text-sm sm:text-3xl"
                                            x-text="index + 1"></h1>
                                    </div>
                                    <div class="text-[8px] md:text-[13px]">
                                        <h1 class="font-semibold text-center" x-text="'Semester ' + (index + 1)"></h1>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <div class="steps">
                            <div>
                                <label for="matematika">Matematika semester {{ $sem }}</label>
                                <x-text-input class="bg-white" id="matematika{{ $sem }}"
                                    class="block mt-1 w-full" type="text" name="matematika{{ $sem }}"
                                    required autofocus autocomplete="matematika{{ $sem }}"
                                    wire:model.live='matematika{{ $sem }}' />
                            </div>
                            <div>
                                <label for="bahasa_indonesia">Bahasa Indonesia semester {{ $sem }}</label>
                                <x-text-input class="bg-white" id="bahasa_indonesia{{ $sem }}"
                                    class="block mt-1 w-full" type="text" name="bahasa_indonesia{{ $sem }}"
                                    required autofocus autocomplete="bahasa_indonesia{{ $sem }}"
                                    wire:model.live='bahasa_indonesia{{ $sem }}' />
                            </div>
                        </div>


                        <div class="px-4 py-3 bg-gray-50 sm:flex sm:flex-row-reverse sm:px-6">
                            <button type="button" wire:click="kirim"
                                class="inline-flex justify-center w-full px-8 py-2 text-sm font-medium text-white bg-blue-600 rounded-md shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">
                                Verifikasi
                            </button>
                            <button type="button" wire:click="$set('modalSubmit', false)"
                                class="inline-flex justify-center w-full px-8 py-2 mt-3 text-sm font-medium text-gray-900 bg-white rounded-md shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
