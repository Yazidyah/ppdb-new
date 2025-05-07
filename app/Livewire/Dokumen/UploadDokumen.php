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
    public $isRapotLengkap = false;

    #[On('isian-updated')]
    public function mount()
    {
        $this->user = Auth::user();
        $this->rapot = $this->user->siswa->dataRegistrasi->rapot;
        $this->id_siswa = CalonSiswa::where('id_user', $this->user->id)->first()->id_calon_siswa;
        $this->id_jalur = DataRegistrasi::where('id_calon_siswa', $this->id_siswa)->pluck('id_jalur');
        $this->persyaratan = Persyaratan::where('id_jalur', $this->id_jalur)->orderBy('id_persyaratan', 'asc')->get();
        $this->syarat = null;

        $uploadedDocumentsCount = Berkas::where('uploader_id', $this->user->id)->count();
        if ($uploadedDocumentsCount > 0) {
            DataRegistrasi::where('id_calon_siswa', $this->id_siswa)
                ->update(['status' => 2]);
        }
        $this->validateIsianRapot();
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

        $prestasi = $this->persyaratan->filter(function ($item) {
            return stripos($item->nama_persyaratan, 'prestasi') !== false;
        })->pluck('nama_persyaratan')->first();

        $nisn = $this->persyaratan->filter(function ($item) {
            return stripos($item->nama_persyaratan, 'nisn') !== false;
        })->pluck('nama_persyaratan')->first();

        $kip = $this->persyaratan->filter(function ($item) {
            return stripos($item->nama_persyaratan, 'kip') !== false;
        })->pluck('nama_persyaratan')->first();

        $tabungan = $this->persyaratan->filter(function ($item) {
            return stripos($item->nama_persyaratan, 'tabungan') !== false;
        })->pluck('nama_persyaratan')->first();

        $psikolog = $this->persyaratan->filter(function ($item) {
            return stripos($item->nama_persyaratan, 'psikolog') !== false;
        })->pluck('nama_persyaratan')->first();




        $validationRules = [
            $ijazah => [['required', 'file', 'mimes:jpeg,jpg,png,pdf', 'max:300'], 'error-ijazah'],
            $pasFoto => [['required', 'file', 'mimes:jpeg,jpg,png', 'max:300'], 'error-foto'],
            $kartuKeluarga => [['required', 'file', 'mimes:jpeg,jpg,png,pdf', 'max:300'], 'error-kk'],
            $akta => [['required', 'file', 'mimes:jpeg,jpg,png,pdf', 'max:300'], 'error-akte'],
            $akreditasi => [['required', 'file', 'mimes:jpeg,jpg,png,pdf', 'max:300'], 'error-akreditasi'],
            $rapot => [['required', 'file', 'mimes:pdf', 'max:3000'], 'error-rapot'],
            $prestasi => [['required', 'file', 'mimes:jpeg,jpg,png,pdf', 'max:300'], 'error-prestasi'],
            $nisn => [['required', 'file', 'mimes:jpeg,jpg,png,pdf', 'max:300'], 'error-nisn'],
            $kip => [['required', 'file', 'mimes:jpeg,jpg,png,pdf', 'max:300'], 'error-kip'],
            $tabungan => [['required', 'file', 'mimes:jpeg,jpg,png,pdf', 'max:300'], 'error-tabungan'],
            $psikolog => [['required', 'file', 'mimes:jpeg,jpg,png,pdf', 'max:300'], 'error-psikolog'],
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
                Log::channel('upload')->error('Error saat mengunggah file ' . $this->syarat->nama_persyaratan . ' pada user id ' . Auth::user()->id . ': ' . $errorMessages);
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
            $this->kb = KategoriBerkas::where('nama', 'ilike', '%' . $this->syarat->nama_persyaratan . '%')->where('key', 'jalur_reguler')->first();
        }
        if ($this->syarat->id_jalur == 2) {
            $this->kb = KategoriBerkas::where('nama', 'ilike', '%' . $this->syarat->nama_persyaratan . '%')->where('key', 'jalur_prestasi')->first();
        }
        if ($this->syarat->id_jalur == 3) {
            $this->kb = KategoriBerkas::where('nama', 'ilike', '%' . $this->syarat->nama_persyaratan . '%')->where('key', 'jalur_afirmasi_ketm')->first();
        }
        if ($this->syarat->id_jalur == 4) {
            $this->kb = KategoriBerkas::where('nama', 'ilike', '%' . $this->syarat->nama_persyaratan . '%')->where('key', 'jalur_afirmasi_abk')->first();
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

    public function validateIsianRapot()
    {
        $rapot = $this->user->siswa->dataRegistrasi->rapot;

        if (empty($rapot) || empty($rapot->nilai_rapot)) {
            $this->isRapotLengkap = false;
            return;
        }

        $nilaiRapotArray = json_decode(trim($rapot, "\""), true);

        if (isset($nilaiRapotArray['nilai_rapot'])) {
            foreach ($nilaiRapotArray['nilai_rapot'] as $semesterData) {
                foreach ($semesterData['data'] as $value) {
                    if ($value == 0) {
                        $this->isRapotLengkap = false;
                        return;
                    }
                }
            }
        }

        $this->isRapotLengkap = true;
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
