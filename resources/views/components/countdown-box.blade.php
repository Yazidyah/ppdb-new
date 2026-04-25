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
        phase: 'idle', // 'start' | 'end' | 'closed'
        formatTime(time) {
            const days = Math.floor(time / (1000 * 60 * 60 * 24));
            const hours = Math.floor((time % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((time % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((time % (1000 * 60)) / 1000);
            return { days, hours, minutes, seconds };
        },
        visibleUnits(time) {
            const parts = this.formatTime(time);

            if (parts.days > 0) {
                return [
                    { label: 'Hari', value: parts.days },
                    { label: 'Jam', value: parts.hours },
                ];
            }

            if (parts.hours > 0) {
                return [
                    { label: 'Jam', value: parts.hours },
                    { label: 'Menit', value: parts.minutes },
                ];
            }

            return [
                { label: 'Menit', value: parts.minutes },
                { label: 'Detik', value: parts.seconds },
            ];
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
    <div class="min-h-[120px] flex flex-col justify-center">
        <div class="text-center text-base font-semibold mb-3">{{ $title }}</div>
        <template x-if="remainingTime > 0">
            <div>
                <div class="flex justify-center mb-3">
                    <span
                        x-text="countdownMessage"
                        :class="{
                            'text-blue-800 bg-blue-100 border border-blue-300': phase === 'start',
                            'text-orange-800 bg-orange-100 border border-orange-300': phase === 'end'
                        }"
                        class="text-sm font-semibold px-3 py-1 rounded-md"
                    ></span>
                </div>
                <div class="grid grid-cols-2 gap-4 text-center">
                    <template x-for="unit in visibleUnits(remainingTime)" :key="unit.label">
                        <div class="flex flex-col items-center w-16 mx-auto">
                            <div class="text-2xl font-medium text-gray-600" x-text="unit.value"></div>
                            <div class="text-xs text-gray-500" x-text="unit.label"></div>
                        </div>
                    </template>
                </div>
            </div>
        </template>
        <template x-if="remainingTime <= 0">
            <div class="flex justify-center">
                <span class="text-sm font-semibold px-3 py-1 rounded-md text-red-800 bg-red-100 border border-red-300" x-text="countdownMessage"></span>
            </div>
        </template>
    </div>
</div>
