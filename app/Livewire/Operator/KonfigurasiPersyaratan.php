<?php

namespace App\Livewire\Operator;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Persyaratan;
use App\Models\JalurRegistrasi;
use Illuminate\Support\Facades\Log;
use App\Models\KategoriBerkas;
use Illuminate\Support\Str;

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
        if ($isEdit) {
            $persyaratan = Persyaratan::findOrFail($this->persyaratanId);
            $this->nama_persyaratan = $persyaratan->nama_persyaratan;
            $this->id_jalur = is_array($persyaratan->id_jalur) ? $persyaratan->id_jalur : [$persyaratan->id_jalur];
            $this->deskripsi = $persyaratan->deskripsi;
        }
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
        $this->savePersyaratan();
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
        \Log::debug('Edit Data:', [
            'persyaratanId' => $this->persyaratanId,
            'nama_persyaratan' => $this->nama_persyaratan,
            'id_jalur' => $this->id_jalur,
            'id_jalur_0' => $this->id_jalur[0] ?? null,
            'deskripsi' => $this->deskripsi,
        ]);
        $this->openModal(true);
    }

    public function update()
    {
        $this->validatePersyaratan();
        $this->savePersyaratan(true);
        session()->flash('success', 'Persyaratan dan Kategori Berkas berhasil diperbarui.');
        $this->closeModal();
    }

    public function delete($id)
    {
        $persyaratan = Persyaratan::findOrFail($id);
        $namaPersyaratan = $persyaratan->nama_persyaratan;
        $jalur = $persyaratan->jalurRegistrasi->nama_jalur;

        $kategoriBerkas = KategoriBerkas::where('key', 'jalur_' . Str::slug($jalur, '_'))
            ->where('nama', $namaPersyaratan)
            ->first();
        if ($kategoriBerkas) {
            $kategoriBerkas->delete();
        }

        $persyaratan->delete();

        session()->flash('success', 'Persyaratan dan Kategori Berkas berhasil dihapus.');
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

    private function savePersyaratan($isUpdate = false)
    {
        $persyaratanData = [
            'nama_persyaratan' => $this->nama_persyaratan,
            'id_jalur' => $this->id_jalur[0],
            'deskripsi' => $this->deskripsi
        ];

        if ($isUpdate) {
            $persyaratan = Persyaratan::findOrFail($this->persyaratanId);
            $oldNamaPersyaratan = $persyaratan->nama_persyaratan;
            $oldJalur = $persyaratan->jalurRegistrasi->nama_jalur;
            $persyaratan->update($persyaratanData);
            $this->updateKategoriBerkas($oldNamaPersyaratan, $oldJalur);
        } else {
            foreach (array_unique($this->id_jalur) as $idJalur) {
                $persyaratanData['id_jalur'] = $idJalur;
                Persyaratan::create($persyaratanData);
                $this->createKategoriBerkas($idJalur);
            }
        }
    }

    private function createKategoriBerkas($idJalur)
    {
        $jalur = JalurRegistrasi::find($idJalur);
        $slug = 'jalur_' . Str::slug($jalur->nama_jalur, '_');
        KategoriBerkas::create([
            'key' => $slug,
            'nama' => $this->nama_persyaratan,
            'folder_name' => "pendaftaran/persyaratan",
            'accepted_file_types' => "pdf",
            'max_file_size' => "2000",
            'is_multiple' => false,
            'disk' => "local",
        ]);
    }

    private function updateKategoriBerkas($oldNamaPersyaratan, $oldJalur)
    {
        $jalur = JalurRegistrasi::find($this->id_jalur[0]);
        $slug = 'jalur_' . Str::slug($jalur->nama_jalur, '_');
        $kategoriBerkas = KategoriBerkas::where('key', 'jalur_' . Str::slug($oldJalur, '_'))
            ->where('nama', $oldNamaPersyaratan)
            ->first();
        if ($kategoriBerkas) {
            $kategoriBerkas->update([
                'key' => $slug,
                'nama' => $this->nama_persyaratan,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.operator.konfigurasi-persyaratan')->layout('layouts.app');
    }
}
