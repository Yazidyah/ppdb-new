<?php

namespace App\Livewire\Siswa;

use App\Models\CalonSiswa;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BiodataSiswa extends Component
{
    public $user;
    public $siswa;
    public $nama_lengkap, $nik, $nisn, $no_telp, $jenis_kelamin, $tanggal_lahir, $tempat_lahir, $npsn, $sekolah_asal, $alamat_domisili, $alamat_kk;

    protected $rules = [
        'nama_lengkap' => 'required|string|max:255',
        'nik' => 'required|numeric',
        'nisn' => 'required|numeric',
        'no_telp' => 'required|numeric',
        'jenis_kelamin' => 'required',
        'tanggal_lahir' => 'required|date',
        'tempat_lahir' => 'required|string',
    ];

    public function mount()
    {
        $this->user = Auth::user();
        $this->siswa = CalonSiswa::firstOrCreate([
            'id_user' => $this->user->id,
        ]);
        $this->nama_lengkap = $this->siswa->nama_lengkap ?? '';
        $this->nik = $this->siswa->NIK ?? '';
        $this->nisn = $this->siswa->NISN ?? '';
        $this->no_telp = $this->siswa->no_telp ?? '';
        $this->jenis_kelamin = $this->siswa->jenis_kelamin ?? '';
        $this->tanggal_lahir = $this->siswa->tanggal_lahir ?? '';
        $this->tempat_lahir = $this->siswa->tempat_lahir ?? '';
        $this->npsn = $this->siswa->NPSN ?? '';
        $this->sekolah_asal = $this->siswa->sekolah_asal ?? '';
        $this->alamat_domisili = $this->siswa->alamat_domisili ?? '';
        $this->alamat_kk = $this->siswa->alamat_kk ?? '';
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

    public function updatedNisn($value)
    {
        $this->siswa->NISN = $value;
        $this->siswa->save();
    }

    public function updatedNoTelp($value)
    {
        $this->siswa->no_telp = $value;
        $this->siswa->save();
    }

    public function updatedNpsn($value)
    {
        $this->siswa->NPSN = $value;
        $this->siswa->save();
    }

    public function updatedSekolahAsal($value)
    {
        $this->siswa->sekolah_asal = $value;
        $this->siswa->save();
    }

    public function updatedAlamatDomisili($value)
    {
        $this->siswa->alamat_domisili = $value;
        $this->siswa->save();
    }

    public function updatedAlamatKk($value)
    {
        $this->siswa->alamat_kk = $value;
        $this->siswa->save();
    }

    public function updatedJenisKelamin($value)
    {
        $this->siswa->jenis_kelamin = $value;
        $this->siswa->save();
    }

    public function updatedTanggalLahir($value)
    {
        $this->siswa->tanggal_lahir = $value;
        $this->siswa->save();
    }

    public function updatedTempatLahir($value)
    {
        $this->siswa->tempat_lahir = $value;
        $this->siswa->save();
    }




    public function render()
    {
        return view('livewire.siswa.biodata-siswa');
    }
}
