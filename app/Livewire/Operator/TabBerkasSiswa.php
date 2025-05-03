<?php

namespace App\Livewire\Operator;

use App\Models\Berkas;
use App\Models\CalonSiswa;
use App\Models\DataRegistrasi;
use App\Models\KategoriBerkas;
use App\Models\Persyaratan;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class TabBerkasSiswa extends Component
{
    use WithFileUploads;
    public $siswa;

    public $kbs;

    public $kb;

    public $id_jalur, $id_persyaratan, $id_siswa, $berkas;
    public $user, $syarat;

    public $persyaratan;

    public $berkasBaru = true;

    public function mount()
    {
        $this->user = $this->siswa->user;
        $this->id_siswa = CalonSiswa::where('id_user', $this->user->id)->first()->id_calon_siswa;
        $this->id_jalur = DataRegistrasi::where('id_calon_siswa', $this->id_siswa)->pluck('id_jalur');
        $this->persyaratan = Persyaratan::where('id_jalur', $this->id_jalur)->get();
        $this->syarat = null;
    }

    public function updatedBerkas()
    {
        try {
            $this->validate([
                'berkas' => 'required|mimes:jpeg,jpg,png,pdf|max:51200', // Maksimal 50MB
            ]);
            dd($this->berkas);
            $this->simpan();
        } catch (\Exception $e) {
            \Log::info('terlalu besar');
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
                'uploader_id' => $this->user->id,
                'disk' => 'local',
            ]);
            $this->syarat->berkas()->save($berkas);

            Log::info('File berhasil disimpan: ', ['path' => $path]);
            $this->berkas = null;
            if ($this->berkasBaru == false) {
                $this->deleteExistsBerkas($this->syarat->berkas->where('uploader_id', $this->user->id)->sortBy('id')->first());
            }
        } else {
            Log::info('Tidak ada file yang diterima');
        }
    }

    public function deleteExistsBerkas($berkas)
    {
        $berkas->delete();
    }
    public function render()
    {
        return view('livewire.operator.tab-berkas-siswa');
    }
}
