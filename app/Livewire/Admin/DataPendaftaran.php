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
                ->orderBy('id_calon_siswa')
                ->paginate(5)
        ]);
    }
}
