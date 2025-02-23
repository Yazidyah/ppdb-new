<?php

namespace App\Livewire\Operator;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Persyaratan;
use App\Models\JalurRegistrasi;
use Illuminate\Support\Facades\Log;

class KonfigurasiPersyaratan extends Component
{
    public $showModal = false;
    public $isEdit = false;
    public $nama_persyaratan;
    public $id_jalur = [];
    public $deskripsi;
    public $jalurRegistrasi;
    public $persyaratanId;
    public $persyaratan;
    public $filterJalur;

    protected $rules = [
        'nama_persyaratan' => 'required|string|max:255',
        'id_jalur' => 'required|array',
        'id_jalur.*' => 'integer|exists:jalur_registrasi,id_jalur',
        'deskripsi' => 'nullable|string',
    ];

    public function mount(Request $request)
    {
        $this->jalurRegistrasi = JalurRegistrasi::all();
        $filterJalurName = $request->query('filter_jalur', 'Semua%20Jalur');
        $this->filterJalur = $filterJalurName === 'Semua%20Jalur' ? '' : $filterJalurName;
        $this->filter();
    }

    public function getJalurIdByName($namaJalur)
    {
        $jalur = JalurRegistrasi::where('nama_jalur', $namaJalur)->first();
        return $jalur ? $jalur->id_jalur : null;
    }

    public function filter()
    {
        $query = Persyaratan::query();

        if ($this->filterJalur) {
            $idJalur = $this->getJalurIdByName($this->filterJalur);
            if ($idJalur) {
                $query->where('id_jalur', $idJalur);
            }
        }

        $this->persyaratan = $query->orderBy('id_jalur', 'asc')->get();
    }

    public function updatedFilterJalur()
    {
        $this->filter();
        $this->emit('filterUpdated', $this->filterJalur);
    }

    public function openModal($isEdit = false)
    {
        $this->resetValidation();
        $this->resetForm();
        $this->isEdit = $isEdit;
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function resetForm()
    {
        $this->nama_persyaratan = '';
        $this->id_jalur = [];
        $this->deskripsi = '';
    }

    public function store()
    {
        $this->validate();

        foreach (array_unique($this->id_jalur) as $idJalur) {
            Persyaratan::create([
                'nama_persyaratan' => $this->nama_persyaratan,
                'id_jalur' => $idJalur,
                'deskripsi' => $this->deskripsi
            ]);
        }

        session()->flash('success', 'Persyaratan berhasil ditambahkan.');

        $this->closeModal();

        return redirect()->to(url()->previous());
    }

    public function edit($id)
    {
        $this->isEdit = true;
        $persyaratan = Persyaratan::findOrFail($id);
        $this->persyaratanId = $id;
        $this->nama_persyaratan = $persyaratan->nama_persyaratan;
        $this->id_jalur = is_array($persyaratan->id_jalur) ? $persyaratan->id_jalur : [$persyaratan->id_jalur];
        $this->deskripsi = $persyaratan->deskripsi;
        $this->resetValidation();
        // Log the variables for debugging
        \Log::debug('Edit Data:', [
            'persyaratanId' => $this->persyaratanId,
            'nama_persyaratan' => $this->nama_persyaratan,
            'id_jalur' => $this->id_jalur,
            'id_jalur_0' => $this->id_jalur[0] ?? null, // Pastikan elemen pertama ada
            'deskripsi' => $this->deskripsi,
        ]);

        $this->openModal(true);
    }

    public function update()
    {
        $this->validatePersyaratan();

        $persyaratan = Persyaratan::findOrFail($this->persyaratanId);
        $persyaratan->update([
            'nama_persyaratan' => $this->nama_persyaratan,
            'id_jalur' => $this->id_jalur[0], 
            'deskripsi' => $this->deskripsi
        ]);

        session()->flash('success', 'Persyaratan berhasil diperbarui.');
        $this->closeModal();
    }

    public function delete($id)
    {
        $persyaratan = Persyaratan::findOrFail($id);
        $persyaratan->delete();

        session()->flash('success', 'Persyaratan berhasil dihapus.');
    }

    public function validatePersyaratan()
    {
        $this->validate([
            'nama_persyaratan' => 'required|string|max:255',
            'id_jalur' => 'required|array',
            'id_jalur.*' => 'integer|exists:jalur_registrasi,id_jalur',
            'deskripsi' => 'nullable|string',
        ], [
            'required' => 'Nilai tidak boleh kosong.',
            'exists' => 'Jalur yang dipilih tidak valid.',
        ]);
    }

    public function render()
    {
        return view('livewire.operator.konfigurasi-persyaratan')->layout('layouts.app');
    }
}
