<?php

namespace App\Livewire\Operator;

use Livewire\Component;
use App\Models\CalonSiswa;

class DatasiswaModal extends Component
{
    public $tab = 'detail';
    public $siswa;
    public $id;
    public $modalOpen = false;

    public function openModal()
    {
        $this->modalOpen = true;
    }

    public function closeModal()
    {
        $this->modalOpen = false;
    }
    
    public function render()
    {
        return view('livewire.operator.datasiswa-modal', [
            'modalOpen' => $this->modalOpen,
        ])->layout('layouts.app');
    }
}
