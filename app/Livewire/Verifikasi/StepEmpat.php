<?php

namespace App\Livewire\Verifikasi;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StepEmpat extends Component
{
    public $tab = 1;
    protected $queryString = [
        'tab' => ['except' => 'konsep', 'as' => 't'],
    ];

    public $user;

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        return view('livewire.verifikasi.step-empat')->layout('layouts.apk');
    }
}
