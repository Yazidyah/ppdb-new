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
use App\Models\EmailBlastLog;

class SendStatusAccEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $siswa;
    protected $messageBody;
    protected $status;
    protected $logId;

    public function __construct($siswa, $messageBody, $status, $logId = null)
    {
        $this->siswa = $siswa;
        $this->messageBody = $messageBody;
        $this->status = $status;
        $this->logId = $logId;
    }

    public function handle()
    {
        $this->delay(now()->addSeconds(2));

        $email = $this->siswa->user->email ?? null;
        
        if (empty($email)) {
            \Log::warning('SendStatusAccEmail: Email kosong untuk siswa ID ' . $this->siswa->id_calon_siswa);
            $this->updateLog('failed', 'Email kosong');
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            \Log::error('SendStatusAccEmail: Email tidak valid: ' . $email . ' untuk siswa ID ' . $this->siswa->id_calon_siswa);
            $this->updateLog('failed', 'Email tidak valid');
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
            $this->updateLog('sent');
            
            $qrCodePath = public_path('qrcode/' . $this->siswa->dataRegistrasi->nomor_peserta . '.png');
            if (File::exists($qrCodePath)) {
                File::delete($qrCodePath);
                \Log::info('SendStatusAccEmail: QR Code dihapus untuk ' . $this->siswa->dataRegistrasi->nomor_peserta);
            }
        } catch (\Swift_TransportException $e) {
            \Log::error('SendStatusAccEmail: SMTP Error untuk ' . $email . ' - ' . $e->getMessage());
            $this->updateLog('failed', 'SMTP Error: ' . $e->getMessage());
        } catch (\Exception $e) {
            \Log::error('SendStatusAccEmail: Gagal mengirim email ke ' . $email . ' - Error: ' . $e->getMessage());
            $this->updateLog('failed', $e->getMessage());
            throw $e;
        }
    }

    protected function updateLog($status, $errorMessage = null)
    {
        if (!$this->logId) return;

        EmailBlastLog::where('id', $this->logId)->update([
            'sent_status' => $status,
            'error_message' => $errorMessage,
            'sent_at' => $status === 'sent' ? now() : null,
        ]);
    }
}
