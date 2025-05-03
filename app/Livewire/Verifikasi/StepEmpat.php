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
        foreach ($this->persyaratan as $syarat) {
            if (count($syarat->berkas) === 0) {
                \Log::warning('Requirement not met: ' . $syarat->nama_persyaratan . ' - No files uploaded.');
                $this->isValid = false;
                return false;
            }
        }

        foreach ($this->persyaratan as $syarat) {
            foreach ($syarat->berkas as $berkas) {
                $namaPersyaratan = $berkas->persyaratan->nama_persyaratan ?? 'Tidak diketahui';
                if (!DocumentHelper::isSimpleSyarat($namaPersyaratan) 
                    && empty($berkas->data_berkas)
                ) {
                    \Log::warning('Requirement not met: ' . $namaPersyaratan . ' - File data is empty.');
                    $this->isValid = false;
                    return false;
                }
            }
        }

        $this->isValid = true;
        return true;
    }
    

    public function render()
    {
        return view('livewire.verifikasi.step-empat')->layout('layouts.apk');
    }
}
