<?php

namespace App\Livewire\Registrasi;

use Livewire\Component;

class StepDua extends Component
{

    public $tab = 1;
    protected $queryString = [
        'tab' => ['except' => 'konsep', 'as' => 't'],
    ];

    public function render()
    {
        return view('livewire.registrasi.step-dua')->layout('layouts.apk');
    }
}
