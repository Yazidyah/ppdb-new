<div>
    <div class="navigation-buttons justify-center flex items-center py-10 sm:py-6 px-2 sm:px-4 max-w-7xl mx-auto">
        <button
            class="px-3 w-full py-1 sm:px-6 sm:py-2 flex items-center justify-center hover:bg-secondary rounded-xl text-secondary font-medium bg-tertiary hover:text-tertiary"
            wire:click="$set('modalSubmit', true)">
            Isi data rapot
        </button>
    </div>


    @if ($modalSubmit)
        {{-- example --}}
        {{-- <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"></div>
            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex items-end justify-center min-h-full p-4 text-center sm:items-center sm:p-0">
                    <div
                        class="relative overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:w-full sm:max-w-lg p-4">
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
                                    wire:model.live='matematika{{ $sem }}'
                                    x-on:input="if (!/^\d*$/.test($event.target.value)) $event.target.value = $event.target.value.replace(/[^\d]/g, '')" />
                            </div>
                            <div>
                                <label for="bahasa_indonesia">Bahasa Indonesia semester {{ $sem }}</label>
                                <x-text-input class="bg-white" id="bahasa_indonesia{{ $sem }}"
                                    class="block mt-1 w-full" type="text" name="bahasa_indonesia{{ $sem }}"
                                    required autofocus autocomplete="bahasa_indonesia{{ $sem }}"
                                    wire:model.live='bahasa_indonesia{{ $sem }}'
                                    x-on:input="if (!/^\d*$/.test($event.target.value)) $event.target.value = $event.target.value.replace(/[^\d]/g, '')" />
                            </div>
                            <div>
                                <label for="bahasa_inggris">Bahasa Inggris semester {{ $sem }}</label>
                                <x-text-input class="bg-white" id="bahasa_inggris{{ $sem }}"
                                    class="block mt-1 w-full" type="text" name="bahasa_inggris{{ $sem }}"
                                    required autofocus autocomplete="bahasa_inggris{{ $sem }}"
                                    wire:model.live='bahasa_inggris{{ $sem }}'
                                    x-on:input="if (!/^\d*$/.test($event.target.value)) $event.target.value = $event.target.value.replace(/[^\d]/g, '')" />
                            </div>
                            <div>
                                <label for="pai">PAI semester {{ $sem }}</label>
                                <x-text-input class="bg-white" id="pai{{ $sem }}" class="block mt-1 w-full"
                                    type="text" name="pai{{ $sem }}" required autofocus
                                    autocomplete="pai{{ $sem }}" wire:model.live='pai{{ $sem }}'
                                    x-on:input="if (!/^\d*$/.test($event.target.value)) $event.target.value = $event.target.value.replace(/[^\d]/g, '')" />
                            </div>
                            <div>
                                <label for="ipa">IPA semester {{ $sem }}</label>
                                <x-text-input class="bg-white" id="ipa{{ $sem }}" class="block mt-1 w-full"
                                    type="text" name="ipa{{ $sem }}" required autofocus
                                    autocomplete="ipa{{ $sem }}" wire:model.live='ipa{{ $sem }}'
                                    x-on:input="if (!/^\d*$/.test($event.target.value)) $event.target.value = $event.target.value.replace(/[^\d]/g, '')" />
                            </div>
                            <div>
                                <label for="ips">IPS semester {{ $sem }}</label>
                                <x-text-input class="bg-white" id="ips{{ $sem }}" class="block mt-1 w-full"
                                    type="text" name="ips{{ $sem }}" required autofocus
                                    autocomplete="ips{{ $sem }}" wire:model.live='ips{{ $sem }}'
                                    x-on:input="if (!/^\d*$/.test($event.target.value)) $event.target.value = $event.target.value.replace(/[^\d]/g, '')" />
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
        </div> --}}
        {{-- fix --}}
        <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"></div>
            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex items-center justify-center min-h-full p-4 text-center sm:items-center sm:p-0">
                    <div
                        class="relative overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-2xl sm:my-8 sm:w-full sm:max-w-3xl p-8">
                        <h1 class="text-3xl text-center font-bold mb-6 text-gray-800">Isi Sesuai dengan Nilai
                            Pengetahuan di Rapor</h1>

                        <!-- Tab Semester -->
                        <div x-data="{ currentStep: @entangle('sem').defer }" x-init="currentStep = parseInt(new URLSearchParams(window.location.search).get('sem')) || 1"
                            class="flex flex-row justify-center lg:justify-between px-4 sm:px-6 items-center mx-auto bg-gray-100 mb-8 rounded-lg">
                            <template x-for="(step, index) in 5" :key="index">
                                <div @click="currentStep = (index + 1); window.history.pushState({}, '', '?sem=' + (index + 1) + '&t={{ $t }}'); $wire.set('sem', (index + 1))"
                                    :class="{
                                        'bg-blue-600 text-white': currentStep === (index + 1),
                                        'text-gray-700': currentStep !== (index + 1)
                                    }"
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
                            <div>
                                <label for="matematika" class="block text-lg font-semibold text-gray-700">Matematika
                                    semester {{ $sem }}</label>
                                <input
                                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500"
                                    id="matematika{{ $sem }}" type="text"
                                    name="matematika{{ $sem }}" required autofocus
                                    autocomplete="matematika{{ $sem }}"
                                    wire:model.live='matematika{{ $sem }}'
                                    x-on:input="if (!/^\d*$/.test($event.target.value)) $event.target.value = $event.target.value.replace(/[^\d]/g, '')" />
                            </div>
                            <div>
                                <label for="bahasa_indonesia" class="block text-lg font-semibold text-gray-700">Bahasa
                                    Indonesia semester {{ $sem }}</label>
                                <input
                                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500"
                                    id="bahasa_indonesia{{ $sem }}" type="text"
                                    name="bahasa_indonesia{{ $sem }}" required autofocus
                                    autocomplete="bahasa_indonesia{{ $sem }}"
                                    wire:model.live='bahasa_indonesia{{ $sem }}'
                                    x-on:input="if (!/^\d*$/.test($event.target.value)) $event.target.value = $event.target.value.replace(/[^\d]/g, '')" />
                            </div>
                            <div>
                                <label for="bahasa_inggris" class="block text-lg font-semibold text-gray-700">Bahasa
                                    Inggris semester {{ $sem }}</label>
                                <input
                                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500"
                                    id="bahasa_inggris{{ $sem }}" type="text"
                                    name="bahasa_inggris{{ $sem }}" required autofocus
                                    autocomplete="bahasa_inggris{{ $sem }}"
                                    wire:model.live='bahasa_inggris{{ $sem }}'
                                    x-on:input="if (!/^\d*$/.test($event.target.value)) $event.target.value = $event.target.value.replace(/[^\d]/g, '')" />
                            </div>
                            <div>
                                <label for="pai" class="block text-lg font-semibold text-gray-700">PAI semester
                                    {{ $sem }}</label>
                                <input
                                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500"
                                    id="pai{{ $sem }}" type="text" name="pai{{ $sem }}" required
                                    autofocus autocomplete="pai{{ $sem }}"
                                    wire:model.live='pai{{ $sem }}'
                                    x-on:input="if (!/^\d*$/.test($event.target.value)) $event.target.value = $event.target.value.replace(/[^\d]/g, '')" />
                            </div>
                            <div>
                                <label for="ipa" class="block text-lg font-semibold text-gray-700">IPA semester
                                    {{ $sem }}</label>
                                <input
                                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500"
                                    id="ipa{{ $sem }}" type="text" name="ipa{{ $sem }}" required
                                    autofocus autocomplete="ipa{{ $sem }}"
                                    wire:model.live='ipa{{ $sem }}'
                                    x-on:input="if (!/^\d*$/.test($event.target.value)) $event.target.value = $event.target.value.replace(/[^\d]/g, '')" />
                            </div>
                            <div>
                                <label for="ips" class="block text-lg font-semibold text-gray-700">IPS semester
                                    {{ $sem }}</label>
                                <input
                                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500"
                                    id="ips{{ $sem }}" type="text" name="ips{{ $sem }}" required
                                    autofocus autocomplete="ips{{ $sem }}"
                                    wire:model.live='ips{{ $sem }}'
                                    x-on:input="if (!/^\d*$/.test($event.target.value)) $event.target.value = $event.target.value.replace(/[^\d]/g, '')" />
                            </div>
                        </div>

                        <div class="sm:flex sm:flex-row-reverse sm:px-6 mt-8">
                            <button type="button" wire:click="kirim"
                                class="inline-flex justify-center w-full px-8 py-3 text-lg font-semibold text-white bg-blue-600 rounded-md shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">
                                Kirim
                            </button>
                            <button type="button" wire:click="$set('modalSubmit', false)"
                                class="inline-flex justify-center w-full px-8 py-3 mt-3 text-lg font-semibold text-gray-900 bg-white rounded-md shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
