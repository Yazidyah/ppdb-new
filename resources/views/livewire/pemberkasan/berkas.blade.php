<div>
    <div class="px-5 py-3 text-sm border text-primary-700 bg-primary-100 rounded-xl">
        <div class="flex flex-col gap-3 sm:flex-row sm:justify-between">
            <div class="flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
                <div class="flex items-start">
                    <div class="flex flex-col text-left">
                        <div class="flex items-center text-sm">
                            <div class="font-medium">{{ $berkas->original_name }}</div>
                        </div>
                        <div class="flex items-center text-xs text-gray-500">
                            <div class="font-regular">{{ $berkas->created_at }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex gap-5 mt-2 sm:gap-3 sm:mt-0">
                <button class="transition transform hover:scale-110 hover:text-primary-600"
                    wire:click="$toggle('preview')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        \n"
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </button>
                <button class="transition transform hover:scale-110 hover:text-primary-600" wire:click="download">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>
                </button>
                <button class="transition transform hover:scale-110 " wire:click="delete">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 text-primary-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    @if ($preview)
        @if ($url)
            @if (Str::endsWith($berkas->original_name, '.pdf'))
                <iframe src="{{ $url }}" frameborder="0"
                    class="w-full h-[300px] sm:h-[500px] md:h-[800px] pt-2 pb-5  transform transition-all duration-300"
                    style="object-fit: cover;"></iframe>
            @else
                <img src="{{ $url }}" alt="Uploaded File" loading="lazy"
                    class="max-w-full object-contain transform transition-all duration-300 mt-3">
            @endif
        @endif
    @endif

    <style>
        img {
            display: block;
            margin: 0 auto;
        }
    </style>
</div>
