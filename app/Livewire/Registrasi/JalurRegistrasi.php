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
        $this->siswa = DataRegistrasi::firstOrCreate([
            'id_calon_siswa' => $this->id_siswa,
            'status' => '0'
        ]);
        $this->id_jalur = $this->siswa->jalurRegistrasi->id_jalur ?? '';
        $this->jalurRegistrasi = JalurRegistrasiModel::where('is_open', true)->with('persyaratan')->get();
    }

    public function generateKodeRegistrasi($jalurId, $registrasiId)
    {
        $year = date('y');
        $jalur = str_pad($jalurId, 2, '0', STR_PAD_LEFT);
        $registrasi = str_pad($registrasiId, 4, '0', STR_PAD_LEFT);
        return $year . $jalur . $registrasi;
    }

    public function updateJalur($value)
    {
        $this->siswa->id_jalur = $value;
        $this->siswa->save();

        $kodeRegistrasi = $this->generateKodeRegistrasi($value, $this->siswa->id_calon_siswa);
        $this->siswa->kode_registrasi = $kodeRegistrasi;
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
