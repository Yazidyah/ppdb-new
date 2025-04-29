<?php

namespace App\Livewire\Dokumen;

use App\Helpers\DocumentHelper;
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
        $this->persyaratan = Persyaratan::where('id_jalur', $this->id_jalur)->orderBy('id_persyaratan', 'asc')->get();
        $this->syarat = null;

        // Check if at least one document has been uploaded
        $uploadedDocumentsCount = Berkas::where('uploader_id', $this->user->id)->count();
        if ($uploadedDocumentsCount > 0) {
            DataRegistrasi::where('id_calon_siswa', $this->id_siswa)
                ->update(['status' => 2]);
        }
    }

    private function isSimpleSyarat($namaSyarat) //Buat syarat yang ga butuh ngisi data
    {
        return DocumentHelper::isSimpleSyarat($namaSyarat);
    }

    public function updatedBerkas()
    {
        $simpleRequirement = $this->persyaratan->filter(function ($item) {
            return $this->isSimpleSyarat($item->nama_persyaratan);
        })->first();


        $rapot = $this->persyaratan->filter(function ($item) {
            return stripos($item->nama_persyaratan, 'rapot') !== false;
        })->pluck('nama_persyaratan')->first();

        $pasFoto = $this->persyaratan->filter(function ($item) {
            return stripos($item->nama_persyaratan, 'foto') !== false;
        })->pluck('nama_persyaratan')->first();

        $ijazah = $this->persyaratan->filter(function ($item) {
            return stripos($item->nama_persyaratan, 'ijazah') !== false;
        })->pluck('nama_persyaratan')->first();

        $akta = $this->persyaratan->filter(function ($item) {
            return stripos($item->nama_persyaratan, 'akta') !== false;
        })->pluck('nama_persyaratan')->first();

        $kartuKeluarga = $this->persyaratan->filter(function ($item) {
            return stripos($item->nama_persyaratan, 'kartu keluarga') !== false;
        })->pluck('nama_persyaratan')->first();

        $akreditasi = $this->persyaratan->filter(function ($item) {
            return stripos($item->nama_persyaratan, 'akreditasi') !== false;
        })->pluck('nama_persyaratan')->first();


        $validationRules = [
            // $simpleRequirement->nama_persyaratan => ['required|mimes:jpeg,jpg,png|max:300', 'error-simple'],
            $ijazah => ['required|mimes:jpeg,jpg,png|max:300', 'error-ijazah'],
            $pasFoto => ['required|mimes:jpeg,jpg,png|max:300', 'error-foto'],
            $kartuKeluarga => ['required|mimes:jpeg,jpg,png|max:300', 'error-kk'],
            $akta => ['required|mimes:jpeg,jpg,png|max:300', 'error-akte'],
            $akreditasi => ['required|mimes:jpeg,jpg,png|max:300', 'error-akreditasi'],
            $rapot => ['required|mimes:pdf|max:3000', 'error-rapot'],
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
            'persyaratan' => $this->persyaratan->map(function ($item) {
                $item->is_simple = $this->isSimpleSyarat($item->nama_persyaratan);
                return $item;
            }),
        ]);
    }
}
