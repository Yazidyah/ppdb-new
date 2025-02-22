<?php

namespace App\Livewire\Operator;

use Livewire\Component;
use App\Models\JenisTes as JenisTesModel;
use App\Models\JalurRegistrasi;

class JenisTes extends Component
{
    public $id_jenis_tes, $nama, $id_jalur; 
    public $jalur_registrasi;
    public $isEdit = false;
    public $showModal = false;

    protected $rules = [
        'nama' => 'required|string|max:255',
        'id_jalur' => 'required|exists:jalur_registrasi,id_jalur',
    ];

    public function mount()
    {
        $this->jalur_registrasi = JalurRegistrasi::all();
    }

    public function create()
    {
        $this->resetExcept(['jalur_registrasi']);
        $this->isEdit = false;
        $this->showModal = true;
    }

    public function store()
    {
        $this->validate();
        
        JenisTesModel::create([
            'nama' => $this->nama,
            'id_jalur' => (string) $this->id_jalur,
        ]);

        $this->closeModal();
    }

    public function edit($id)
    {
        $jenis_tes = JenisTesModel::find($id);

        if (!$jenis_tes) {
            session()->flash('error', 'Data tidak ditemukan.');
            return;
        }

        $this->resetErrorBag();
        $this->resetValidation();

        $this->id_jenis_tes = $id;
        $this->nama = $jenis_tes->nama;
        $this->id_jalur = $jenis_tes->id_jalur;
        $this->isEdit = true;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();

        $jenis_tes = JenisTesModel::find($this->id_jenis_tes);
        
        if (!$jenis_tes) {
            session()->flash('error', 'Data tidak ditemukan.');
            return;
        }

        $jenis_tes->update([
            'nama' => $this->nama,
            'id_jalur' => (string) $this->id_jalur,
        ]);

        $this->closeModal();
    }

    public function delete($id)
    {
        $jenis_tes = JenisTesModel::find($id);

        if (!$jenis_tes) {
            session()->flash('error', 'Data tidak ditemukan.');
            return;
        }

        $jenis_tes->delete();
        session()->flash('success', 'Data berhasil dihapus.');
    }

    public function closeModal()
    {
        $this->resetExcept(['jalur_registrasi']);
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.operator.jenis-tes', [
            'jenisTes' => JenisTesModel::latest()->get(),
        ]);
    }
}