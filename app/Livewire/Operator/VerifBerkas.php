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
    public $status;


    public function mount()
    {
        $this->syarat = $this->siswa->dataRegistrasi->syarat;
        $this->status = $this->siswa->dataRegistrasi->status;
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
