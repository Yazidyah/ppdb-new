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
use Illuminate\Support\Facades\File;
use App\Mail\VerificationMail;

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

        $email = optional($this->siswa->user)->email;
        
        if (empty($email)) {
            \Log::warning('SendVerificationEmail: Email kosong untuk siswa ID ' . $this->siswa->id_calon_siswa);
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            \Log::error('SendVerificationEmail: Email tidak valid: ' . $email . ' untuk siswa ID ' . $this->siswa->id_calon_siswa);
            return;
        }

        try {
            \Log::info('SendVerificationEmail: Memulai pengiriman email ke ' . $email . ' (Status: ' . $this->status . ')');
            
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
                
                Mail::to($email)->send(
                    (new VerificationMail(
                        $this->siswa,
                        $this->status,
                        $messageBody
                    ))->attachData($pdf->output(), $fileName, [
                        'mime' => 'application/pdf',
                    ])
                );
                \Log::info('SendVerificationEmail: Email lolos verifikasi berhasil dikirim ke ' . $email);

            } elseif ($this->status == 4) {
                $messageBody = "Maaf {$this->siswa->nama_lengkap}, Kamu belum lolos verifikasi berkas";
               
                Mail::to($email)->send(
                    new VerificationMail(
                        $this->siswa,
                        $this->status,
                        $messageBody,
                    )
                );
                \Log::info('SendVerificationEmail: Email tidak lolos verifikasi dikirim ke ' . $email);

                $qrCodePath = public_path('qrcode/' . $this->siswa->dataRegistrasi->nomor_peserta . '.png');
                if (File::exists($qrCodePath)) {
                    File::delete($qrCodePath);
                    \Log::info('SendVerificationEmail: QR Code dihapus untuk ' . $this->siswa->dataRegistrasi->nomor_peserta);
                }
            }
        } catch (\Swift_TransportException $e) {
            \Log::error('SendVerificationEmail: SMTP Error untuk ' . $email . ' - ' . $e->getMessage());
        } catch (\Exception $e) {
            \Log::error('SendVerificationEmail: Gagal mengirim email ke ' . $email . ' - Error: ' . $e->getMessage());
            throw $e;
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
