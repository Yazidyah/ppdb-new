<?php

namespace App\Livewire\Operator;

use App\Models\OrangTua;
use Livewire\Component;

class TabOrtuSiswa extends Component
{
    public $siswa;
    public $orangTua;
    public function mount()
    {
        $this->orangTua = $this->siswa->ortu;
    }



    public function render()
    {
        return view('livewire.operator.tab-ortu-siswa');
    }
}
