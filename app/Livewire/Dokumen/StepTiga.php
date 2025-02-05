<?php

namespace App\Livewire\Dokumen;

use Livewire\Component;

class StepTiga extends Component
{
    public $tab = 1;
    protected $queryString = [
        'tab' => ['except' => 'konsep', 'as' => 't'],
    ];

    public function submit()
    {
        return redirect()->to('/siswa/daftar-step-empat?t=1');
    }
    public function render()
    {
        return view('livewire.dokumen.step-tiga')->layout('layouts.apk');
    }
}
