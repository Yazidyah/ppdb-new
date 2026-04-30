<div class="text-left" wire:poll.5s="refreshProgress">
    <div class="flex items-center gap-4">
        <button
            class="px-4 py-2 text-sm font-medium text-white transition-colors bg-tertiary border rounded-md hover:bg-secondary hover:text-tertiary active:bg-secondary focus:bg-secondary focus:outline-none focus:ring-2 focus:ring-secondary focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none min-w-[250px]"
            wire:click="kirimEmail" 
            wire:loading.attr="disabled" 
            wire:target="kirimEmail"
            {{ $isProcessing || $canResume ? 'disabled' : '' }}>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="inline-block w-6 h-6 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21.75 6.75v10.5A2.25 2.25 0 0 1 19.5 19.5h-15A2.25 2.25 0 0 1 2.25 17.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-.659 1.591l-7.091 7.091a2.25 2.25 0 0 1-3.182 0L3.909 8.584A2.25 2.25 0 0 1 3.25 6.993V6.75" />
            </svg>
            <span wire:loading.remove wire:target="kirimEmail">
                Kirim Email ({{ $totalEmail }} siswa)
            </span>
            <span wire:loading wire:target="kirimEmail">
                Memproses...
            </span>
        </button>

        @if($canResume)
        <button
            class="px-4 py-2 text-sm font-medium text-white transition-colors bg-orange-600 border rounded-md hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none"
            wire:click="resumeEmail" 
            wire:loading.attr="disabled" 
            wire:target="resumeEmail">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline-block w-5 h-5 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
            </svg>
            <span wire:loading.remove wire:target="resumeEmail">
                Lanjutkan
            </span>
            <span wire:loading wire:target="resumeEmail">
                Melanjutkan...
            </span>
        </button>
        @endif
    </div>

    @if($progress > 0)
    <div class="mt-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
        <div class="flex items-center justify-between mb-2">
            <span class="text-sm font-semibold text-gray-700">Progress Pengiriman</span>
            <span class="text-sm font-bold text-tertiary">{{ $progress }}%</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-3 mb-3">
            <div class="bg-tertiary h-3 rounded-full transition-all duration-300" style="width: {{ $progress }}%"></div>
        </div>
        <div class="grid grid-cols-3 gap-4 text-center text-sm">
            <div>
                <div class="text-gray-600">Total</div>
                <div class="font-bold text-gray-900">{{ $totalEmail }}</div>
            </div>
            <div>
                <div class="text-gray-600">Terkirim</div>
                <div class="font-bold text-green-600">{{ $totalSent }}</div>
            </div>
            <div>
                <div class="text-gray-600">Gagal</div>
                <div class="font-bold text-red-600">{{ $totalFailed }}</div>
            </div>
        </div>
    </div>
    @endif
    
    @if (session()->has('success'))
        <div class="mt-3 p-3 bg-green-100 border border-green-400 text-green-700 rounded flex items-start gap-2">
            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mt-3 p-3 bg-red-100 border border-red-400 text-red-700 rounded flex items-start gap-2">
            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>{{ session('error') }}</span>
        </div>
    @endif
</div>
