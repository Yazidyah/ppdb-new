<?php

namespace App\Livewire\Dokumen;

use App\Models\DataBerkas;
use Livewire\Component;

class BerkasModal extends Component
{
    public $modalSubmit = false;
    public $dataBerkas;
    public $dataBerkasId;

    protected $listeners = ['openBerkasModal' => 'openModal'];

    public function openModal($dataBerkasId = null)
    {
        $this->modalSubmit = true;
        if ($dataBerkasId) {
            $this->dataBerkasId = $dataBerkasId;
            $this->dataBerkas = DataBerkas::find($dataBerkasId);
        }
    }

    public function closeModal()
    {
        $this->modalSubmit = false;
        $this->reset(['dataBerkas', 'dataBerkasId']);
    }

    public function mount()
    {
        $this->dataBerkas = new DataBerkas();
    }

    public function update()
    {
        $this->validate([
            'dataBerkas.data_berkas' => 'required|string',
        ]);

        if ($this->dataBerkasId) {
            $this->dataBerkas->save();
        } else {
            DataBerkas::create($this->dataBerkas->toArray());
        }

        $this->closeModal();
        $this->emit('berkasUpdated');
    }

    public function render()
    {
        return view('livewire.dokumen.berkas-modal');
    }
}
