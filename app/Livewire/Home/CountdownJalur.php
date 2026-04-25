<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\JalurRegistrasi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CountdownJalur extends Component
{
    public $hasOpenJalur = false;

    // Reguler
    public $regulerOpen = false;
    public $regulerStartAt = null; // Carbon|null
    public $regulerEndAt = null;   // Carbon|null

    // Non-reguler (Afirmatif & Prestasi)
    public $nonRegulerOpen = false;
    public $nonRegulerNearestOpen = null; // Carbon|null
    public $nonRegulerLatestClose = null; // Carbon|null

    protected $listeners = [
        'refreshCountdown' => '$refresh',
    ];

    public function mount()
    {
        $this->refreshData();
    }

    public function refreshData()
    {
        try {
            $jalurRegistrasi = JalurRegistrasi::query()
                ->where('is_open', true)
                ->where(function ($query) {
                    $query->whereNull('tanggal_tutup')
                        ->orWhereDate('tanggal_tutup', '>=', Carbon::today());
                })
                ->get();

            $this->hasOpenJalur = $jalurRegistrasi->isNotEmpty();

            // Reguler
            $reguler = $jalurRegistrasi->firstWhere('nama_jalur', 'Reguler');
            if ($reguler) {
                $this->regulerOpen = true;
                $this->regulerStartAt = $reguler->tanggal_buka ? Carbon::parse($reguler->tanggal_buka) : null;
                $this->regulerEndAt = $reguler->tanggal_tutup ? Carbon::parse($reguler->tanggal_tutup) : null;
            } else {
                $this->regulerOpen = false;
                $this->regulerStartAt = null;
                $this->regulerEndAt = null;
            }

            // Non-Reguler
            $nonReguler = $jalurRegistrasi->filter(function ($item) {
                return $item->nama_jalur !== 'Reguler';
            });

            if ($nonReguler->isNotEmpty()) {
                $this->nonRegulerOpen = true;
                // nearest opening date among non-reguler
                $nearest = $nonReguler
                    ->filter(fn($j) => !empty($j->tanggal_buka))
                    ->map(fn($j) => Carbon::parse($j->tanggal_buka))
                    ->sort()
                    ->first();

                // latest closing date among ALL open jalur
                $latestClose = $jalurRegistrasi
                    ->filter(fn($j) => !empty($j->tanggal_tutup))
                    ->map(fn($j) => Carbon::parse($j->tanggal_tutup))
                    ->sortDesc()
                    ->first();

                $this->nonRegulerNearestOpen = $nearest ?: null;
                $this->nonRegulerLatestClose = $latestClose ?: null;
            } else {
                $this->nonRegulerOpen = false;
                $this->nonRegulerNearestOpen = null;
                $this->nonRegulerLatestClose = null;
            }
        } catch (\Throwable $e) {
            Log::error('CountdownJalur refreshData failed', [
                'message' => $e->getMessage(),
            ]);
            $this->hasOpenJalur = false;
            $this->regulerOpen = false;
            $this->nonRegulerOpen = false;
        }
    }

    public function render()
    {
        return view('livewire.home.countdown-jalur');
    }
}
