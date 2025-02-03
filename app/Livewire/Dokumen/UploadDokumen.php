<?php

namespace App\Livewire\Dokumen;

use App\Models\KategoriBerkas;
use Livewire\Component;
use App\Models\Persyaratan;
use App\Models\CalonSiswa;
use App\Models\DataRegistrasi;
use Illuminate\Support\Facades\Auth;

class UploadDokumen extends Component
{
    public $persyaratan;

    public $user;

    public $id_jalur, $kbs, $id_persyaratan;

    public function mount()
    {
        $this->user = Auth::user();

        $this->id_jalur = DataRegistrasi::where('id_calon_siswa', $this->user->id)->value('id_jalur');
        $this->persyaratan = Persyaratan::where('id_jalur', $this->id_jalur)->get();
        $this->id_persyaratan = $this->persyaratan->pluck('id_jalur')->first();
        if ($this->id_persyaratan == 1) {
            $this->kbs = KategoriBerkas::where('key', 'persyaratan_satu')->get();
        }
    }

    public function render()
    {
        return view('livewire.dokumen.upload-dokumen', [
            'persyaratan' => $this->persyaratan
        ]);
    }
}
