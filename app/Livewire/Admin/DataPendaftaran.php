<?php

namespace App\Livewire\Admin;

use App\Models\CalonSiswa;
use Livewire\Component;
use Livewire\WithPagination;

class DataPendaftaran extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.admin.data-pendaftaran', [
            'pendaftarans' => CalonSiswa::query()
                ->whereHas('user', function ($query) {
                    $query->whereNull('deleted_at');
                })
                ->select('id_calon_siswa', 'nama_lengkap', 'NISN', 'sekolah_asal', 'jenis_kelamin', 'kota') // Include 'kota'
                ->with(['dataRegistrasi.rapot']) // Ensure related data is loaded
                ->orderBy('id_calon_siswa')
                ->paginate(10)
        ]);
    }
}
