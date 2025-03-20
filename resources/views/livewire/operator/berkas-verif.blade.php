<div>
    {{-- Be like water. --}}
    <a wire:click="$toggle('preview')" class="text-blue-500 underline">{{ $syarat->nama_persyaratan }}</a>
    @if ($preview)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" @click.self="preview = false">
            <div
                class="bg-white rounded-lg overflow-hidden overflow-y-auto shadow-xl transform transition-all sm:max-w-4xl sm:w-full sm:max-h-[90vh] border border-gray-300 relative">
                <button wire:click="$toggle('preview')"
                    class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-red-400 rounded-full hover:text-white hover:bg-red-400">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <div class="px-6 py-5 sm:p-6">
                    <label for="dataBerkas" class="font-semibold">Nomor {{ $syarat->nama_persyaratan }}:</label>
                    <p id="dataBerkas" class="text-xl">{{ $berkas->data_berkas }}</p>
                    <p class="text-red-600 font-bold">Harap cocokkan nomor data dengan berkas dengan seksama</p>
                    @if ($url)
                        @if (Str::endsWith($berkas->original_name, '.pdf'))
                            <iframe src="{{ $url }}" frameborder="0"
                                class="w-full h-[70vh] sm:h-[80vh] over pt-2 pb-5 transform transition-all duration-300"
                                style="object-fit: cover;"></iframe>
                        @else
                            <img src="{{ $url }}" alt="Uploaded File" loading="lazy"
                                class="max-w-full object-contain transform transition-all duration-300 mt-3">
                        @endif
                    @endif
                </div>
                <div class="">
                    <button type="button"
                        class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-red-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:w-full sm:text-sm"
                        wire:click="$toggle('preview')">
                        Close
                    </button>
                </div>
            </div>
        </div>
    @endif

    <style>
        img {
            display: block;
            margin: 0 auto;
        }
    </style>
</div>