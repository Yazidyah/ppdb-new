<?php

namespace App\Livewire\Registrasi;

use Livewire\Component;
use App\Models\CalonSiswa;
use App\Models\DataRegistrasi;
use Illuminate\Support\Facades\Auth;

class StepDua extends Component
{
    public $tab = 1;
    protected $queryString = [
        'tab' => ['except' => 'konsep', 'as' => 't'],
    ];

    public function mount()
    {
        $user = Auth::user();
        $calonSiswa = CalonSiswa::where('id_user', $user->id)->first();
        $dataRegistrasi = DataRegistrasi::where('id_calon_siswa', $calonSiswa->id_calon_siswa)->first();

        if ($dataRegistrasi->status == 0) {
            return redirect()->to('/siswa/daftar-step-satu?t=1');
        } elseif ($dataRegistrasi->status == 2) {
            return redirect()->to('/siswa/daftar-step-tiga?t=1');
        }
    }

    public function render()
    {
        return view('livewire.registrasi.step-dua')->layout('layouts.apk');
    }
}
