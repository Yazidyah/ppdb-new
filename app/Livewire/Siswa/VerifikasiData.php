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
    public $user;
    public $orangTuaWali;

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
        $orangTuaCollection = OrangTua::with('pekerjaanOrangTua')
            ->where('id_calon_siswa', $this->calonSiswa->id_calon_siswa)
            ->whereIn('id_hubungan', [1, 2, 3])
            ->get()
            ->keyBy('id_hubungan');

        $this->orangTuaIbu = $orangTuaCollection->get(1);
        $this->orangTuaAyah = $orangTuaCollection->get(2);
        $this->orangTuaWali = $orangTuaCollection->get(3);

        $pekerjaanIds = $orangTuaCollection->pluck('pekerjaan')->filter()->unique()->toArray();
        
        if (!empty($pekerjaanIds)) {
            $pekerjaanMap = PekerjaanOrangTua::whereIn('id_pekerjaan', $pekerjaanIds)
                ->get()
                ->keyBy('id_pekerjaan');

            if ($this->orangTuaIbu && isset($pekerjaanMap[$this->orangTuaIbu->pekerjaan])) {
                $this->orangTuaIbu->pekerjaan = $pekerjaanMap[$this->orangTuaIbu->pekerjaan]->nama_pekerjaan;
            }
            if ($this->orangTuaAyah && isset($pekerjaanMap[$this->orangTuaAyah->pekerjaan])) {
                $this->orangTuaAyah->pekerjaan = $pekerjaanMap[$this->orangTuaAyah->pekerjaan]->nama_pekerjaan;
            }
            if ($this->orangTuaWali && isset($pekerjaanMap[$this->orangTuaWali->pekerjaan])) {
                $this->orangTuaWali->pekerjaan = $pekerjaanMap[$this->orangTuaWali->pekerjaan]->nama_pekerjaan;
            }
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
            'orangTuaWali' => $this->orangTuaWali,
        ]);
    }
}
