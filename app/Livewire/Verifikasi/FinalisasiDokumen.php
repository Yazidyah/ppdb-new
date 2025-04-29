<?php

namespace App\Livewire\Verifikasi;

use App\Models\CalonSiswa;
use App\Models\DataRegistrasi;
use App\Models\Persyaratan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FinalisasiDokumen extends Component
{

    public $persyaratan;
    public $user;
    public $id_jalur, $kbs, $id_persyaratan, $berkas;

    public $id_siswa;

    public $syarat;

    public function mount()
    {
        $this->user = Auth::user();
        $this->id_siswa = CalonSiswa::where('id_user', $this->user->id)->pluck('id_calon_siswa');
        $this->id_jalur = DataRegistrasi::where('id_calon_siswa', $this->id_siswa)->value('id_jalur');
        $this->persyaratan = Persyaratan::where('id_jalur', $this->id_jalur)->orderBy('id_persyaratan', 'asc')->get();
        $this->syarat = null;
    }
    public function render()
    {
        return view('livewire.verifikasi.finalisasi-dokumen');
    }
}
