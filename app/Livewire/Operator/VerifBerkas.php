<?php

namespace App\Livewire\Operator;

use Livewire\Component;
use App\Models\JadwalTes;
use App\Models\DataTes;
use Carbon\Carbon;

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
    // Meskipun variabel "jalur" tidak dideklarasikan sebelumnya, 
    // clean code mengharuskan deklarasi jika digunakan di seluruh class.
    protected $jalur;

    public function mount()
    {
        $this->initializeData();
        $this->jadwalTesBqWawancara = $this->getJadwalTes(true);
        $this->jadwalTesJapresTesAkademik = $this->getJadwalTes(false);
        $this->setExistingDataTes();
    }

    /**
     * Inisialisasi data awal dari dataRegistrasi.
     */
    protected function initializeData()
    {
        $dataRegistrasi = $this->siswa->dataRegistrasi;
        $this->syarat   = $dataRegistrasi->syarat;
        $this->status   = $dataRegistrasi->status;
        $this->jalur    = $dataRegistrasi->jalur;
        $this->id_registrasi = $dataRegistrasi->id_registrasi;
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
            $query->where('no_jalur', $this->jalur->id_jalur)
                  ->where('nama', $operator, '%BQ%');
        })->get()->map(function ($jadwal) {
            $formattedDate = Carbon::parse($jadwal->tanggal)->format('d-m-Y');
            return [
                'id'    => $jadwal->id,
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
     * Proses penyimpanan verifikasi berkas dan pengaturan data tes.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function simpan()
    {
        $this->updateBerkasVerifikasi();
        $this->updateRegistrasiStatus();
        $this->processDataTes();

        $this->modalOpen = false;
        return redirect(request()->header('Referer'));
    }

    /**
     * Update status verifikasi pada setiap berkas.
     */
    protected function updateBerkasVerifikasi()
    {
        foreach ($this->syarat as $item) {
            foreach ($item->berkas->where('uploader_id', $this->siswa->id_user) as $berkas) {
                $berkas->verify       = $this->verif[$berkas->id] ?? null;
                $berkas->verify_notes = $this->catatan[$berkas->id] ?? null;
                $berkas->save();
            }
        }
    }

    /**
     * Update status registrasi jika nilainya 3 atau 4.
     */
    protected function updateRegistrasiStatus()
    {
        if (in_array($this->status, [3, 4])) {
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
            'bq'    => $previousBq,
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