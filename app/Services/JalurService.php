<?php

namespace App\Services;

use App\Models\JalurRegistrasi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class JalurService
{
    /**
     * Sync is_open based on tanggal_tutup: if today >= tanggal_tutup and time past 00:00, set false.
     */
    public function syncOpenState(): void
    {
        DB::beginTransaction();
        try {
            $today = Carbon::today();

            $affected = JalurRegistrasi::query()
                ->whereNotNull('tanggal_tutup')
                ->whereDate('tanggal_tutup', '<', $today)
                ->where('is_open', true)
                ->update(['is_open' => false]);

            Log::info('JalurService syncOpenState executed', [
                'affected' => $affected,
                'date' => $today->toDateString(),
            ]);

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('JalurService syncOpenState failed', [
                'message' => $e->getMessage(),
            ]);
            // Let other system processes continue; we only log the failure.
        }
    }

    /**
     * Validate backend guard for registration based on selected jalur.
     */
    public function assertJalurOpen(int $jalurId): void
    {
        $jalur = JalurRegistrasi::find($jalurId);
        if (!$jalur || !$jalur->is_open) {
            throw new \RuntimeException('Jalur yang dipilih tidak terbuka untuk pendaftaran.');
        }
    }
}
