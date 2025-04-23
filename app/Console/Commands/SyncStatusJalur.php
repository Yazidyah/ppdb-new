<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\JalurRegistrasi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
class SyncStatusJalur extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-status-jalur';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ini buat ngecek status jalur registrasi, kalo udah lewat tanggal tutupnya, set statusnya jadi tutup';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $jalurRegistrasi = JalurRegistrasi::where('is_open', true)->get();

        foreach ($jalurRegistrasi as $jalur) {
            $closingTime = Carbon::parse($jalur->tanggal_tutup)->setTime(23, 58);
            if (Carbon::now()->greaterThanOrEqualTo($closingTime)) {
                $jalur->update(['is_open' => false]);
                $this->info("Jalur ID {$jalur->id_jalur} status updated to 'Tutup'.");
            }
        }

        Log::channel('scheduler')->info("Status Jalur synced successfully.");
        return 0;
    }
}
