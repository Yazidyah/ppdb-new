<div>
    @if ($modalSubmit)
        <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true" wire:click="$set('modalSubmit', false)">
            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"></div>
            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex items-center justify-center min-h-full p-4 text-center sm:items-center sm:p-0">
                    <div
                        class="relative overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-2xl sm:my-8 sm:w-full sm:max-w-3xl p-8">
                        <button wire:click="$set('modalSubmit', false)"
                            class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                            <svg class="h-4 w-4 inline-block ml-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                                data-slot="icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                        <h1 class="text-3xl text-center font-bold mb-6 text-gray-800">Isi Sesuai dengan Nilai
                            Pengetahuan di Rapor</h1>

                        <!-- Tab Semester -->
                        <div x-data="{ currentStep: @entangle('sem').defer }" x-init="currentStep = parseInt(new URLSearchParams(window.location.search).get('sem')) || 1"
                            class="flex flex-row justify-center lg:justify-between px-4 sm:px-6 items-center mx-auto bg-gray-100 mb-8 rounded-lg">
                            <template x-for="(step, index) in 5" :key="index">
                                <div @click="currentStep = (index + 1); $wire.set('sem', (index + 1))"
                                    :class="{ 'bg-tertiary text-white': currentStep === (index +
                                        1), 'text-gray-700': currentStep !== (index + 1) }"
                                    class="step-indicator w-16 h-16 sm:w-24 sm:h-24 rounded-2xl flex flex-col items-center justify-center cursor-pointer transition duration-300 ease-in-out transform hover:scale-105">
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

                        <!-- Input Nilai -->
                        <div class="steps space-y-6">
                            @foreach (['matematika', 'bahasa_indonesia', 'bahasa_inggris', 'pai', 'ipa', 'ips'] as $subject)
                                <div>
                                    <label for="{{ $subject }}"
                                        class="block text-lg font-semibold text-gray-700">{{ ucfirst(str_replace('_', ' ', $subject)) }}</label>
                                    <input
                                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-tertiary focus:border-tertiary"
                                        id="{{ $subject }}{{ $sem }}" type="text"
                                        name="{{ $subject }}{{ $sem }}" required autofocus
                                        autocomplete="{{ $subject }}{{ $sem }}"
                                        wire:model.live="{{ $subject }}{{ $sem }}"
                                        x-on:input="let value = $event.target.value.replace(/[^\d.]/g, ''); if (!/^\d*\.?\d*$/.test(value) || parseFloat(value) > 100) { value = value.slice(0, 5); if (parseFloat(value) > 100) { value = '100'; } } $event.target.value = value;"
                                        x-on:focus="if ($event.target.value == 0) $event.target.value = ''" />
                                    @error($subject . $sem)
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endforeach
                        </div>

                        <div class="sm:flex sm:flex-row-reverse sm:px-6 mt-8">
                            <button type="button" wire:click="kirim"
                                class="inline-flex justify-center w-full px-8 py-3 text-lg font-semibold text-white bg-tertiary rounded-md shadow-sm hover:bg-secondary hover:text-tertiary sm:ml-3 sm:w-auto">
                                Kirim
                            </button>
                            <button type="button" wire:click="$set('modalSubmit', false)"
                                class="inline-flex justify-center w-full px-8 py-3 mt-3 text-lg font-semibold text-white bg-red-900 rounded-md shadow-sm ring-1 ring-inset ring-red-900 hover:bg-red-500 sm:mt-0 sm:w-auto">
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
