<?php

namespace App\Livewire\Operator;

use Livewire\Component;
use App\Models\JadwalTes;
use App\Models\DataTes;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class VerifBerkas extends Component
{
    public $modalOpen = false;
    public $siswa;
    public $berkas;
    public $syarat;
    public $catatan = [];
    public $verif = [];
    public $preview = false;
    public $status;
    public $sesi_bq_wawancara;
    public $sesi_japres_tes_akademik;
    public $jadwalTesBqWawancara;
    public $jadwalTesJapresTesAkademik;
    public $id_registrasi;
    public $id_jadwal_tes;
    protected $jalur;
    public $buttonColor = '';
    public $buttonIcon = '';

    public function mount()
    {
        $this->initializeData();
        $this->jadwalTesBqWawancara = $this->getJadwalTes(true);
        $this->jadwalTesJapresTesAkademik = $this->getJadwalTes(false);
        $this->setExistingDataTes();
        $this->setExistingCatatan();
        $this->setExistingVerif();
        $this->setButtonColor();
        $this->setButtonIcon();
    }

    /**
     * Inisialisasi data awal dari dataRegistrasi.
     */
    protected function initializeData()
    {
        $dataRegistrasi = $this->siswa->dataRegistrasi;
        if ($dataRegistrasi) {
            $this->syarat = $dataRegistrasi->syarat;
            $this->status = $dataRegistrasi->status;
            $this->jalur = $dataRegistrasi->jalur;
            $this->id_registrasi = $dataRegistrasi->id_registrasi;
        } else {
            $this->syarat = collect();
            $this->status = null;
            $this->jalur = null;
            $this->id_registrasi = null;
        }
    }

    /**
     * Set default status to "Tidak Lolos" (3) when opening the modal.
     */
    public function openModal()
    {
        $this->modalOpen = true;
        $this->updateRegistrasiStatus();
    }

    /**
     * Ambil jadwal tes berdasarkan tipe (BQ atau bukan).
     *
     * @param bool $isBq Jika true, mengambil jadwal tes dengan nama yang mengandung 'BQ'
     *                     jika false, mengambil jadwal tes selain 'BQ'.
     * @return \Illuminate\Support\Collection
     */
    protected function getJadwalTes($isBq = true)
    {
        $operator = $isBq ? 'like' : 'not like';
        return JadwalTes::whereHas('jenisTes', function ($query) use ($operator) {
            if ($this->jalur) {
                $query->where('no_jalur', $this->jalur->id_jalur)
                    ->where('nama', $operator, '%BQ%');
            }
        })->get()->map(function ($jadwal) {
            $formattedDate = Carbon::parse($jadwal->tanggal)->format('d-m-Y');
            return [
                'id' => $jadwal->id,
                'label' => "{$jadwal->id}) Tgl {$formattedDate} - Ruang {$jadwal->ruang} - Jam {$jadwal->jam_mulai} - {$jadwal->jam_selesai} ({$jadwal->terisi}/{$jadwal->kuota})",
            ];
        });
    }

    /**
     * Set data tes yang sudah ada untuk mengisi sesi tes.
     */
    protected function setExistingDataTes()
    {
        $existingDataTes = DataTes::where('id_registrasi', $this->id_registrasi)->get();
        foreach ($existingDataTes as $dataTes) {
            if (strpos($dataTes->jadwalTes->jenisTes->nama, 'BQ') !== false) {
                $this->sesi_bq_wawancara = $dataTes->id_jadwal_tes;
            } else {
                $this->sesi_japres_tes_akademik = $dataTes->id_jadwal_tes;
            }
        }
    }

    /**
     * Set existing catatan for each berkas.
     */
    protected function setExistingCatatan()
    {
        foreach ($this->syarat as $item) {
            foreach ($item->berkas->where('uploader_id', $this->siswa->id_user) as $berkas) {
                $this->catatan[$berkas->id] = $berkas->verify_notes;
            }
        }
    }

    /**
     * Set existing verification status for each berkas.
     */
    protected function setExistingVerif()
    {
        foreach ($this->syarat as $item) {
            foreach ($item->berkas->where('uploader_id', $this->siswa->id_user) as $berkas) {
                $this->verif[$berkas->id] = $berkas->verify;
            }
        }
    }

    /**
     * Set button color based on status.
     */
    protected function setButtonColor()
    {
        if ($this->status == 3) {
            $this->buttonColor = 'bg-red-500 hover:bg-red-700';
        } elseif ($this->status >= 4) {
            $this->buttonColor = 'bg-green-500 hover:bg-green-700';
        } else {
            $this->buttonColor = 'bg-blue-500 hover:bg-blue-700';
        }
    }

    /**
     * Set button icon based on status.
     */
    protected function setButtonIcon()
    {
        if ($this->status == 3) {
            $this->buttonIcon = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>';
        } elseif ($this->status >= 4) {
            $this->buttonIcon = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
            </svg>';
        } else {
            $this->buttonIcon = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
            </svg>';
        }
    }

    /**
     * Proses penyimpanan verifikasi berkas dan pengaturan data tes.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function simpan()
    {
        $this->updateBerkasVerifikasi();
        $this->updateRegistrasiStatus();
        $this->processDataTes();

        $jadwalBqWawancara = $this->formatJadwalTes($this->sesi_bq_wawancara);
        $jadwalJapresTesAkademik = $this->formatJadwalTes($this->sesi_japres_tes_akademik);

        $pdf = Pdf::loadView('mail.kartu-peserta', [
            'siswa' => $this->siswa,
            'syarat' => $this->syarat,
            'jadwal_bq_wawancara' => $jadwalBqWawancara,
            'jadwal_japres_tes_akademik' => $jadwalJapresTesAkademik,
        ]);

        $fileName = 'kartu-peserta_' . $this->siswa->dataRegistrasi->kode_registrasi . '.pdf';

        // Send email notification
        if ($this->status == 4) {
            $messageBody = "Selamat, Kamu telah lolos verifikasi berkas.";
            Mail::send([], [], function ($message) use ($pdf, $messageBody, $fileName) {
                $message->to($this->siswa->user->email)
                    ->subject('Hasil Verifikasi Berkas')
                    ->text($messageBody)
                    ->attachData($pdf->output(), $fileName, [
                        'mime' => 'application/pdf',
                    ]);
            });

            $this->modalOpen = false;
        } elseif ($this->status == 3) {
            $missingDocuments = $this->getMissingDocuments();
            $messageBody = "Maaf, Kamu belum lolos verifikasi berkas karena tidak mengupload berkas: " . implode(', ', $missingDocuments);
            Mail::raw($messageBody, function ($message) {
                $message->to($this->siswa->user->email)
                    ->subject('Hasil Verifikasi Berkas');
            });
            $this->modalOpen = false;
        }

        return redirect(request()->header('Referer'));
    }

    /**
     * Format jadwal tes.
     *
     * @param int $idJadwalTes
     * @return string
     */
    protected function formatJadwalTes($idJadwalTes)
    {
        $jadwalTes = JadwalTes::find($idJadwalTes);
        if ($jadwalTes) {
            $formattedDate = Carbon::parse($jadwalTes->tanggal)->format('Y-m-d');
            return "{$formattedDate} {$jadwalTes->jam_mulai} - {$jadwalTes->jam_selesai} WIB / Ruang {$jadwalTes->ruang}";
        }
        return '';
    }

    /**
     * Get the list of missing documents.
     *
     * @return array
     */
    protected function getMissingDocuments()
    {
        $missingDocuments = [];
        foreach ($this->syarat as $item) {
            if ($item->berkas->where('uploader_id', $this->siswa->id_user)->isEmpty()) {
                $missingDocuments[] = $item->nama_persyaratan;
            }
        }
        return $missingDocuments;
    }

    /**
     * Update status verifikasi pada setiap berkas.
     */
    protected function updateBerkasVerifikasi()
    {
        foreach ($this->syarat as $item) {
            foreach ($item->berkas->where('uploader_id', $this->siswa->id_user) as $berkas) {
                $berkas->verify = $this->verif[$berkas->id] ?? null;
                $berkas->verify_notes = $this->catatan[$berkas->id] ?? null;
                $berkas->save();
            }
        }
    }

    /**
     * Update status registrasi jika nilainya 2, 3, atau 4.
     */
    protected function updateRegistrasiStatus()
    {
        if (in_array($this->status, [2, 3, 4])) {
            $this->siswa->dataRegistrasi->status = $this->status;
            $this->siswa->dataRegistrasi->save();
        }
    }

    /**
     * Proses update atau delete data tes sesuai dengan input sesi.
     */
    protected function processDataTes()
    {
        $previousData = $this->getPreviousDataTes();
        $this->updateDataTes($this->sesi_bq_wawancara, $previousData['bq'], true);
        $this->updateDataTes($this->sesi_japres_tes_akademik, $previousData['japres'], false);
    }

    /**
     * Mengambil sesi tes sebelumnya berdasarkan jenis tes.
     *
     * @return array
     */
    protected function getPreviousDataTes()
    {
        $previousBq = null;
        $previousJapres = null;
        $existingDataTes = DataTes::where('id_registrasi', $this->id_registrasi)->get();

        foreach ($existingDataTes as $dataTes) {
            if (strpos($dataTes->jadwalTes->jenisTes->nama, 'BQ') !== false) {
                $previousBq = $dataTes->id_jadwal_tes;
            } else {
                $previousJapres = $dataTes->id_jadwal_tes;
            }
        }

        return [
            'bq' => $previousBq,
            'japres' => $previousJapres,
        ];
    }

    /**
     * Update atau hapus data tes berdasarkan sesi yang diberikan.
     *
     * @param mixed $sesiTes
     * @param mixed $previousSesi Tes sebelumnya, untuk keperluan decrement jika dihapus.
     * @param bool  $isBq      Menentukan tipe tes (BQ atau Japres).
     */
    protected function updateDataTes($sesiTes, $previousSesi, $isBq)
    {
        // Jika ada sesi tes yang dipilih, gunakan updateOrCreate
        if ($sesiTes) {
            $dataTes = DataTes::updateOrCreate(
                [
                    'id_registrasi' => $this->id_registrasi,
                    'id_jadwal_tes' => $sesiTes,
                ],
                [
                    'id_jadwal_tes' => $sesiTes,
                ]
            );

            if ($dataTes->wasRecentlyCreated) {
                JadwalTes::where('id', $sesiTes)->increment('terisi');
            }
            return;
        }

        // Jika sesi tidak dipilih, hapus data tes terkait
        $operator = $isBq ? 'like' : 'not like';
        $deleted = DataTes::where('id_registrasi', $this->id_registrasi)
            ->whereHas('jadwalTes.jenisTes', function ($query) use ($operator) {
                $query->where('nama', $operator, '%BQ%');
            })->delete();

        if ($deleted > 0 && $previousSesi) {
            JadwalTes::where('id', $previousSesi)->decrement('terisi');
        }
    }

    public function render()
    {
        return view('livewire.operator.verif-berkas');
    }
}
