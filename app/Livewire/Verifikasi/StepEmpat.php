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
        // Tahap 1: cek apakah setiap persyaratan sudah ada berkas
        foreach ($this->persyaratan as $syarat) {
            logger()->info('Memeriksa persyaratan', ['syarat' => $syarat]);
            if (count($syarat->berkas) === 0) {
                logger()->warning('Persyaratan tidak memiliki berkas', ['syarat' => $syarat]);
                $this->isValid = false;
                return false; // langsung keluar, tidak perlu cek selanjutnya
            }
        }
    
        // Tahap 2: semua persyaratan punya berkas, lanjut validasi data_berkas
        foreach ($this->persyaratan as $syarat) {
            foreach ($syarat->berkas as $berkas) {
                $namaPersyaratan = $berkas->persyaratan->nama_persyaratan ?? 'Tidak diketahui';
                logger()->info('Memeriksa berkas', ['berkas' => $berkas, 'namaPersyaratan' => $namaPersyaratan]);
    
                // hanya syarat non‐simple yang dicek data_berkas-nya
                if (!DocumentHelper::isSimpleSyarat($namaPersyaratan) 
                    && empty($berkas->data_berkas)
                ) {
                    logger()->warning('Data berkas kosong untuk persyaratan', ['namaPersyaratan' => $namaPersyaratan]);
                    $this->isValid = false;
                    return false; // langsung keluar kalau ada yang kosong
                }
            }
        }
    
        // Semua lolos
        logger()->info('Semua persyaratan lengkap dan valid');
        $this->isValid = true;
        return true;
    }
    

    public function render()
    {
        return view('livewire.verifikasi.step-empat')->layout('layouts.apk');
    }
}
