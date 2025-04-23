<?php

namespace App\Livewire\Operator;

use Livewire\Component;
use App\Models\JalurRegistrasi;
use Illuminate\Validation\Validator;
use Carbon\Carbon;

class KonfigurasiJalur extends Component
{
    public $nama_jalur, $deskripsi, $tanggal_buka, $tanggal_tutup, $is_open;
    public $jalurId;
    public $isModalOpen = false;
    public $isEdit = false;

    public function render()
    {
        $jalurRegistrasi = JalurRegistrasi::orderBy('id_jalur', 'asc')->get()->map(function ($jalur) {
            $jalur->tanggal_buka = Carbon::parse($jalur->tanggal_buka)->format('d-M-Y');
            $jalur->tanggal_tutup = Carbon::parse($jalur->tanggal_tutup)->format('d-M-Y');
            return $jalur;
        });

        return view('livewire.operator.konfigurasi-jalur', compact('jalurRegistrasi'))->layout('layouts.app');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->isEdit = false;
        $this->openModal();
    }

    public function store()
    {
        $this->validateData();

        JalurRegistrasi::create($this->getInputData());

        session()->flash('success', 'Jalur Registrasi berhasil ditambahkan.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $jalur = JalurRegistrasi::findOrFail($id);
        $this->fillInputFields($jalur);

        $this->isEdit = true;
        $this->openModal();
    }

    public function update()
    {
        $this->validateData();

        $jalur = JalurRegistrasi::findOrFail($this->jalurId);
        $jalur->update($this->getInputData());

        session()->flash('success', 'Jalur Registrasi berhasil diperbarui.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function delete($id)
    {
        $jalur = JalurRegistrasi::findOrFail($id);
        $jalur->delete();

        session()->flash('success', 'Jalur Registrasi berhasil dihapus.');
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    private function resetInputFields()
    {
        $this->nama_jalur = '';
        $this->deskripsi = '';
        $this->tanggal_buka = '';
        $this->tanggal_tutup = '';
        $this->is_open = null;
        $this->jalurId = null;
    }

    private function fillInputFields($jalur)
    {
        $this->jalurId = $jalur->id_jalur;
        $this->nama_jalur = $jalur->nama_jalur;
        $this->deskripsi = $jalur->deskripsi;
        $this->tanggal_buka = $jalur->tanggal_buka;
        $this->tanggal_tutup = $jalur->tanggal_tutup;
        $this->is_open = $jalur->is_open ? '1' : '0';
    }

    private function validateData()
    {
        $this->validate([
            'nama_jalur' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_buka' => 'required|date',
            'tanggal_tutup' => 'required|date|after:tanggal_buka',
            'is_open' => 'required|boolean',
        ],[
            'required' => 'Nilai tidak boleh kosong.',
            'after' => 'Tanggal tutup tidak boleh lebih dari tanggal buka.',
        ]);
    }

    private function getInputData()
    {
        return [
            'nama_jalur' => $this->nama_jalur,
            'deskripsi' => $this->deskripsi,
            'tanggal_buka' => $this->tanggal_buka,
            'tanggal_tutup' => $this->tanggal_tutup,
            'is_open' => $this->is_open,
        ];
    }
}
