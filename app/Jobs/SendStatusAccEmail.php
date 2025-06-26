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
            return;
        }

        Mail::to($email)->send(new StatusAcc(
            $this->siswa,
            $this->messageBody,
            $this->status
        ));

        $qrCodePath = public_path('qrcode/' . $this->siswa->dataRegistrasi->nomor_peserta . '.png');
        if (File::exists($qrCodePath)) {
            File::delete($qrCodePath);
        }
    }
}
