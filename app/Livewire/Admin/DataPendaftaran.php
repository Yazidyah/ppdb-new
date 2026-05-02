<?php

namespace App\Livewire\Admin;

use App\Models\CalonSiswa;
use Livewire\Component;
use Livewire\WithPagination;

class DataPendaftaran extends Component
{
    use WithPagination;
    public $search = '';

    public function render()
    {
        return view('livewire.admin.data-pendaftaran', [
            'pendaftarans' => CalonSiswa::query()
                ->whereHas('user', function ($query) {
                    $query->whereNull('deleted_at');
                })
                ->when($this->search, function ($query, $search) {
                                        $search = trim($search);
                                        $searchLower = mb_strtolower($search);

                                        $query->where(function ($q) use ($searchLower, $search) {
                                                $q->whereRaw('LOWER(nama_lengkap) LIKE ?', ['%' . $searchLower . '%'])
                                                    ->orWhere('NISN', 'like', "%{$search}%")
                                                    ->orWhereRaw('LOWER(sekolah_asal) LIKE ?', ['%' . $searchLower . '%']);
                    });
                })
                ->select('id_calon_siswa', 'nama_lengkap', 'NISN', 'sekolah_asal', 'jenis_kelamin', 'kota') // Include 'kota'
                ->with(['dataRegistrasi.rapot']) // Ensure related data is loaded
                ->orderBy('id_calon_siswa')
                ->paginate(10)
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function searchNow($value = null)
    {
        $this->search = trim((string) $value);
        $this->resetPage();
    }
}
