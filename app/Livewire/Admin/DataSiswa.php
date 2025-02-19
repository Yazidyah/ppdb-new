<?php

namespace App\Livewire\Admin;

use App\Models\CalonSiswa;
use Livewire\Component;

class DataSiswa extends Component
{
    public $siswa;
    public $id;

    public function mount()
    {
        $this->siswa = CalonSiswa::find($this->id);
        // dd($this->id);
    }
    public function render()
    {
        return view('livewire.admin.data-siswa')->layout('layouts.app');
    }
}
