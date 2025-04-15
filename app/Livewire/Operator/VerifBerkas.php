<?php

namespace App\Livewire\Operator;

use Livewire\Component;
use App\Models\JadwalTes;
use App\Models\DataTes;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Jobs\SendVerificationEmail;
use Illuminate\Support\Facades\File;

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

    public $urlPasFoto;

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
                if ($this->jalur->id_jalur == 1) {
                    $query->where('no_jalur', 1)
                        ->where('nama', $operator, '%BQ%');
                } else {
                    $query->where('no_jalur', '!=', 1)
                        ->where('nama', $operator, '%BQ%');
                }
            }
        })->get()->map(function ($jadwal) {
            $formattedDate = Carbon::parse($jadwal->tanggal)->format('d-m-Y');
            return [
                'id' => $jadwal->id,
                'label' => "{$jadwal->id}) Tgl {$formattedDate} - Ruang {$jadwal->ruang} - Jam {$jadwal->jam_mulai} - {$jadwal->jam_selesai} ({$jadwal->terisi}/{$jadwal->kuota})",
            ];
        })->sortBy('id');
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
        if ($this->status == 4) {
            $this->buttonColor = 'bg-red-500 hover:bg-red-700';
        } elseif ($this->status >= 5) {
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
        $iconTemplate = '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mx-auto" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">';

        if ($this->status == 4) {
            $this->buttonIcon = $iconTemplate . '<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>';
        } elseif ($this->status >= 5) {
            $this->buttonIcon = $iconTemplate . '<path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>';
        } else {
            $this->buttonIcon = $iconTemplate . '<path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>';
        }
    }

    public function cekBerkasPasFoto()
    {
        $berkases = $this->siswa->user->berkas;
        foreach ($berkases as $berkas) {
            if ($berkas->persyaratan->nama_persyaratan == 'Pas Foto') {
                $encodedPath = base64_encode($berkas->file_name);
                // $this->urlPasFoto = route('local.temp', ['path' => $encodedPath]);
                $this->urlPasFoto = $berkas->file_name;
            }
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
        $this->cekBerkasPasFoto();

        if ($this->sesi_bq_wawancara != null) {
            $jadwalBqWawancara = $this->formatJadwalTes($this->sesi_bq_wawancara);
        }
        if ($this->sesi_japres_tes_akademik != null) {
            $jadwalJapresTesAkademik = $this->formatJadwalTes($this->sesi_japres_tes_akademik);
        }

        // Generate QR code and save to public\qrcode
        $qrCodeDirectory = public_path('qrcode');
        if (!File::exists($qrCodeDirectory)) {
            File::makeDirectory($qrCodeDirectory, 0755, true);
        }

        $qrCodePath = $qrCodeDirectory . '/' . $this->siswa->dataRegistrasi->nomor_peserta . '.png';
        $qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . urlencode($this->siswa->dataRegistrasi->nomor_peserta);
        file_put_contents($qrCodePath, file_get_contents($qrCodeUrl));

        // Dispatch the email job
        SendVerificationEmail::dispatch(
            $this->siswa,
            $this->status,
            $this->urlPasFoto,
            $this->syarat,
            @$jadwalBqWawancara,
            @$jadwalJapresTesAkademik
        );

        $this->modalOpen = false;

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
            $formattedDate = Carbon::parse($jadwalTes->tanggal)->format('d-m-Y');
            return "{$formattedDate} {$jadwalTes->jam_mulai} - {$jadwalTes->jam_selesai} WIB / Ruang {$jadwalTes->ruang}";
        }
        return '';
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
     * Update status registrasi jika nilainya 3, 4, atau 5.
     */
    protected function updateRegistrasiStatus()
    {
        if (in_array($this->status, [3, 4, 5])) {
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
     * Update or delete test data based on the given session.
     *
     * @param mixed $sessionTest
     * @param mixed $previousSession Previous session for decrement purposes if deleted.
     * @param bool  $isBq           Determines the test type (BQ or Japres).
     */
    protected function updateDataTes($sessionTest, $previousSession, $isBq)
    {
        if (empty($sessionTest)) {
            $this->deleteTestData($isBq, $previousSession);
            return;
        }

        $this->saveOrUpdateTestData($sessionTest, $isBq);
        $this->updateJadwalTesTerisi($sessionTest);
    }

    /**
     * Delete test data and decrement the filled count if necessary.
     *
     * @param bool  $isBq
     * @param mixed $previousSession
     */
    protected function deleteTestData($isBq, $previousSession)
    {
        $operator = $isBq ? 'like' : 'not like';
        $deleted = DataTes::where('id_registrasi', $this->id_registrasi)
            ->whereHas('jadwalTes.jenisTes', function ($query) use ($operator) {
                $query->where('nama', $operator, '%BQ%');
            })->delete();

        if ($deleted > 0 && $previousSession) {
            JadwalTes::where('id', $previousSession)->decrement('terisi');
        }
    }

    /**
     * Save or update test data based on the session.
     *
     * @param mixed $sessionTest
     * @param bool  $isBq
     */
    protected function saveOrUpdateTestData($sessionTest, $isBq)
    {
        $operator = $isBq ? 'like' : 'not like';
        $existingDataTes = DataTes::where('id_registrasi', $this->id_registrasi)
            ->whereHas('jadwalTes.jenisTes', function ($query) use ($operator) {
                $query->where('nama', $operator, '%BQ%');
            })->first();

        if ($existingDataTes) {
            $existingDataTes->update(['id_jadwal_tes' => $sessionTest]);
        } else {
            DataTes::create([
                'id_registrasi' => $this->id_registrasi,
                'id_jadwal_tes' => $sessionTest,
            ]);
        }
    }

    /**
     * Update the filled count for all test schedules.
     *
     * @param int $sessionTest
     */
    protected function updateJadwalTesTerisi($sessionTest)
    {
        $jadwalTesData = JadwalTes::leftJoin('data_tes', 'jadwal_tes.id', '=', 'data_tes.id_jadwal_tes')
            ->selectRaw('jadwal_tes.id, COUNT(data_tes.id_jadwal_tes) AS total')
            ->groupBy('jadwal_tes.id')
            ->get();

        foreach ($jadwalTesData as $data) {
            JadwalTes::where('id', $data->id)->update(['terisi' => $data->total]);
        }
    }

    public function render()
    {
        return view('livewire.operator.verif-berkas');
    }
}
