<?php

namespace App\Mail;

use App\Models\CalonSiswa;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class KartuPeserta extends Mailable
{
    // use Queueable, SerializesModels;

    // public $siswa;
    // public $jadwal_bq_wawancara;
    // public $jadwal_japres_tes_akademik;
    // public $pas_foto;

    // /**
    //  * Create a new message instance.
    //  *
    //  * @return void
    //  */
    // public function __construct(CalonSiswa $siswa, $jadwal_bq_wawancara, $jadwal_japres_tes_akademik)
    // {
    //     $this->siswa = $siswa;
    //     $this->jadwal_bq_wawancara = $jadwal_bq_wawancara;
    //     $this->jadwal_japres_tes_akademik = $jadwal_japres_tes_akademik;

    //     // Get the path of the pas foto
    //     $berkas = $siswa->user->berkas->where('persyaratan.nama_persyaratan', 'Pas Foto')->first();
    //     $this->pas_foto = Storage::path($berkas->file_name);
    // }

    // /**
    //  * Build the message.
    //  *
    //  * @return $this
    //  */
    // public function build()
    // {
    //     return $this->view('mail.kartu-peserta')
    //         ->with([
    //             'siswa' => $this->siswa,
    //             'jadwal_bq_wawancara' => $this->jadwal_bq_wawancara,
    //             'jadwal_japres_tes_akademik' => $this->jadwal_japres_tes_akademik,
    //             'pas_foto' => $this->pas_foto,
    //         ]);
    // }
}
