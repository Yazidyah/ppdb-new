<?php

namespace App\Livewire\Siswa;

use App\Models\CalonSiswa;
use App\Models\OrangTua;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StepSatu extends Component
{
    public $tab = 1;
    public $siswa;
    public $user;
    public $orangTua;
    protected $queryString = [
        'tab' => ['except' => 'konsep', 'as' => 't'],
    ];

    public function mount()
    {
        $this->user = Auth::user();
        $this->siswa = CalonSiswa::where('id_user', $this->user->id)->first();
        $this->orangTua = OrangTua::where('id_calon_siswa', @$this->siswa->id_calon_siswa)->first();
        if ($this->siswa == null) {
            $this->siswa = CalonSiswa::create([
                'id_user' => $this->user->id,
            ]);
        }

        if ($this->orangTua == null) {
            $this->orangTua = OrangTua::create([
                'id_calon_siswa' => $this->siswa->id_calon_siswa,
                'id_hubungan' => 1,
            ]);
        }
    }

    public function submit()
    {
        return redirect()->to('/siswa/daftar-step-dua?t=1');
    }

    public function render()
    {
        return view('livewire.siswa.step-satu');
    }
}
