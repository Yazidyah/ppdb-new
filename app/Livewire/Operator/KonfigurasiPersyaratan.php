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
    public $accepted_file_types;

    protected $rules = [
        'nama_persyaratan' => 'required|string|max:255',
        'id_jalur' => 'required|array',
        'id_jalur.*' => 'integer|exists:jalur_registrasi,id_jalur',
        'deskripsi' => 'nullable|string',
        'accepted_file_types' => 'required|string|in:jpg/jpeg/png,pdf',
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

    public function getFileType($persyaratanId)
    {
        $persyaratan = Persyaratan::with(['kategoriBerkas' => function($query) {
            $query->select('kategori_berkas.id', 'kategori_berkas.accepted_file_types');
        }])->find($persyaratanId);

        if ($persyaratan && $persyaratan->kategoriBerkas->isNotEmpty()) {
            return $persyaratan->kategoriBerkas->first()->accepted_file_types;
        }

        return null;
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

        $this->persyaratan = $query->orderBy('id_jalur', 'asc')->get()->map(function ($item) {
            $item->file_type = $this->getFileType($item->id_persyaratan);
            return $item;
        });
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
            $this->accepted_file_types = $this->getFileType($this->persyaratanId);
            \Log::debug('openModal - accepted_file_types:', ['accepted_file_types' => $this->accepted_file_types]);
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
        $this->accepted_file_types = '';
    }

    public function store()
    {
        \Log::debug('Storing Persyaratan:', [
            'nama_persyaratan' => $this->nama_persyaratan,
            'id_jalur' => $this->id_jalur,
            'deskripsi' => $this->deskripsi,
            'accepted_file_types' => $this->accepted_file_types,
        ]);

        try {
            $this->validate();
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation Error:', [
                'errors' => $e->errors(),
            ]);
            throw $e;
        }

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
        $this->accepted_file_types = $this->getFileType($this->persyaratanId);
        $this->resetValidation();
        \Log::debug('edit - accepted_file_types:', ['accepted_file_types' => $this->accepted_file_types]);
        $this->openModal(true);
    }

    public function update()
    {
        \Log::debug('Updating Persyaratan:', [
            'nama_persyaratan' => $this->nama_persyaratan,
            'id_jalur' => $this->id_jalur,
            'deskripsi' => $this->deskripsi,
            'accepted_file_types' => $this->accepted_file_types,
        ]);

        try {
            $this->validatePersyaratan();
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation Error:', [
                'errors' => $e->errors(),
            ]);
            throw $e;
        }

        $this->savePersyaratan(true);
        session()->flash('success', 'Persyaratan dan Kategori Berkas berhasil diperbarui.');
        $this->closeModal();
    }

    public function delete($id)
    {
        $persyaratan = Persyaratan::findOrFail($id);
        $namaPersyaratan = $persyaratan->nama_persyaratan;
        $jalur = $persyaratan->jalurRegistrasi->nama_jalur;

        $kategoriBerkas = KategoriBerkas::where('id', $persyaratan->id_kategori_berkas)
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
        try {
            $this->validate([
                'nama_persyaratan' => 'required|string|max:255',
                'id_jalur' => 'required|array',
                'id_jalur.*' => 'integer|exists:jalur_registrasi,id_jalur',
                'deskripsi' => 'nullable|string',
                'accepted_file_types' => 'required|string|in:jpg/jpeg/png,pdf',
            ], [
                'required' => 'Nilai tidak boleh kosong.',
                'exists' => 'Jalur yang dipilih tidak valid.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation Error:', [
                'errors' => $e->errors(),
            ]);
            throw $e;
        }
    }

    private function savePersyaratan($isUpdate = false)
    {
        $persyaratanData = [
            'nama_persyaratan' => $this->nama_persyaratan,
            'id_jalur' => $this->id_jalur[0],
            'deskripsi' => $this->deskripsi,
            'accepted_file_types' => $this->accepted_file_types,
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
                $persyaratan = Persyaratan::create($persyaratanData);
                $this->createKategoriBerkas($persyaratan, $idJalur);
            }
        }
    }

    private function createKategoriBerkas($persyaratan, $idJalur)
    {
        $jalur = JalurRegistrasi::find($idJalur);
        $slug = 'jalur_' . Str::slug($jalur->nama_jalur, '_');
        $kategoriBerkas = KategoriBerkas::create([
            'key' => $slug,
            'nama' => $this->nama_persyaratan,
            'folder_name' => "pendaftaran/persyaratan",
            'accepted_file_types' => $this->accepted_file_types,
            'max_file_size' => "300",
            'is_multiple' => false,
            'disk' => "local",
        ]);
        $persyaratan->kategoriBerkas()->attach($kategoriBerkas->id);
    }

    private function updateKategoriBerkas($oldNamaPersyaratan, $oldJalur)
    {
        $jalur = JalurRegistrasi::find($this->id_jalur[0]);
        $newKey = 'jalur_' . Str::slug(strtolower($jalur->nama_jalur), '_');
        $kategoriBerkas = KategoriBerkas::where('key', 'jalur_' . Str::slug(strtolower($oldJalur), '_'))
            ->where('nama', $oldNamaPersyaratan)
            ->first();
        if ($kategoriBerkas) {
            $kategoriBerkas->update([
                'nama' => $this->nama_persyaratan,
                'key' => $newKey,
                'accepted_file_types' => $this->accepted_file_types,
            ]);
            $persyaratan = Persyaratan::findOrFail($this->persyaratanId);
            $persyaratan->kategoriBerkas()->sync([$kategoriBerkas->id]);
        }
    }

    public function render()
    {
        return view('livewire.operator.konfigurasi-persyaratan')->layout('layouts.app');
    }
}
