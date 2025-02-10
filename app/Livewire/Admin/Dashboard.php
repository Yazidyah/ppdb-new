<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Statistik;

class Dashboard extends Component
{
    public $statistik;

    public function mount()
    {
        $this->statistik = Statistik::all();
    }

    public function render()
    {
        return view('livewire.admin.dashboard')->layout('layouts.app');
    }
}
