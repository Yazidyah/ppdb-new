<?php

namespace App\Livewire\Operator;

use App\Models\Berkas;
use Livewire\Component;

class BerkasVerif extends Component
{
    public Berkas $berkas;
    public  $syarat;
    public $preview = false;
    public $url;
    public $editable = true;


    public function mount() {}
    public function updatedPreview()
    {
        $encodedPath = base64_encode($this->berkas->file_name);

        $this->url = route('local.temp', ['path' => $encodedPath]);
    }

    public function render()
    {
        return view('livewire.operator.berkas-verif');
    }
}
