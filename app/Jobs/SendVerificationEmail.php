<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class SendVerificationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $siswa;
    protected $status;
    protected $urlPasFoto;
    protected $syarat;
    protected $jadwalBqWawancara;
    protected $jadwalJapresTesAkademik;

    /**
     * Create a new job instance.
     */
    public function __construct($siswa, $status, $urlPasFoto, $syarat, $jadwalBqWawancara, $jadwalJapresTesAkademik)
    {
        $this->siswa = $siswa;
        $this->status = $status;
        $this->urlPasFoto = $urlPasFoto;
        $this->syarat = $syarat;
        $this->jadwalBqWawancara = $jadwalBqWawancara;
        $this->jadwalJapresTesAkademik = $jadwalJapresTesAkademik;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $this->delay(now()->addSeconds(5));

        $pdf = Pdf::loadView('mail.kartu-peserta', [
            'pas_foto' => $this->urlPasFoto ? Storage::path($this->urlPasFoto) : null,
            'siswa' => $this->siswa,
            'syarat' => $this->syarat,
            'jadwal_bq_wawancara' => $this->jadwalBqWawancara,
            'jadwal_japres_tes_akademik' => $this->jadwalJapresTesAkademik,
        ]);

        $fileName = 'kartu-peserta_' . $this->siswa->dataRegistrasi->nomor_peserta . '.pdf';

        if ($this->status == 5) {
            $messageBody = "Selamat {$this->siswa->nama_lengkap}, Kamu telah lolos verifikasi berkas.";
            Mail::send([], [], function ($message) use ($pdf, $messageBody, $fileName) {
                $message->to($this->siswa->user->email)
                    ->subject('Hasil Verifikasi Berkas')
                    ->text($messageBody)
                    ->attachData($pdf->output(), $fileName, [
                        'mime' => 'application/pdf',
                    ]);
            });
        } elseif ($this->status == 4) {
            // $missingDocuments = $this->getMissingDocuments();
            // $messageBody = "Maaf, Kamu belum lolos verifikasi berkas karena: " . implode(', ', $missingDocuments) . "\n";
            $messageBody = "Maaf {$this->siswa->nama_lengkap}, Kamu belum lolos verifikasi berkas";
            Mail::raw($messageBody, function ($message) {
            $message->to($this->siswa->user->email)
                ->subject('Hasil Verifikasi Berkas');
            });
        }
    }

    /**
     * Get the list of missing or rejected documents.
     *
     * @return array
     */
    protected function getMissingDocuments()
    {
        $missingDocuments = [];
        foreach ($this->syarat as $item) {
            $berkas = $item->berkas->where('uploader_id', $this->siswa->id_user);
            if ($berkas->isEmpty()) {
                $missingDocuments[] = "tidak upload {$item->nama_persyaratan}";
            } else {
                foreach ($berkas as $file) {
                    if ($file->verify !== 1 && !empty($file->verify_notes)) {
                        $missingDocuments[] = "{$item->nama_persyaratan} (Catatan: {$file->verify_notes})";
                    }
                }
            }
        }
        return $missingDocuments;
    }
}
