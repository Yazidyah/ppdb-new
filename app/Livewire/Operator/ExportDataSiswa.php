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
            // ->join('orang_tua as ot', 'cs.id_calon_siswa', '=', 'ot.id_calon_siswa')
            ->leftJoin('orang_tua as ibu', function ($join) {
                $join->on('cs.id_calon_siswa', '=', 'ibu.id_calon_siswa')
                    ->where('ibu.id_hubungan', '=', 1);
            })
            ->leftJoin('pekerjaan_orang_tua as pekerjaan_ibu', 'ibu.pekerjaan', '=', 'pekerjaan_ibu.id_pekerjaan')
            ->leftJoin('orang_tua as ayah', function ($join) {
                $join->on('cs.id_calon_siswa', '=', 'ayah.id_calon_siswa')
                    ->where('ayah.id_hubungan', '=', 2);
            })
            ->leftJoin('pekerjaan_orang_tua as pekerjaan_ayah', 'ayah.pekerjaan', '=', 'pekerjaan_ayah.id_pekerjaan')
            ->leftJoin('orang_tua as wali', function ($join) {
                $join->on('cs.id_calon_siswa', '=', 'wali.id_calon_siswa')
                    ->where('wali.id_hubungan', '=', 3);
            })
            ->leftJoin('pekerjaan_orang_tua as pekerjaan_wali', 'wali.pekerjaan', '=', 'pekerjaan_wali.id_pekerjaan')


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
                'cs.alamat_domisili',
                // orang tua
                'ibu.nama_lengkap as nama_ibu',
                'ibu.nik as NIK_ibu',
                'pekerjaan_ibu.nama_pekerjaan as pekerjaan_ibu',
                'ibu.no_telp as no_telp_ibu',
                'ayah.nama_lengkap as nama_ayah',
                'pekerjaan_ayah.nama_pekerjaan as pekerjaan_ayah',
                'ayah.nik as NIK_ayah',
                'ayah.no_telp as no_telp_ayah',
                // wali
                'wali.nama_lengkap as nama_wali',
                'wali.nik as NIK_wali',
                'pekerjaan_wali.nama_pekerjaan as pekerjaan_wali',
                'wali.no_telp as no_telp_wali',
            )
            ->get();
        // dd($siswa);
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
                'Ayah' => $s->nama_ayah,
                'Pekerjaan Ayah' => $s->pekerjaan_ayah,
                'NIK Ayah' => $s->NIK_ayah,
                'Telp Ayah' => $s->no_telp_ayah,
                'Ibu' => $s->nama_ibu,
                'Pekerjaan Ibu' => $s->pekerjaan_ibu,
                'NIK Ibu' => $s->NIK_ibu,
                'Telp Ibu' => $s->no_telp_ibu,
                'Wali' => $s->nama_wali,
                'Pekerjaan Wali' => $s->pekerjaan_wali,
                'NIK Wali' => $s->NIK_wali,
                'Telp Wali' => $s->no_telp_wali,
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
