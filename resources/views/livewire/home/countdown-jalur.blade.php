<div wire:poll.60s="refreshData">
    @if(!$hasOpenJalur)
        <div class="text-center mt-6">
            <h4 class="text-xl font-semibold mb-4">Mohon Maaf, Pendaftaran sudah ditutup</h4>
        </div>
    @else
        <div class="text-center mt-6">
            <h4 class="text-xl font-semibold mb-4">Hitung Mundur Pendaftaran</h4>
        </div>
        <div class="flex flex-col md:flex-row items-center justify-center gap-8 p-3 md:p-0">
            {{-- Reguler countdown --}}
            <section class="bg-white p-6 rounded-xl border border-neutral-200 w-full max-w-md">
                @if($regulerOpen && $regulerStartAt && $regulerEndAt)
                    <x-countdown-box title="Pendaftaran Jalur Reguler"
                                     :start="$regulerStartAt"
                                     :end="$regulerEndAt" />
                @else
                    <div class="min-h-[120px] flex items-center justify-center text-center text-base font-semibold">
                        Jalur Reguler tidak tersedia saat ini
                    </div>
                @endif
            </section>

            {{-- Non-Reguler countdown (Afirmasi & Prestasi) --}}
            <section class="bg-white p-6 rounded-xl border border-neutral-200 w-full max-w-md">
                @if($nonRegulerOpen && $nonRegulerNearestOpen && $nonRegulerLatestClose)
                    <x-countdown-box title="Jalur Afirmatif & Prestasi"
                                     :start="$nonRegulerNearestOpen"
                                     :end="$nonRegulerLatestClose" />
                @else
                    <div class="min-h-[120px] flex items-center justify-center text-center text-base font-semibold">
                        Jalur Afirmatif & Prestasi tidak tersedia saat ini
                    </div>
                @endif
            </section>
        </div>
    @endif
</div>
