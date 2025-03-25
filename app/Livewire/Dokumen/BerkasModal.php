<?php

namespace App\Livewire\Dokumen;

use App\Models\Berkas;
use App\Models\Persyaratan;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class BerkasModal extends Component
{
    public $id;
    public $modalSubmit = false;
    public $berkasId;
    public $data_berkas;
    public $isian_berkas;
    public $syarat;
    protected $listeners = ['openBerkasModal' => 'openModal'];

    public function openModal($id)
    {
        $this->berkasId = $id;
        $this->data_berkas = Berkas::find($id);
        $this->modalSubmit = true;
        $this->syarat = Persyaratan::find($this->data_berkas->id_syarat);
        $this->isian_berkas = $this->data_berkas->data_berkas;
    }

    public function simpan()
    {
        $this->validate([
            'isian_berkas' => 'required|string',
        ]);

        if ( $this->data_berkas) {
            $this->data_berkas->data_berkas = $this->isian_berkas;
            $this->data_berkas->save();
            Log::debug('Berkas berhasil disimpan.', ['id' => $this->berkasId]);
        } else {
            Log::error('Berkas ID tidak ditemukan saat simpan.', ['id' => $this->berkasId]);
        }
        $this->closeModal();
    }

    public function closeModal()
    {
        $this->modalSubmit = false;
        $this->reset();
    }

    public function render()
    {
        return view('livewire.dokumen.berkas-modal');
    }
}
