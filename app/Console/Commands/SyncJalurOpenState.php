<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\JalurService;

class SyncJalurOpenState extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-jalur-open-state';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync kolom is_open pada tabel jalur_registrasi berdasarkan tanggal_tutup setiap hari';

    public function handle(JalurService $service): int
    {
        $service->syncOpenState();
        $this->info('Sync is_open selesai.');
        return self::SUCCESS;
    }
}
