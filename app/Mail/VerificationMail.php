<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerificationMail extends Mailable
{
    public $siswa;
    public $status;
    public $messageBody;

    public function __construct($siswa, $status, $messageBody)
    {
        $this->siswa = $siswa;
        $this->status = $status;
        $this->messageBody = $messageBody;
    }

    public function build()
    {
        return $this->subject('Hasil Verifikasi Berkas')
            ->markdown('mail.verification');
    }
}
