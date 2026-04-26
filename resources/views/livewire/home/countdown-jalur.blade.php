<div wire:poll.60s="refreshData">
    @if(!$hasOpenJalur)
        <div class="text-center py-12 md:py-16">
            <div class="bg-white rounded-2xl shadow-sm p-8 md:p-12 max-w-2xl mx-auto border-t-4 border-tertiary relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-secondary/10 rounded-full -mr-16 -mt-16"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-primary/10 rounded-full -ml-12 -mb-12"></div>
                
                <div class="relative z-10">
                    <div class="bg-gray-100 rounded-full w-24 h-24 md:w-28 md:h-28 mx-auto mb-6 flex items-center justify-center">
                        <svg class="w-12 h-12 md:w-16 md:h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="text-2xl md:text-3xl font-bold text-gray-800 mb-3">Pendaftaran Ditutup</h4>
                    <p class="text-gray-600 text-base md:text-lg leading-relaxed">
                        Mohon maaf, saat ini tidak ada jalur pendaftaran yang dibuka.<br>
                        <span class="text-sm">Silakan pantau website ini untuk informasi pembukaan pendaftaran selanjutnya.</span>
                    </p>
                </div>
            </div>
        </div>
    @else
        <div class="text-center mb-8 md:mb-12">
            <div class="inline-block bg-primary/10 rounded-full px-5 py-2 mb-4">
                <span class="text-primary font-semibold text-sm">⏰ Countdown</span>
            </div>
            <h3 class="text-3xl md:text-4xl font-bold text-tertiary mb-3">
                Hitung Mundur Pendaftaran
            </h3>
            <p class="text-gray-600 text-base md:text-lg max-w-2xl mx-auto">
                Jangan lewatkan kesempatan emas untuk mendaftar! Segera lengkapi pendaftaran Anda.
            </p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 md:gap-8">
            <div class="relative bg-white rounded-2xl shadow-sm transition-all duration-300 overflow-hidden border border-gray-100">
                <div class="bg-gradient-to-r from-primary to-tertiary px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h4 class="text-white font-bold text-lg md:text-xl">Jalur Reguler</h4>
                        <div class="bg-white/20 backdrop-blur-sm rounded-full px-3 py-1">
                            <span class="text-white text-xs font-semibold">Reguler</span>
                        </div>
                    </div>
                </div>

                @if($regulerOpen && $regulerStartAt && $regulerEndAt)
                    <div class="p-6 md:p-8">
                        <x-countdown-box 
                            title=""
                            :start="$regulerStartAt"
                            :end="$regulerEndAt" 
                        />
                    </div>
                @else
                    <div class="p-8 md:p-10 min-h-[240px] flex flex-col items-center justify-center text-center">
                        <div class="bg-gray-100 rounded-full w-20 h-20 flex items-center justify-center mb-4">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <p class="text-lg md:text-xl font-bold text-gray-700 mb-2">Jalur Reguler</p>
                        <p class="text-sm text-gray-500">Belum dibuka</p>
                        <div class="mt-4 bg-gray-50 rounded-lg px-4 py-2">
                            <p class="text-xs text-gray-600">Pantau terus untuk info pembukaan</p>
                        </div>
                    </div>
                @endif
            </div>

            <div class="relative bg-white rounded-2xl shadow-sm transition-all duration-300 overflow-hidden border border-gray-100">
                <div class="bg-gradient-to-r from-tertiary to-primary px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h4 class="text-white font-bold text-lg md:text-xl">Afirmatif & Prestasi</h4>
                        <div class="bg-white/20 backdrop-blur-sm rounded-full px-3 py-1">
                            <span class="text-white text-xs font-semibold">Khusus</span>
                        </div>
                    </div>
                </div>

                @if($nonRegulerOpen && $nonRegulerNearestOpen && $nonRegulerLatestClose)
                    <div class="p-6 md:p-8">
                        <x-countdown-box 
                            title=""
                            :start="$nonRegulerNearestOpen"
                            :end="$nonRegulerLatestClose" 
                        />
                    </div>
                @else
                    <div class="p-8 md:p-10 min-h-[240px] flex flex-col items-center justify-center text-center">
                        <div class="bg-gray-100 rounded-full w-20 h-20 flex items-center justify-center mb-4">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <p class="text-lg md:text-xl font-bold text-gray-700 mb-2">Afirmatif & Prestasi</p>
                        <p class="text-sm text-gray-500">Belum dibuka</p>
                        <div class="mt-4 bg-gray-50 rounded-lg px-4 py-2">
                            <p class="text-xs text-gray-600">Pantau terus untuk info pembukaan</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="mt-8 bg-gradient-to-r from-secondary/20 to-primary/10 rounded-xl p-6 border-l-4 border-primary shadow-sm">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <h5 class="font-bold text-tertiary mb-1">Informasi Penting</h5>
                    <p class="text-gray-700 text-sm leading-relaxed">
                        Pastikan Anda melengkapi semua persyaratan sebelum batas waktu pendaftaran berakhir. 
                        Untuk informasi lebih lanjut, silakan hubungi panitia PPDB.
                    </p>
                </div>
            </div>
        </div>
    @endif
</div>
