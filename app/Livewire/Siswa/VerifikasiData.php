<?php

namespace App\Livewire\Siswa;

use Livewire\Component;
use App\Models\CalonSiswa;
use App\Models\OrangTua;
use App\Models\PekerjaanOrangTua;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VerifikasiData extends Component
{
    public $calonSiswa;
    public $orangTuaIbu;
    public $orangTuaAyah;
    public $id_calon_siswa;

    public function mount()
    {
        $this->user = Auth::user();
        $this->calonSiswa = CalonSiswa::where('id_user', $this->user->id)->first();
        if ($this->calonSiswa) {
            $this->loadOrangTuaData();
        } else {
            abort(404, 'Data not found');
        }
    }

    private function loadOrangTuaData()
    {
        $this->orangTuaIbu = OrangTua::where('id_calon_siswa', $this->calonSiswa->id_calon_siswa)->where('id_hubungan', 1)->first();
        $this->orangTuaAyah = OrangTua::where('id_calon_siswa', $this->calonSiswa->id_calon_siswa)->where('id_hubungan', 2)->first();

        if ($this->orangTuaIbu) {
            $this->orangTuaIbu->pekerjaan = PekerjaanOrangTua::where('id_pekerjaan', $this->orangTuaIbu->pekerjaan)->first()->nama_pekerjaan;
        }
        if ($this->orangTuaAyah) {
            $this->orangTuaAyah->pekerjaan = PekerjaanOrangTua::where('id_pekerjaan', $this->orangTuaAyah->pekerjaan)->first()->nama_pekerjaan;
        }
    }

    public function submit()
    {
        if ($this->isDataIncomplete()) {
            session()->flash('error', 'Data belum lengkap!');
            return;
        }

        $this->updateStatus();
    }

    private function isDataIncomplete()
    {
        return !$this->calonSiswa->nama_lengkap || !$this->calonSiswa->NIK || !$this->calonSiswa->NISN || !$this->calonSiswa->no_telp || !$this->calonSiswa->jenis_kelamin_readable || !$this->calonSiswa->tanggal_lahir_formatted || !$this->calonSiswa->tempat_lahir || !$this->calonSiswa->NPSN || !$this->calonSiswa->sekolah_asal || !$this->calonSiswa->provinsi || !$this->calonSiswa->kota || !$this->calonSiswa->alamat_domisili || !$this->calonSiswa->alamat_kk || !$this->calonSiswa->predikat_akreditasi_sekolah || !$this->calonSiswa->nilai_akreditasi_sekolah || !$this->orangTuaIbu || !$this->orangTuaAyah;
    }

    public function updateStatus()
    {
        $updated = DB::table('data_registrasi')
            ->where('id_calon_siswa', $this->calonSiswa->id_calon_siswa)
            ->update(['status' => 1]);

        if ($updated) {
            $this->deleteCookie();
            return redirect()->to('/siswa/daftar-step-dua?t=1');
        } else {
            return redirect()->to('/siswa/daftar-step-satu?t=3');
        }
    }

    private function deleteCookie()
    {
        if (isset($_COOKIE['alamat_domisili_disabled'])) {
            unset($_COOKIE['alamat_domisili_disabled']);
            setcookie('alamat_domisili_disabled', '', time() - 3600, '/');
        }
    }

    public function render()
    {
        return view('livewire.siswa.verifikasi-data', [
            'calonSiswa' => $this->calonSiswa,
            'orangTuaIbu' => $this->orangTuaIbu,
            'orangTuaAyah' => $this->orangTuaAyah,
        ]);
    }
}
