<?php

namespace App\Livewire\Dokumen;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StepTiga extends Component
{
    public $tab = 1;
    public $user;
    public $modalSubmit = false;
    protected $queryString = [
        'tab' => ['except' => 'konsep', 'as' => 't'],
    ];

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function submit()
    {
        return redirect()->to('/siswa/daftar-step-empat?t=1');
    }
    public function render()
    {
        return view('livewire.dokumen.step-tiga')->layout('layouts.apk');
    }
}
