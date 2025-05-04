<?php

namespace App\Livewire\Verifikasi;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\DataRegistrasi;
use App\Models\CalonSiswa;
use App\Helpers\DocumentHelper;
class StepEmpat extends Component
{
    public $tab = 1;
    protected $queryString = [
        'tab' => ['except' => 'konsep', 'as' => 't'],
    ];

    public $user;
    public $persyaratan;
    public $isValid = true;

    public function mount()
    {
        $this->user = Auth::user();
        $calonSiswa = CalonSiswa::where('id_user', $this->user->id)->first();
        $dataRegistrasi = DataRegistrasi::where('id_calon_siswa', $calonSiswa->id_calon_siswa)->first();

        if ($dataRegistrasi->status == 3) {
            session()->flash('message', 'Kamu sudah pernah mendaftar');
            return redirect('/siswa/dashboard');
        }

        $this->persyaratan = $dataRegistrasi->syarat;
        $this->isSyaratComplete();
    }

    public function updateStatus()
    {
        $calonSiswa = CalonSiswa::where('id_user', $this->user->id)->first();
        DataRegistrasi::where('id_calon_siswa', $calonSiswa->id_calon_siswa)
            ->update(['status' => 3]);

        return redirect('/siswa/dashboard');
    }
    public function isSyaratComplete()
    {
        \Log::debug('Starting requirement validation process.');

        foreach ($this->persyaratan as $index => $syarat) {
            \Log::debug("Checking requirement #{$index}: " . $syarat->nama_persyaratan);

            if (count($syarat->berkas) === 0) {
                \Log::warning("Requirement #{$index} not met: " . $syarat->nama_persyaratan . " - No files uploaded.");
                $this->isValid = false;
                return false;
            }

            foreach ($syarat->berkas as $fileIndex => $berkas) {
                $namaPersyaratan = $berkas->persyaratan->nama_persyaratan ?? 'Tidak diketahui';
                \Log::debug("Checking file #{$fileIndex} for requirement #{$index}: " . $namaPersyaratan);

                if (!DocumentHelper::isSimpleSyarat($namaPersyaratan) 
                    && empty($berkas->data_berkas)
                ) {
                    \Log::warning("Requirement #{$index} not met: " . $namaPersyaratan . " - File data is empty for file #{$fileIndex}.");
                    $this->isValid = false;
                    return false;
                } else {
                    \Log::info("File #{$fileIndex} for requirement #{$index} is valid: " . $namaPersyaratan);
                }
            }
        }

        \Log::debug('All requirements have been validated and are complete.');
        $this->isValid = true;
        return true;
    }

    public function render()
    {
        return view('livewire.verifikasi.step-empat')->layout('layouts.apk');
    }
}
