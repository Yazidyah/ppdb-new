<?php

namespace App\Livewire\Operator;

use App\Models\KategoriBerkas;
use App\Models\Persyaratan;
use Livewire\Component;

class TabBerkasSiswa extends Component
{
    public $siswa;

    public $kbs;

    public $persyaratan;

    public function mount()
    {
        $this->persyaratan = Persyaratan::where('id_jalur', $this->siswa->DataRegistrasi->id_jalur)->get();
        $this->setKategoriBerkas($this->siswa->DataRegistrasi->id_jalur);
    }

    public function setKategoriBerkas($id)
    {
        if ($id == 1) {
            $this->kbs = KategoriBerkas::where('key', 'jalur_reguler')->get();
        }
    }

    public function render()
    {
        return view('livewire.operator.tab-berkas-siswa');
    }
}
