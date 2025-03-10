<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\CalonSiswa;

class StatusAcc extends Mailable
{
    use Queueable, SerializesModels;

    public $siswa;
    public $messageBody;
    public $pdf;
    public $fileName;

    /**
     * Create a new message instance.
     */
    public function __construct($siswa, $messageBody, $status)
{
    $this->siswa = $siswa;
    $this->messageBody = $messageBody;
    $this->status = $status; // Simpan status dalam properti objek

    // Generate PDF
    $this->pdf = Pdf::loadView('mail.surat-keterangan', [
        'siswa' => $this->siswa,
        'status' => $this->status // Kirim status ke PDF view
    ]);
        $this->fileName = 'Surat_keterangan_ppdb_man1kotabogor_' . $this->siswa->dataRegistrasi->kode_registrasi . '.pdf';
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject($this->messageBody)
            ->markdown('mail.StatusAcc', [
                'name' => $this->siswa->user->name,
                'status' => $this->status,
            ])
            ->attachData($this->pdf->output(), $this->fileName, [
                'mime' => 'application/pdf',
            ]);
    }
}
