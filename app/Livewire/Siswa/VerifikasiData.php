<?php

namespace App\Livewire\Siswa;

use Livewire\Component;
use App\Models\CalonSiswa;
use App\Models\OrangTua;
use App\Models\PekerjaanOrangTua;
use Illuminate\Support\Facades\Auth;

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
            $this->orangTuaIbu = OrangTua::where('id_calon_siswa', $this->calonSiswa->id_calon_siswa)->where('id_hubungan', 1)->first();
            $this->orangTuaAyah = OrangTua::where('id_calon_siswa', $this->calonSiswa->id_calon_siswa)->where('id_hubungan', 2)->first();

            if ($this->orangTuaIbu) {
                $this->orangTuaIbu->pekerjaan = PekerjaanOrangTua::where('id_pekerjaan', $this->orangTuaIbu->pekerjaan)->first()->nama_pekerjaan;
            }
            if ($this->orangTuaAyah) {
                $this->orangTuaAyah->pekerjaan = PekerjaanOrangTua::where('id_pekerjaan', $this->orangTuaAyah->pekerjaan)->first()->nama_pekerjaan;
            }
        } else {
            abort(404, 'Data not found');
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
