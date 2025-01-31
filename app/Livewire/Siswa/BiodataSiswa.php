<?php

namespace App\Livewire\Siswa;

use App\Models\CalonSiswa;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BiodataSiswa extends Component
{
    public $user;
    public $siswa;
    public $nama_lengkap, $nik;

    protected $rules = [
        'nama_lengkap' => 'required|string|max:255',
    ];
    public function mount()
    {
        $this->user = Auth::user();
        $this->siswa = CalonSiswa::firstOrCreate([
            'id_user' => $this->user->id,
        ]);
        $this->nama_lengkap = $this->siswa->nama_lengkap ?? '';
        $this->nik = $this->siswa->NIK ?? '';
    }

    public function updatedNamaLengkap($value)
    {
        $this->siswa->nama_lengkap = $value;
        $this->siswa->save();
    }

    public function updatedNik($value)
    {
        $this->siswa->NIK = $value;
        $this->siswa->save();
    }

    public function render()
    {
        return view('livewire.siswa.biodata-siswa');
    }
}
