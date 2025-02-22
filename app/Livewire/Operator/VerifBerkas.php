<?php

namespace App\Livewire\Operator;

use Livewire\Component;
use Illuminate\Support\Facades\Log;
use App\Models\JadwalTes;
use App\Models\JenisTes;

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

    public function mount()
    {
        $this->syarat = $this->siswa->dataRegistrasi->syarat;
        $this->status = $this->siswa->dataRegistrasi->status;
        $this->jalur = $this->siswa->dataRegistrasi->jalur;

        $this->jadwalTesBqWawancara = $this->getJadwalTesBqWawancara();
        $this->jadwalTesJapresTesAkademik = $this->getJadwalTesJapresTesAkademik();

        Log::info('Modal opened for verification', ['siswa_id' => $this->siswa->id_calon_siswa, 'jalur' => $this->jalur->nama_jalur]);
    }

    public function getJadwalTesBqWawancara()
    {
        return JadwalTes::whereHas('jenisTes', function ($query) {
            $query->where('no_jalur', $this->jalur->id_jalur)
                  ->where('nama', 'like', '%BQ%');
        })->get()->map(function ($jadwal) {
            $formattedDate = \Carbon\Carbon::parse($jadwal->tanggal)->format('d-m-Y');
            return [
                'id' => $jadwal->id,
                'label' => "{$jadwal->id}) Tgl {$formattedDate} - Ruang {$jadwal->ruang} - Jam {$jadwal->jam_mulai} - {$jadwal->jam_selesai} ({$jadwal->kuota})"
            ];
        });
    }

    public function getJadwalTesJapresTesAkademik()
    {
        return JadwalTes::whereHas('jenisTes', function ($query) {
            $query->where('no_jalur', $this->jalur->id_jalur)
                  ->where('nama', 'not like', '%BQ%');
        })->get()->map(function ($jadwal) {
            $formattedDate = \Carbon\Carbon::parse($jadwal->tanggal)->format('d-m-Y');
            return [
                'id' => $jadwal->id,
                'label' => "{$jadwal->id}) Tgl {$formattedDate} - Ruang {$jadwal->ruang} - Jam {$jadwal->jam_mulai} - {$jadwal->jam_selesai} ({$jadwal->kuota})"
            ];
        });
    }

    public function simpan()
    {
        foreach ($this->syarat as $item) {
            foreach ($item->berkas->where('uploader_id', $this->siswa->id_user) as $berkas) {
                $berkas->verify = $this->verif[$berkas->id] ?? null;
                $berkas->verify_notes = $this->catatan[$berkas->id] ?? null;
                $berkas->save();
            }
        }

        if ($this->status == 3 || $this->status == 4) {
            $this->siswa->dataRegistrasi->status = $this->status;
            $this->siswa->dataRegistrasi->save();
        }

        $this->modalOpen = false;
        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.operator.verif-berkas');
    }
}
