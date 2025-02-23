<?php

namespace App\Livewire\Operator;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PendaftaranExport;

class ExportDataSiswa extends Component
{
    public function unduh()
    {
        ini_set('max_execution_time', 180);
        $exportedCollection = collect();

        $siswa = DB::table('calon_siswa as cs')
            ->join('data_registrasi as dr', 'cs.id_calon_siswa', '=', 'dr.id_calon_siswa')
            ->join('jalur_registrasi as jr', 'dr.id_jalur', '=', 'jr.id_jalur')
            ->select(
                'cs.id_calon_siswa',
                'cs.id_user',
                'jr.nama_jalur',
                'cs.nama_lengkap',
            )
            ->get();
        foreach ($siswa as $index => $s) {
            $exportedCollection->push([
                'No' => $index + 1,
                // Add other fields as necessary
            ]);
        }
        return Excel::download(new PendaftaranExport($exportedCollection), 'data-pendaftaran-' . now()->timestamp . '.xlsx');
    }
    public function render()
    {
        return view('livewire.operator.export-data-siswa');
    }
}
