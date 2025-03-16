<?php

namespace App\Livewire\Registrasi;

use Livewire\Component;
use App\Models\CalonSiswa;
use App\Models\DataRegistrasi;
use App\Models\JalurRegistrasi as JalurRegistrasiModel;
use App\Models\Persyaratan;
use Illuminate\Support\Facades\Auth;

class JalurRegistrasi extends Component
{
    public $user;
    public $siswa;
    public $jalurRegistrasi;

    public $id_jalur, $id_siswa;

    public function mount()
    {
        $this->user = Auth::user();
        $this->id_siswa = CalonSiswa::where('id_user', $this->user->id)->first()->id_calon_siswa;
        $this->siswa = DataRegistrasi::updateOrCreate(
            ['id_calon_siswa' => $this->id_siswa],
        );
        $this->id_jalur = $this->siswa->jalurRegistrasi->id_jalur ?? '';
        $this->jalurRegistrasi = JalurRegistrasiModel::where('is_open', true)->with('persyaratan')->get();
    }

    public function generateNomor($jalurId, $registrasiId)
    {
        $year = date('y');
        $nextYear = date('y', strtotime('+1 year'));
        $currentYear = date('Y');
        $registrasi = str_pad($registrasiId, 4, '0', STR_PAD_LEFT);

        if ($jalurId == 1) {
            $kodeRegistrasi = 'R' . $year . $nextYear . $registrasi;
            $nomorSuket = $registrasi . '/Ma.10.60/PPDB-R.2025/06/' . $currentYear;
        } else {
            $kodeRegistrasi = 'A' . $year . $nextYear . $registrasi;
            $nomorSuket = $registrasi . '/Ma.10.60/PPDB.2025/06/' . $currentYear;
        }

        return ['kodeRegistrasi' => $kodeRegistrasi, 'nomorSuket' => $nomorSuket];
    }

    public function updateJalur($value)
    {
        $this->siswa->id_jalur = $value;
        $this->siswa->status = 2;
        $this->siswa->save();

        $kodeData = $this->generateNomor($value, $this->siswa->id_calon_siswa);
        $this->siswa->nomor_peserta = $kodeData['kodeRegistrasi'];
        $this->siswa->nomor_suket = $kodeData['nomorSuket'];
        $this->siswa->save();

        return redirect()->to('/siswa/daftar-step-tiga?t=' . $value);
    }

    public function render()
    {
        return view('livewire.registrasi.jalur-registrasi', [
            'jalurRegistrasi' => $this->jalurRegistrasi
        ]);
    }
}
