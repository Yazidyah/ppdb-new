<?php

namespace App\Livewire\Dokumen;

use Livewire\Component;

class StepTiga extends Component
{
    public $tab = 1;
    public $nama_lengkap;
    protected $queryString = [
        'tab' => ['except' => 'konsep', 'as' => 't'],
    ];

    public function mount() {}
    public function render()
    {
        return view('livewire.dokumen.step-tiga')->layout('layouts.apk');
    }
}
