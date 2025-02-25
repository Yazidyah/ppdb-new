<?php

namespace App\Livewire\Operator;

use Livewire\Component;
use App\Models\JenisTes as JenisTesModel;

class JenisTes extends Component
{
    public $id, $nama, $no_jalur = "";  
    public $isEdit = false;
    public $showModal = false;

    protected $rules = [
        'nama' => 'required|string|max:255',
        'no_jalur' => 'required|in:0,1,2',
    ];

    public function create()
    {
        $this->reset(['id', 'nama', 'no_jalur']);
        $this->isEdit = false;
        $this->showModal = true;
    }

    public function store()
    {
        $this->validate();
        JenisTesModel::create([
            'id' => null, // Auto increment
            'no_jalur' => (string) $this->no_jalur, 
            'nama' => $this->nama,
        ]);

        $this->closeModal();
    }

    public function edit($id)
    {
        $jenis_tes = JenisTesModel::findOrFail($id);

        $this->id = $id;
        $this->nama = $jenis_tes->nama;
        $this->no_jalur = (string) $jenis_tes->no_jalur;
        $this->isEdit = true;
        $this->showModal = true;
    }

    public function Update()
    {
        $this->validate();

        $jenis_tes = JenisTesModel::findOrFail($this->id);

        $jenis_tes->update([
            'no_jalur' => (string) $this->no_jalur, 
            'nama' => $this->nama,
        ]);

        $this->closeModal();
    }

    public function delete($id)
    {
        JenisTesModel::findOrFail($id)->delete();
        session()->flash('success', 'Data berhasil dihapus.');
    }

    public function closeModal()
    {
        $this->reset(['id', 'nama', 'no_jalur']);
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.operator.jenis-tes', [
            'jenisTes' => JenisTesModel::orderBy('id', 'asc')->get(),
        ]);
    }
}
