@props(['title' => '', 'start' => null, 'end' => null])

@php
    // Pass ISO datetime strings to JS
    $startIso = optional($start)->toIso8601String();
    $endIso = optional($end)->toIso8601String();
@endphp

<div x-data="{
        startDate: new Date('{{$startIso}}').getTime(),
        endDate: new Date('{{$endIso}}').getTime(),
        remainingTime: 0,
        countdownMessage: '',
        phase: 'idle',
        formatTime(time) {
            const days = Math.floor(time / (1000 * 60 * 60 * 24));
            const hours = Math.floor((time % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((time % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((time % (1000 * 60)) / 1000);
            return { days, hours, minutes, seconds };
        }
    }" x-init="() => {
        const updateCountdown = () => {
            const now = new Date().getTime();
            if (now < startDate) {
                $data.remainingTime = startDate - now;
                $data.countdownMessage = 'Pendaftaran Dimulai Dalam';
                $data.phase = 'start';
            } else if (now >= startDate && now < endDate) {
                $data.remainingTime = endDate - now;
                $data.countdownMessage = 'Pendaftaran Ditutup Dalam';
                $data.phase = 'end';
            } else {
                $data.remainingTime = 0;
                $data.countdownMessage = 'Pendaftaran Telah Ditutup';
                $data.phase = 'closed';
            }
        };
        updateCountdown();
        setInterval(updateCountdown, 1000);
    }">
    
    <div class="min-h-[200px] flex flex-col justify-center">
        @if($title)
        <div class="text-center text-lg font-bold text-tertiary mb-4">{{ $title }}</div>
        @endif
        
        <template x-if="remainingTime > 0">
            <div>
                <div class="flex justify-center mb-6">
                    <div x-text="countdownMessage"
                         :class="{
                             'bg-gradient-to-r from-blue-500 to-blue-600 text-white': phase === 'start',
                             'bg-gradient-to-r from-orange-500 to-red-500 text-white': phase === 'end'
                         }"
                         class="text-sm font-bold px-6 py-2.5 rounded-full inline-flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span x-text="countdownMessage"></span>
                    </div>
                </div>
                
                <div class="grid grid-cols-4 gap-3 md:gap-4">
                    <div class="relative">
                        <div class="bg-gradient-to-br from-primary to-tertiary rounded-xl p-3 md:p-4">
                            <div class="text-2xl md:text-3xl font-bold text-white text-center mb-1" x-text="formatTime(remainingTime).days">0</div>
                            <div class="text-xs md:text-sm text-secondary font-semibold text-center uppercase">Hari</div>
                        </div>
                    </div>
                    
                    <div class="relative">
                        <div class="bg-gradient-to-br from-primary to-tertiary rounded-xl p-3 md:p-4">
                            <div class="text-2xl md:text-3xl font-bold text-white text-center mb-1" x-text="formatTime(remainingTime).hours">0</div>
                            <div class="text-xs md:text-sm text-secondary font-semibold text-center uppercase">Jam</div>
                        </div>
                    </div>
                    
                    <div class="relative">
                        <div class="bg-gradient-to-br from-primary to-tertiary rounded-xl p-3 md:p-4">
                            <div class="text-2xl md:text-3xl font-bold text-white text-center mb-1" x-text="formatTime(remainingTime).minutes">0</div>
                            <div class="text-xs md:text-sm text-secondary font-semibold text-center uppercase">Menit</div>
                        </div>
                    </div>
                    
                    <div class="relative">
                        <div class="bg-gradient-to-br from-primary to-tertiary rounded-xl p-3 md:p-4">
                            <div class="text-2xl md:text-3xl font-bold text-white text-center mb-1" x-text="formatTime(remainingTime).seconds">0</div>
                            <div class="text-xs md:text-sm text-secondary font-semibold text-center uppercase">Detik</div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-gray-200">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-3 text-xs md:text-sm text-gray-600">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="font-medium">Mulai: <span class="text-tertiary font-semibold" x-text="new Date('{{$startIso}}').toLocaleDateString('id-ID', {day: 'numeric', month: 'short', year: 'numeric'})"></span></span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="font-medium">Tutup: <span class="text-tertiary font-semibold" x-text="new Date('{{$endIso}}').toLocaleDateString('id-ID', {day: 'numeric', month: 'short', year: 'numeric'})"></span></span>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        
        <template x-if="remainingTime <= 0">
            <div class="flex flex-col items-center justify-center py-8">
                <div class="bg-red-100 rounded-full p-4 mb-4">
                    <svg class="w-12 h-12 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="text-base font-bold px-6 py-3 rounded-xl text-red-800 bg-red-100 border-2 border-red-300" x-text="countdownMessage"></span>
            </div>
        </template>
    </div>
</div>
