<?php

namespace App\Livewire\Siswa;

use App\Models\CalonSiswa;
use App\Models\DataRegistrasi;
use App\Models\OrangTua;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StepSatu extends Component
{
    public $tab = 1;
    public $siswa;
    public $user;
    public $orangTua;
    public $regis;
    protected $queryString = [
        'tab' => ['except' => 'konsep', 'as' => 't'],
    ];

    public function mount()
    {
        $this->initializeUser();
        $this->initializeSiswa();
        $this->checkRegistrationStatus();
        $this->initializeOrangTua();
    }

    public function initializeUser()
    {
        $this->user = Auth::user();
        // dd($this->user->siswa->dataRegistrasi);
        if ($this->user->siswa == null) {
            $this->user->siswa = CalonSiswa::create([
                'id_user' => $this->user->id,
            ]);
        }

        if ($this->user->siswa->dataRegistrasi == null) {
        if ($this->user->siswa && $this->user->siswa->dataRegistrasi == null) {
            $this->regis = DataRegistrasi::firstOrCreate([
                'id_calon_siswa' => $this->user->siswa->id_calon_siswa,
                'status' => '0',
            ]);
        }
    }
}

    public function initializeSiswa()
    {
        $this->siswa = CalonSiswa::where('id_user', $this->user->id)->first();
        if ($this->siswa == null) {
            $this->siswa = CalonSiswa::create([
                'id_user' => $this->user->id,
            ]);
        }
    }

    public function checkRegistrationStatus()
    {
        if (!$this->siswa || !$this->siswa->dataregistrasi) {
            return;
        }

        $status = $this->siswa->dataregistrasi->status;

        if ($status == 3) {
            session()->flash('message', 'Kamu sudah pernah mendaftar');
            return redirect()->to('/siswa/dashboard');
        }

        if ($status == 2) {
            return redirect()->to('/siswa/daftar-step-tiga?t=1');
        }

        if ($status == 1) {
            return redirect()->to('/siswa/daftar-step-dua?t=1');
        }
    }

    public function initializeOrangTua()
    {
        $this->orangTua = OrangTua::where('id_calon_siswa', $this->siswa->id_calon_siswa)->first();
        if ($this->orangTua == null) {
            $this->orangTua = OrangTua::create([
                'id_calon_siswa' => $this->siswa->id_calon_siswa,
                'id_hubungan' => 1,
                'pekerjaan' => 1,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.siswa.step-satu');
    }
}
