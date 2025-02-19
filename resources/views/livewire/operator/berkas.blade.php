<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="berkas">

        <div class="px-2 py-2 text-sm text-gray-700 border rounded-xl">
            <div class="flex flex-col sm:flex-row sm:justify-between gap-3">
                <div class="flex gap-3 items-center">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                    <div class="">

                        {{ $berkas->original_name }}
                    </div>
                </div>
                <div class="flex gap-2">
                    @if ($viewVerifikasi)
                        @switch($berkas->verify)
                            @case(-2)
                                <button id="verifikasi-berkas" wire:click="$toggle('openCatatan')"
                                    class="px-2 py-1 gap-1 text-xs font-semibold text-red-600 flex items-center border border-red-300 rounded-full animate-pulse">
                                    <span>
                                        <svg class="w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="currentColor" class="size-6">
                                            <path fill-rule="evenodd"
                                                d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                    <span>
                                        Ditolak
                                    </span>
                                </button>
                            @break

                            @case(-1)
                                <button id="verifikasi-berkas" wire:click="$toggle('openCatatan')"
                                    class="px-2 py-1 gap-1 text-xs font-semibold text-yellow-600 flex items-center border border-yellow-300 rounded-full animate-pulse">
                                    <div>
                                        <svg class="w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="currentColor" class="size-6">
                                            <path fill-rule="evenodd"
                                                d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <span>
                                        Revisi
                                    </span>
                                </button>
                            @break

                            @case(1)
                                <button id="verifikasi-berkas" wire:click="$toggle('openCatatan')"
                                    class="px-2 py-1 gap-1 text-xs font-semibold text-green-600 flex items-center border border-green-300 rounded-full animate-pulse">
                                    <div>
                                        <svg class="w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="currentColor" class="size-6">
                                            <path fill-rule="evenodd"
                                                d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <span>Diterima</span>
                                </button>
                            @break

                            @default
                        @endswitch
                    @endif
                    @if ($verifikasi)
                        <button class="transition transform hover:scale-110" wire:click="$toggle('openVerifikasi')">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                            </svg>

                        </button>
                    @endif
                    {{-- Verifikasi --}}

                    <button class="transition transform hover:scale-110" wire:click="$toggle('preview')">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </button>
                    {{-- Download --}}
                    <button class="transition transform hover:scale-110" wire:click="download">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                    </button>

                    {{-- Delete --}}
                    @if ($editable and $berkas->verify == 0)
                        <button class="transition transform hover:scale-110" wire:click="delete">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-red-600">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    @endif
                </div>
            </div>
            <hr class="my-2">
            <div class="flex justify-between">
                <div class="text-xs">
                    <div class="font-medium">Diunggah</div>
                    <div class="">{{ $berkas->created_at }}</div>
                </div>
                @if ($berkas->created_at != $berkas->updated_at)
                    <div class="text-xs">
                        <div class="font-medium">Diverifikasi</div>
                        <div class="">
                            {{ $berkas->updated_at }}
                        </div>
                    </div>
                @endif
            </div>
            <div class="">
                @if ($openCatatan)
                    @if ($berkas->verify_notes)
                        <div class="mt-3" id="catatan-berkas">
                            <div class="text-xs font-medium">Catatan</div>
                            <div class="whitespace-pre-line">{{ $verify_notes }}</div>
                        </div>
                    @endif
                @endif
            </div>



        </div>
        @if ($verifikasi)
            @if ($openVerifikasi)
                <div class="p-8 border-b rounded-b-lg border-x">
                    <div class="">

                        <div class="mb-3 text-sm font-medium text-gray-800">Verifikasi Berkas</div>
                        <div class="grid grid-cols-3 gap-3 text-sm p-2 rounded-full shadow">
                            <button wire:click="$set('verify','-2')"
                                @if ($verify == -2) class="py-2 font-semibold text-center text-white bg-red-600 rounded-full"
                                @else
                                class="py-2 font-medium text-center transform transition-all duration-300 hover:text-red-800 rounded-full hover:bg-red-100 bg-gray-100" @endif>
                                Tolak
                            </button>
                            <button wire:click="$set('verify','-1')"
                                @if ($verify == -1) class="py-2 font-semibold text-center text-white bg-yellow-600 rounded-full"
                        @else
                        class="py-2 font-medium text-center transform transition-all duration-300 hover:text-yellow-700 rounded-full hover:bg-orange-100 bg-gray-100" @endif>
                                Revisi
                            </button>
                            <button wire:click="$set('verify','1')"
                                @if ($verify == 1) class="py-2 font-semibold text-center text-white bg-green-600 rounded-full"
                        @else
                        class="py-2 font-medium text-center transform transition-all duration-300 hover:text-green-800 rounded-full hover:bg-green-100 bg-gray-100" @endif>
                                Terima
                            </button>
                        </div>
                    </div>
                    <div class="mt-5">
                        <label for="catatan"
                            class="block text-sm font-medium leading-6 text-gray-900">Catatan</label>
                        <div class="mt-2">
                            <textarea rows="4" name="catatan" id="catatan" wire:model="verify_notes"
                                class="block w-full rounded-lg border border-gray-200 py-1.5 text-gray-800 shadow ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                        </div>
                    </div>

                    <div class="flex justify-end mt-4">
                        <button class="c-button c-transition rounded-full" wire:click="simpan">Simpan</button>
                    </div>
                </div>
            @endif
        @endif
        @if ($preview)
            @if ($url)
                <iframe src="{{ $url }}" frameborder="0" class="w-full pt-2 pb-5 rounded-md"
                    height="1000px"></iframe>
            @endif
        @endif
    </div>

</div>
