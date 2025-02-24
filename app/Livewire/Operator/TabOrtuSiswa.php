<?php

namespace App\Livewire\Operator;

use App\Models\OrangTua;
use App\Models\PekerjaanOrangTua;
use Livewire\Component;

class TabOrtuSiswa extends Component
{
    public $siswa;
    public $dataOrtu = []; // Array untuk menyimpan data masing-masing orang tua
    public $pekerjaanOrangTua;
    
    // Aturan validasi untuk tiap record, sesuaikan jika diperlukan
    protected $rules = [
        'dataOrtu.*.id_hubungan'    => 'required|integer',
        'dataOrtu.*.nama_lengkap'   => 'required|string|max:255',
        'dataOrtu.*.nik'            => 'nullable|string|max:16',
        'dataOrtu.*.nama_pekerjaan' => 'nullable|string|max:255',
        'dataOrtu.*.no_telp'        => 'nullable|string|max:15',
    ];

    public function mount($siswa)
    {
        $this->siswa = $siswa;
        // Ambil semua record orang tua dengan id_calon_siswa yang sama dan urutkan berdasarkan id_orang_tua secara ascending
        $orangTuaCollection = OrangTua::where('id_calon_siswa', $siswa->id_calon_siswa)
                          ->orderBy('id_orang_tua', 'asc')
                          ->get();

        // Siapkan array data untuk setiap record
        foreach ($orangTuaCollection as $ortu) {
            $this->dataOrtu[$ortu->id_orang_tua] = [
                'id_orang_tua'   => $ortu->id_orang_tua,
                'id_hubungan'    => $ortu->id_hubungan,
                'nama_lengkap'   => ucwords($ortu->nama_lengkap),
                'nik'            => $ortu->nik,
                'nama_pekerjaan' => $ortu->pekerjaan,
                'no_telp'        => $ortu->no_telp,
            ];
        }

        $this->pekerjaanOrangTua = PekerjaanOrangTua::all();
    }

    // Fungsi untuk update masing-masing record orang tua
    public function updateOrangTua($id_orang_tua)
    {
        // Validasi data untuk record yang spesifik
        $this->validate([
            'dataOrtu.' . $id_orang_tua . '.id_hubungan'    => 'required|integer',
            'dataOrtu.' . $id_orang_tua . '.nama_lengkap'   => 'required|string|max:255',
            'dataOrtu.' . $id_orang_tua . '.nik'            => 'nullable|string|max:16',
            'dataOrtu.' . $id_orang_tua . '.nama_pekerjaan' => 'nullable|integer|max:255',
            'dataOrtu.' . $id_orang_tua . '.no_telp'        => 'nullable|string|max:15',
        ]);

        OrangTua::where('id_orang_tua', $id_orang_tua)->update([
            'id_calon_siswa' => $this->siswa->id_calon_siswa,
            'id_hubungan'    => $this->dataOrtu[$id_orang_tua]['id_hubungan'],
            'nama_lengkap'   => strtolower($this->dataOrtu[$id_orang_tua]['nama_lengkap']),
            'nik'            => $this->dataOrtu[$id_orang_tua]['nik'],
            'pekerjaan'      => $this->dataOrtu[$id_orang_tua]['nama_pekerjaan'],
            'no_telp'        => $this->dataOrtu[$id_orang_tua]['no_telp'],
        ]);

        session()->flash('message', "Data orang tua (ID: {$id_orang_tua}) berhasil diperbarui.");
    }

    public function render()
    {
        return view('livewire.operator.tab-ortu-siswa', [
            'pekerjaanOrangTua' => $this->pekerjaanOrangTua,
        ]);
    }
}
