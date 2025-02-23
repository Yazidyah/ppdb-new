<div>
    {{-- Be like water. --}}
    <a wire:click="$toggle('preview')">{{ $syarat->nama_persyaratan }}</a>
    @if ($preview)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div
                class="bg-white rounded-lg overflow-hidden overflow-y-auto shadow-xl transform transition-all sm:max-w-4xl sm:w-full sm:max-h-[90vh] border border-gray-300">
                <div class="px-6 py-5 sm:p-6">
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
