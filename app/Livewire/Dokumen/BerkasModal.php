<?php

namespace App\Livewire\Dokumen;

use Illuminate\Support\Facades\Auth;
use App\Models\DataBerkas;
use App\Models\Berkas;
use Livewire\Component;

class BerkasModal extends Component
{
    public $modalSubmit = false;
    public $dataBerkas;
    public $berkas;
    public $dataBerkasId;

    protected $listeners = ['openBerkasModal' => 'openModal'];

    public function openModal()
    {
        $this->modalSubmit = true;
    }

    public function closeModal()
    {
        $this->modalSubmit = false;
        $this->reset(['dataBerkas', 'dataBerkasId']);
    }

    public function mount(Berkas $berkas)
    {
        //mount here
    }
    public function update()
    {
        //update here
    }

    public function render()
    {
        return view('livewire.dokumen.berkas-modal');
    }
}
