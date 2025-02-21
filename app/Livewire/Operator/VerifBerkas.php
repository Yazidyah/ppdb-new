<?php

namespace App\Livewire\Operator;

use Livewire\Component;

class VerifBerkas extends Component
{

    public $modalOpen = false;
    public $siswa;
    public $berkas;

    public $syarat;

    public $catatan = [];
    public $verif = [];

    public $preview = false;


    public function mount()
    {
        $this->syarat = $this->siswa->dataRegistrasi->syarat;
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

        $this->modalOpen = false;
    }



    public function render()
    {
        return view('livewire.operator.verif-berkas');
    }
}
