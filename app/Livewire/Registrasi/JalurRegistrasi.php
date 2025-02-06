<?php

namespace App\Livewire\Registrasi;

use Livewire\Component;
use App\Models\CalonSiswa;
use App\Models\DataRegistrasi;
use Illuminate\Support\Facades\Auth;

class JalurRegistrasi extends Component
{
    public $user;
    public $siswa;
<<<<<<< HEAD
    public $id_siswa;
    public $id_jalur;
=======

    public $id_jalur, $id_siswa;
>>>>>>> 8ae3b56bc5805419701aa532731153aa503a2057
    // protected $rules = [
    //     'id_jalur' => 'required|numeric',
    // ];

    // public $messages = [
    //     'id_jalur.required' => 'Jalur Registrasi tidak boleh kosong',
    // ];
    public function mount()
    {
        $this->user = Auth::user();
<<<<<<< HEAD
        $this->id_siswa = CalonSiswa::where('id_user', $this->user->id)->pluck('id_calon_siswa')->first();
=======
        $this->id_siswa = CalonSiswa::where('id_user', $this->user->id)->first()->id_calon_siswa;
>>>>>>> 8ae3b56bc5805419701aa532731153aa503a2057
        $this->siswa = DataRegistrasi::firstOrCreate([
            'id_calon_siswa' => $this->id_siswa,
            'status' => '0'
        ]);
        // dd($this->siswa);
        $this->id_jalur = $this->siswa->jalurRegistrasi->id_jalur ?? '';
    }

    public function updateJalur($value)
    {
        $this->siswa->id_jalur = $value;
        $this->siswa->save();
        return redirect()->to('/siswa/daftar-step-tiga?t=' . $value);
    }

    public function render()
    {
        return view('livewire.registrasi.jalur-registrasi');
    }
}
