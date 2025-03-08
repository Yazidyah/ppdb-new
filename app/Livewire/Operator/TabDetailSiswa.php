<?php

namespace App\Livewire\Operator;

use Livewire\Component;
use App\Models\CalonSiswa;
use App\Models\JalurRegistrasi;
use App\Models\DataRegistrasi;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TabDetailSiswa extends Component
{
    public $id_calon_siswa;
    public $siswa;
    public $nama_lengkap, $nik, $nisn, $no_telp, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $npsn, $sekolah_asal, $status_sekolah, $alamat_domisili, $alamat_kk, $provinsi, $kota, $id_jalur;
    public $name, $email, $password;
    public $jalurOptions;

    protected $rules = [
        'nama_lengkap' => 'required|string|max:255',
        'nik' => 'nullable|string|max:16',
        'nisn' => 'nullable|string|max:10',
        'no_telp' => 'nullable|string|max:15',
        'jenis_kelamin' => 'required|in:L,P',
        'tempat_lahir' => 'nullable|string|max:255',
        'tanggal_lahir' => 'nullable|date',
        'npsn' => 'nullable|string|max:8',
        'sekolah_asal' => 'nullable|string|max:255',
        'status_sekolah' => 'nullable|string|max:255',
        'alamat_domisili' => 'nullable|string|max:255',
        'alamat_kk' => 'nullable|string|max:255',
        'provinsi' => 'nullable|string|max:255',
        'kota' => 'nullable|string|max:255',
        'id_jalur' => 'required|exists:jalur_registrasi,id_jalur',
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'password' => 'nullable|string|min:8',
    ];

    public function mount(CalonSiswa $siswa)
    {
        $this->siswa = $siswa;
        $this->id_calon_siswa = $siswa->id_calon_siswa;
        $this->nama_lengkap = ucwords($siswa->nama_lengkap);
        $this->nik = $siswa->NIK;
        $this->nisn = $siswa->NISN;
        $this->no_telp = $siswa->no_telp;
        $this->jenis_kelamin = $siswa->jenis_kelamin;
        $this->tempat_lahir = strtoupper($siswa->tempat_lahir);
        $this->tanggal_lahir = $siswa->tanggal_lahir;
        $this->npsn = $siswa->NPSN;
        $this->sekolah_asal = strtoupper($siswa->sekolah_asal);
        $this->status_sekolah = strtoupper($siswa->status_sekolah);
        $this->alamat_domisili = ucwords($siswa->alamat_domisili);
        $this->alamat_kk = ucwords($siswa->alamat_kk);
        $this->provinsi = $siswa->provinsi;
        $this->kota = $siswa->kota;
        $this->id_jalur = $siswa->dataRegistrasi->jalur->id_jalur;
        $this->jalurOptions = JalurRegistrasi::all();
        $user = $siswa->user;
        $this->name = $user->name;
        $this->email = $user->email;
    }
    

    public function updateSiswa()
    {
        $this->validate();

        CalonSiswa::where('id_calon_siswa', $this->id_calon_siswa)->update([
            'nama_lengkap' => strtolower($this->nama_lengkap),
            'NIK' => $this->nik,
            'NISN' => $this->nisn,
            'no_telp' => $this->no_telp,
            'jenis_kelamin' => $this->jenis_kelamin,
            'tempat_lahir' => strtolower($this->tempat_lahir),
            'tanggal_lahir' => $this->tanggal_lahir,
            'NPSN' => $this->npsn,
            'sekolah_asal' => strtolower($this->sekolah_asal),
            'status_sekolah' => strtolower($this->status_sekolah),
            'alamat_domisili' => strtolower($this->alamat_domisili),
            'alamat_kk' => strtolower($this->alamat_kk),
            'provinsi' => strtoupper($this->provinsi),
            'kota' => strtoupper($this->kota),
            'updated_at' => now(),
        ]);
        
        $currentKodeRegistrasi = DataRegistrasi::where('id_calon_siswa', $this->id_calon_siswa)->first()->kode_registrasi;
        $kode_registrasi = $this->id_jalur == 1 ? 'R' : 'A';
        $newKodeRegistrasi = $kode_registrasi . substr($currentKodeRegistrasi, 1);

        DataRegistrasi::where('id_calon_siswa', $this->id_calon_siswa)->update([
            'id_jalur' => $this->id_jalur,
            'kode_registrasi' => $newKodeRegistrasi,
        ]);

        $user = User::find($this->siswa->id_user);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password ? Hash::make($this->password) : $user->password,
        ]);

        session()->flash('message', 'Data berhasil diperbarui.');
    }

    public function render()
    {
        return view('livewire.operator.tab-detail-siswa');
    }
}
