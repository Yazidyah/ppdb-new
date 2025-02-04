<?php

namespace App\Livewire\Dokumen;

use App\Models\Berkas;
use App\Models\KategoriBerkas;
use Livewire\Component;
use App\Models\Persyaratan;
use App\Models\CalonSiswa;
use App\Models\DataRegistrasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;

class UploadDokumen extends Component
{
    use WithFileUploads;

    public $persyaratan;
    public $user;
    public $id_jalur, $kbs, $id_persyaratan, $berkas;

    public $syarat;

    public function mount()
    {
        $this->user = Auth::user();
        $this->id_jalur = DataRegistrasi::where('id_calon_siswa', $this->user->id)->value('id_jalur');
        $this->persyaratan = Persyaratan::where('id_jalur', $this->id_jalur)->get();
        $this->syarat = null;
    }

    public function updatedBerkas()
    {
        try {
            $this->validate([
                'berkas' => 'required|file|max:51200', // Maksimal 50MB
            ]);
            $this->simpan();
        } catch (\Exception $e) {
            \Log::info('terlalu besar');
        }
    }

    public function setSyarat($id)
    {
        $this->syarat = Persyaratan::find($id);
    }

    public function simpan()
    {
        if ($this->berkas) {
            $path = $this->berkas->store('pendaftaran/persyaratan', 'local');

            $berkas = new Berkas([
                'id_syarat' => $this->syarat->id_persyaratan,
                'original_name' => $this->berkas->getClientOriginalName(),
                'file_name' => $path,
                'uploader_id' => Auth::user()->id,
                'disk' => 'local',
            ]);

            $this->syarat->berkas()->save($berkas);

            Log::info('File berhasil disimpan: ', ['path' => $path]);
            $this->berkas = null; // Reset variabel
        } else {
            Log::info('Tidak ada file yang diterima');
        }
    }
    public function render()
    {
        return view('livewire.dokumen.upload-dokumen', [
            'persyaratan' => $this->persyaratan
        ]);
    }
}
