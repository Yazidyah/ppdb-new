<?php

namespace App\Livewire\Verifikasi;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\DataRegistrasi;
use App\Models\CalonSiswa;

class StepEmpat extends Component
{
    public $tab = 1;
    protected $queryString = [
        'tab' => ['except' => 'konsep', 'as' => 't'],
    ];

    public $user;

    public function mount()
    {
        $this->user = Auth::user();
        $calonSiswa = CalonSiswa::where('id_user', $this->user->id)->first();
        $dataRegistrasi = DataRegistrasi::where('id_calon_siswa', $calonSiswa->id_calon_siswa)->first();

        if ($dataRegistrasi->status == 3) {
            session()->flash('message', 'Kamu sudah pernah mendaftar');
            return redirect('/siswa/dashboard');
        }
    }

    public function updateStatus()
    {
        $calonSiswa = CalonSiswa::where('id_user', $this->user->id)->first();
        DataRegistrasi::where('id_calon_siswa', $calonSiswa->id_calon_siswa)
            ->update(['status' => 3]);

        return redirect('/siswa/dashboard');
    }

    public function render()
    {
        return view('livewire.verifikasi.step-empat')->layout('layouts.apk');
    }
}
