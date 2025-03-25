<div>
    <div class="px-5 py-3 text-sm border text-primary-700 bg-primary-100 rounded-xl">
        <div class="mb-4">
            @if (!is_null($berkas->data_berkas))
            <h2 class="text-center text-lg font-bold">Nomor Berkas : {{ $berkas->data_berkas }}</h2>
            @endif
        </div>
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
                <button class="transition transform hover:scale-110 hover:text-primary-600" wire:click="download">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>
                </button>


            </div>
        </div>
    </div>

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

    <style>
        img {
            display: block;
            margin: 0 auto;
        }
    </style>

</div>