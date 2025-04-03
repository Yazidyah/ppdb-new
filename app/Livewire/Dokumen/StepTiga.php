<?php

namespace App\Livewire\Dokumen;

use Livewire\Component;
use App\Models\CalonSiswa;
use App\Models\DataRegistrasi;
use Illuminate\Support\Facades\Auth;

class StepTiga extends Component
{
    public $tab = 1;
    public $user;
    public $modalSubmit = false;
    protected $queryString = [
        'tab' => ['except' => 'konsep', 'as' => 't'],
    ];

    public function mount()
    {
        $this->tab = request()->query('t', 1);
        $this->user = Auth::user();
        $calonSiswa = CalonSiswa::where('id_user', $this->user->id)->first();
        $dataRegistrasi = DataRegistrasi::where('id_calon_siswa', $calonSiswa->id_calon_siswa)->first();

        if ($dataRegistrasi->status == 0) {
            return redirect()->to('/siswa/daftar-step-satu?t=1');
        } elseif ($dataRegistrasi->status == 1) {
            return redirect()->to('/siswa/daftar-step-dua?t=1');
        } elseif ($dataRegistrasi->status >= 3) {
            session()->flash('message', 'Kamu sudah pernah mendaftar');
            return redirect()->to('/siswa/daftar-step-empat?t=1');
        }
    }

    public function submit()
    {
        return redirect()->to('/siswa/daftar-step-empat?t=1');
    }
    public function render()
    {
        return view('livewire.dokumen.step-tiga')->layout('layouts.apk');
    }
}
