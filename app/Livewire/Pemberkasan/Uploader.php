<?php

namespace App\Livewire\Pemberkasan;

use App\Models\Berkas;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Uploader extends Component
{
    public $model;
    public $kategori;
    public $uploaded;
    public $editable = true;

    use WithFileUploads;

    public $berkas;
    public $view;
    public $isAdmin = false;
    public $canUpload = true;
    public $listeners = ['berkas-updated' => 'mount', 'berkasUploaded' => 'mount'];

    public function mount()
    {
        $this->model->refresh();
        $this->determineCanUpload();
    }

    public function determineCanUpload()
    {
        $this->canUpload = true;

        if (empty($this->model->berkas) || $this->model->berkas->isEmpty()) {
            if (!$this->editable) {
                $this->canUpload = false;
            }
            return;
        }

        $this->uploaded = @$this->model?->berkas?->where('kategori_berkas_id', $this->kategori->id) ?? null;
        if (empty($this->uploaded)) {
            $this->uploaded = collect();
        }

        if ($this->editable == false) {
            $this->canUpload = false;
            return;
        }

        if ($this->uploaded->count()) {
            $this->canUpload = false;

            if ($this->uploaded->last()->verify == -1) {
                $this->canUpload = true;
            }
        }
    }
    public function updatedBerkas()
    {
        try {
            $this->validate([
                'berkas' => 'required|file|max:51200',
            ]);
            $this->simpan();
        } catch (\Exception $e) {
            \Log::info('terlalu besar');
        }
    }

    public function simpan()
    {
        \Log::info('Uploading berkas: ' . $this->berkas->getClientOriginalName());

        $path = $this->berkas->store($this->kategori->folder_name, $this->kategori->disk);

        \Log::info('File stored at path: ' . $path);

        $berkas = new Berkas([
            'kategori_berkas_id' => $this->kategori->id,
            'original_name' => $this->berkas->getClientOriginalName(),
            'file_name' => $path,
            'uploader_id' => Auth::user()->id,
            'disk' => $this->kategori->disk
        ]);

        $this->model->berkas()->save($berkas);
        $this->mount();
        $this->berkas = null;
        $this->dispatch('berkasUploaded', $this->kategori->id);
    }
    public function render()
    {
        return view('livewire.pemberkasan.uploader');
    }
}
