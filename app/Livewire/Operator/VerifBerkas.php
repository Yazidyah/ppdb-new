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

    public $url;

    public $preview = false;


    public function mount()
    {
        $this->syarat = $this->siswa->dataRegistrasi->syarat;
    }

    public function simpan()
    {
        foreach ($this->syarat as $item) {
            foreach ($item->berkas->where('uploader_id', $this->siswa->id_user) as $berkas) {
                $berkas->verify = $this->verif[$berkas->id];
                $berkas->verify_notes = $this->catatan[$berkas->id];
                $berkas->save();
            }
        }

        $this->modalOpen = false;
    }

    public function updatedPreview()
    {
        foreach ($this->syarat as $item) {
            foreach ($item->berkas->where('uploader_id', $this->siswa->id_user) as $berkas) {
                $this->berkas = $berkas;
                $encodedPath = base64_encode($this->berkas->file_name);

                $this->url = route('local.temp', ['path' => $encodedPath]);
            }
        }
    }


    public function render()
    {
        return view('livewire.operator.verif-berkas');
    }
}
