<?php

namespace App\Livewire\Verifikasi;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\DataRegistrasi;
use App\Models\CalonSiswa;
use App\Helpers\DocumentHelper;
use App\Models\Persyaratan;

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
        $idjalur = $dataRegistrasi->id_jalur;
        $this->persyaratan = Persyaratan::where('id_jalur', $idjalur)
            ->orderBy('id_persyaratan', 'asc')
            ->get();
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
            if (count($syarat->berkas->where('deleted_at', null)) == 0) {
                $this->isValid = false;
                return false;
            }
            foreach ($syarat->berkas->where('deleted_at', null)->where('uploader_id', $this->user->id) as $berkas) {
                $namaPersyaratan = $berkas->persyaratan->nama_persyaratan ?? 'Tidak diketahui';
                if (str_contains(strtolower($namaPersyaratan), 'kartu keluarga')) {
                    // dd($berkas->data_berkas);
                    if (
                        $berkas->data_berkas == null or $berkas->data_berkas == ''
                    ) {
                        $this->isValid = false;
                        return false;
                    }
                }

                if (str_contains(strtolower($namaPersyaratan), 'nisn')) {
                    if (
                        $berkas->data_berkas == null or $berkas->data_berkas == '' or empty($berkas->data_berkas)
                    ) {
                        $this->isValid = false;
                        return false;
                    }
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
