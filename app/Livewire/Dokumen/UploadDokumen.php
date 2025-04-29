<?php

namespace App\Livewire\Dokumen;

use App\Models\Berkas;
use App\Models\KategoriBerkas;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Persyaratan;
use App\Models\CalonSiswa;
use App\Models\DataRegistrasi;
use App\Models\Rapot;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;

class UploadDokumen extends Component
{
    use WithFileUploads;
    public $modalSubmit = false;
    public $persyaratan;
    public $user;
    public $id_jalur, $kbs, $id_persyaratan, $id_siswa, $berkas;
    public $syarat;
    public $kb;
    public $rapot;

    #[On('isian-updated')]
    public function mount()
    {
        $this->user = Auth::user();
        $this->rapot = $this->user->siswa->dataRegistrasi->rapot;
        $this->id_siswa = CalonSiswa::where('id_user', $this->user->id)->first()->id_calon_siswa;
        $this->id_jalur = DataRegistrasi::where('id_calon_siswa', $this->id_siswa)->pluck('id_jalur');
        $this->persyaratan = Persyaratan::where('id_jalur', $this->id_jalur)->get();
        $this->syarat = null;

        // Check if at least one document has been uploaded
        $uploadedDocumentsCount = Berkas::where('uploader_id', $this->user->id)->count();
        if ($uploadedDocumentsCount > 0) {
            DataRegistrasi::where('id_calon_siswa', $this->id_siswa)
                ->update(['status' => 2]);
        }
    }

    public function updatedBerkas()
    {
        $rapot = $this->persyaratan->filter(function ($item) {
            return stripos($item->nama_persyaratan, 'rapot') !== false;
        })->first();

        $validationRules = [
            'Pas Foto' => ['required|mimes:jpeg,jpg,png|max:300', 'error-foto'],
            'Ijazah MTs/SMP' => ['required|mimes:jpeg,jpg,png|max:300', 'error-ijazah'],
            'Kartu Keluarga' => ['required|mimes:jpeg,jpg,png|max:300', 'error-kk'],
            'Akta Kelahiran' => ['required|mimes:jpeg,jpg,png|max:300', 'error-akte'],
            'Sertifikat Akreditasi' => ['required|mimes:jpeg,jpg,png|max:300', 'error-akreditasi'],
            $rapot->nama_persyaratan => ['required|mimes:pdf|max:3000', 'error-rapot'],
        ];

        if (isset($validationRules[$this->syarat->nama_persyaratan])) {
            [$rules, $errorKey] = $validationRules[$this->syarat->nama_persyaratan];

            try {
                $this->validate(['berkas' => $rules], [
                    'berkas.required' => 'File harus diunggah.',
                    'berkas.mimes' => 'Format file tidak sesuai.',
                    'berkas.max' => 'Ukuran file melebihi batas maksimal.',
                ]);
                $this->simpan();
            } catch (\Illuminate\Validation\ValidationException $e) {
                $errorMessages = implode(', ', $e->validator->errors()->all());
                session()->flash($errorKey, $errorMessages);
                Log::channel('upload')->error('Error saat mengunggah file ' . $this->syarat->nama_persyaratan . ' pada user id ' . Auth::user()->id . ': ' . $e->getMessage());
            } catch (\Exception $e) {
                session()->flash($errorKey, 'Terjadi kesalahan saat mengunggah file.');
                Log::channel('upload')->error('Error saat mengunggah file: ' . $e->getMessage());
            }
        }
    }

    public function setSyarat($id)
    {
        $this->syarat = Persyaratan::find($id);
        if ($this->syarat->id_jalur == 1) {
            $this->kb = KategoriBerkas::where('nama', $this->syarat->nama_persyaratan)->where('key', 'jalur_reguler')->first();
        }
    }

    public function simpan()
    {
        if ($this->berkas) {
            $path = $this->berkas->store('pendaftaran/persyaratan', 'local');

            $berkas = new Berkas([
                'kategori_berkas_id' => $this->kb->id,
                'id_syarat' => $this->syarat->id_persyaratan,
                'original_name' => $this->berkas->getClientOriginalName(),
                'file_name' => $path,
                'uploader_id' => Auth::user()->id,
                'disk' => 'local',
            ]);

            $this->syarat->berkas()->save($berkas);

            // Update status in DataRegistrasi
            DataRegistrasi::where('id_calon_siswa', $this->id_siswa)
                ->update(['status' => 2]);

            Log::channel('upload')->info('File ' . $this->syarat->nama_persyaratan . ' berhasil disimpan', ['path' => $path, 'user_id' => Auth::user()->id]);
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