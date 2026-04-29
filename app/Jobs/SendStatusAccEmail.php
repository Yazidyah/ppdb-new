<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\StatusAcc;
use Illuminate\Support\Facades\File;

class SendStatusAccEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $siswa;
    protected $messageBody;
    protected $status;

    /**
     * Create a new job instance.
     */
    public function __construct($siswa, $messageBody, $status)
    {
        $this->siswa = $siswa;
        $this->messageBody = $messageBody;
        $this->status = $status;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $this->delay(now()->addSeconds(2));

        $email = $this->siswa->user->email ?? null;
        
        if (empty($email)) {
            \Log::warning('SendStatusAccEmail: Email kosong untuk siswa ID ' . $this->siswa->id_calon_siswa);
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            \Log::error('SendStatusAccEmail: Email tidak valid: ' . $email . ' untuk siswa ID ' . $this->siswa->id_calon_siswa);
            return;
        }

        try {
            \Log::info('SendStatusAccEmail: Memulai pengiriman email ke ' . $email . ' (Status: ' . $this->status . ')');
            
            Mail::to($email)->send(new StatusAcc(
                $this->siswa,
                $this->messageBody,
                $this->status
            ));
            
            \Log::info('SendStatusAccEmail: Email berhasil dikirim ke ' . $email);
            
            $qrCodePath = public_path('qrcode/' . $this->siswa->dataRegistrasi->nomor_peserta . '.png');
            if (File::exists($qrCodePath)) {
                File::delete($qrCodePath);
                \Log::info('SendStatusAccEmail: QR Code dihapus untuk ' . $this->siswa->dataRegistrasi->nomor_peserta);
            }
        } catch (\Swift_TransportException $e) {
            \Log::error('SendStatusAccEmail: SMTP Error untuk ' . $email . ' - ' . $e->getMessage());
        } catch (\Exception $e) {
            \Log::error('SendStatusAccEmail: Gagal mengirim email ke ' . $email . ' - Error: ' . $e->getMessage());
            \Log::error('SendStatusAccEmail: Stack trace: ' . $e->getTraceAsString());
            throw $e;
        }
    }
}
