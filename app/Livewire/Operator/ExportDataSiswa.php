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
            ->join('users as u', 'cs.id_user', '=', 'u.id')
            ->select(
                'cs.id_calon_siswa',
                'cs.id_user',
                'jr.nama_jalur',
                'cs.nama_lengkap',
                'dr.kode_registrasi',
                'cs.NISN',
                'cs.sekolah_asal',
                'cs.nama_lengkap',
                'cs.tempat_lahir',
                'cs.tanggal_lahir',
                'u.email',
                'cs.no_telp',
                'cs.NIK',
                'cs.jenis_kelamin',
                'cs.alamat_kk',
                'cs.alamat_domisili'
            )
            ->get();
        foreach ($siswa as $index => $s) {
            // dd($s);
            $exportedCollection->push([
                'No' => $index + 1,
                'Jalur' => $s->nama_jalur,
                'NISN' => $s->NISN,
                'No. Pendaftaran' => $s->kode_registrasi,
                'Sekolah Asal' => $s->sekolah_asal,
                'Nama' => $s->nama_lengkap,
                'POB' => $s->tempat_lahir,
                'DOB' => \Carbon\Carbon::parse($s->tanggal_lahir)->format('d-m-Y'),
                'Email' => $s->email,
                'Telp' => $s->no_telp,
                'NIK' => $s->NIK,
                'Gender' => $s->jenis_kelamin,
                'Alamat' => $s->alamat_kk,
                'Domisili' => $s->alamat_domisili,
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
