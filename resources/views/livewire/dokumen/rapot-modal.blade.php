<div>
    @if ($modalSubmit)
        <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
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
                        <div x-data="{ currentStep: @entangle('sem').defer }" x-init="currentStep = parseInt(new URLSearchParams(window.location.search).get('sem')) || 3"
                            class="flex flex-col justify-center lg:justify-between ">

                            <div class="px-4 sm:px-6 items-center mx-auto bg-gray-100 mb-8 rounded-lg w-full">
                                <div class="flex flex-row justify-between items-center space-x-4 mt-6 mb-4">
                                    @foreach (range(3, 5) as $step)
                                        <div @click="currentStep = {{ $step }}; $wire.set('sem', {{ $step }})"
                                            :class="{
                                                'bg-tertiary text-white': currentStep === {{ $step }},
                                                'text-gray-700': currentStep !== {{ $step }}
                                            }"
                                            class="step-indicator w-16 h-16 sm:w-24 sm:h-24 rounded-2xl flex flex-col items-center justify-center cursor-pointer transition duration-300 ease-in-out transform hover:scale-105 hover:bg-secondary hover:text-primary">
                                            <div
                                                class="bg-white rounded-full flex items-center justify-center w-8 h-8 sm:w-12 sm:h-12">
                                                <h1 class="font-bold text-gray-700 text-center text-sm sm:text-3xl">
                                                    {{ $step }}
                                                </h1>
                                            </div>
                                            <div class="text-[8px] md:text-[13px]">
                                                <h1 class="font-semibold text-center">
                                                    Semester {{ $step }}
                                                </h1>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- Input Nilai -->
                            <div class="steps space-y-6 w-full">
                                @foreach (['pai', 'bahasa_indonesia', 'matematika', 'ipa', 'ips', 'bahasa_inggris'] as $subject)
                                    <div>
                                        <label for="{{ $subject }}"
                                            class="block text-lg font-semibold text-gray-700">{{ strtoupper(str_replace('_', ' ', $subject)) }}</label>
                                        <input
                                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-tertiary focus:border-tertiary"
                                            id="{{ $subject }}{{ $sem }}" type="text"
                                            @if ('pai' === $subject) placeholder="Untuk MTs, Nilai Qur'an Hadis, Akidah Akhlak, Fikih, dan SKI dijumlahkan kemudian dibagi 4" @endif
                                            name="{{ $subject }}{{ $sem }}" required autofocus
                                            autocomplete="{{ $subject }}{{ $sem }}"
                                            wire:model.live="{{ $subject }}{{ $sem }}" maxlength="5"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" />
                                        @error($subject . $sem)
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endforeach
                            </div>

                            <div
                                class="flex flex-col justify-between  sm:flex-row  mt-8 space-y-4 sm:space-y-0 sm:space-x-4 sm:space-x-4  w-full">

                                <div class="w-full sm:w-auto">
                                    <div class="w-full sm:w-auto">
                                        <button type="button" wire:click="$set('modalSubmit', false)"
                                            class="inline-flex justify-center w-full px-8 py-3 text-lg font-semibold text-white bg-red-500 rounded-md shadow-sm hover:bg-red-700 transition duration-300">
                                            Batal
                                        </button>
                                    </div>
                                </div>


                                <div class="flex flex-row gap-4">
                                    <div x-show="currentStep != 3" class="w-full sm:w-auto">
                                        <button
                                            x-on:click="if (currentStep > 3) { currentStep--; $wire.set('sem', currentStep); }"
                                            type="button"
                                            class="inline-flex justify-center w-full px-8 py-3 text-lg font-semibold text-white bg-gray-700 rounded-md shadow-sm hover:bg-red-700 transition duration-300">
                                            Kembali
                                        </button>
                                    </div>

                                    <div x-show="currentStep != 5" class="w-full sm:w-auto">
                                        <button
                                            x-on:click="if (currentStep < 5) { currentStep++; $wire.set('sem', currentStep); }"
                                            type="button"
                                            class="inline-flex justify-center w-full px-8 py-3 text-lg font-semibold text-white bg-tertiary rounded-md shadow-sm hover:bg-secondary hover:text-tertiary transition duration-300">
                                            Next
                                        </button>
                                    </div>
                                    <div x-show="currentStep === 5" class="w-full sm:w-auto">
                                        <button type="button" wire:click="kirim"
                                            class="inline-flex justify-center w-full px-8 py-3 text-lg font-semibold text-white bg-tertiary rounded-md shadow-sm hover:bg-secondary hover:text-tertiary transition duration-300">
                                            Kirim
                                        </button>
                                    </div>

                                </div>



                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
