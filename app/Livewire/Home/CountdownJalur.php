<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\JalurRegistrasi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CountdownJalur extends Component
{
    private const REGULER_NAME = 'Reguler';

    public $hasOpenJalur = false;

    // Reguler
    public $regulerOpen = false;
    public $regulerStartAt = null; // Carbon|null
    public $regulerEndAt = null;   // Carbon|null

    // Non-reguler (Afirmatif & Prestasi)
    public $nonRegulerOpen = false;
    public $nonRegulerNearestOpen = null; // Carbon|null
    public $nonRegulerLatestClose = null; // Carbon|null

    public function mount()
    {
        $this->refreshData();
    }

    public function refreshData()
    {
        try {
            $jalurRegistrasi = $this->getActiveJalurRegistrasi();

            $this->hasOpenJalur = $jalurRegistrasi->isNotEmpty();
            $this->syncRegulerCountdown($jalurRegistrasi);
            $this->syncNonRegulerCountdown($jalurRegistrasi);
        } catch (\Throwable $e) {
            Log::error('CountdownJalur refreshData failed', [
                'message' => $e->getMessage(),
            ]);
            $this->resetCountdownState();
        }
    }

    private function getActiveJalurRegistrasi()
    {
        return JalurRegistrasi::query()
            ->where('is_open', true)
            ->where(function ($query) {
                $query->whereNull('tanggal_tutup')
                    ->orWhereDate('tanggal_tutup', '>=', Carbon::today());
            })
            ->get();
    }

    private function syncRegulerCountdown($jalurRegistrasi): void
    {
        $reguler = $jalurRegistrasi->firstWhere('nama_jalur', self::REGULER_NAME);

        $this->regulerOpen = (bool) $reguler;
        $this->regulerStartAt = $reguler?->tanggal_buka ? Carbon::parse($reguler->tanggal_buka) : null;
        $this->regulerEndAt = $reguler?->tanggal_tutup ? Carbon::parse($reguler->tanggal_tutup) : null;
    }

    private function syncNonRegulerCountdown($jalurRegistrasi): void
    {
        $nonReguler = $jalurRegistrasi->reject(fn ($item) => $item->nama_jalur === self::REGULER_NAME);

        $this->nonRegulerOpen = $nonReguler->isNotEmpty();
        $this->nonRegulerNearestOpen = $nonReguler
            ->filter(fn ($jalur) => !empty($jalur->tanggal_buka))
            ->map(fn ($jalur) => Carbon::parse($jalur->tanggal_buka))
            ->sort()
            ->first() ?: null;

        $this->nonRegulerLatestClose = $jalurRegistrasi
            ->filter(fn ($jalur) => !empty($jalur->tanggal_tutup))
            ->map(fn ($jalur) => Carbon::parse($jalur->tanggal_tutup))
            ->sortDesc()
            ->first() ?: null;
    }

    private function resetCountdownState(): void
    {
        $this->hasOpenJalur = false;
        $this->regulerOpen = false;
        $this->regulerStartAt = null;
        $this->regulerEndAt = null;
        $this->nonRegulerOpen = false;
        $this->nonRegulerNearestOpen = null;
        $this->nonRegulerLatestClose = null;
    }

    public function render()
    {
        return view('livewire.home.countdown-jalur');
    }
}
