<?php

namespace App\Livewire\Siswa;

use App\Models\CalonSiswa;
use Livewire\Component;

class StepSatu extends Component
{
    public $tab = 1;
    public $nama_lengkap;
    protected $queryString = [
        'tab' => ['except' => 'konsep', 'as' => 't'],
    ];

    public function mount() {}

    public function render()
    {
        return view('livewire.siswa.step-satu')->layout('layouts.apk');
    }
}
