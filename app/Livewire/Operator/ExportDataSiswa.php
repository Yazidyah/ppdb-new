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
            ->leftJoin('data_registrasi as dr', 'cs.id_calon_siswa', '=', 'dr.id_calon_siswa')
            ->leftJoin('jalur_registrasi as jr', 'dr.id_jalur', '=', 'jr.id_jalur')
            ->join('users as u', 'cs.id_user', '=', 'u.id')
            // ->whereNull('u.deleted_at')
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
            ->leftJoin('rapot as rp', 'dr.id_registrasi', '=', 'rp.id_registrasi')
            ->leftJoin('data_registrasi as ds', 'cs.id_calon_siswa', '=', 'ds.id_calon_siswa')
            ->leftJoin('persyaratan as ps', function ($join) {
                $join->on('ds.id_registrasi', '=', 'ps.id_jalur')
                    ->where('ps.nama_persyaratan', 'ilike', '%kartu keluarga%');
            })
            ->leftJoin('berkas as br', function ($join) {
                $join->on('br.id_syarat', '=', 'ps.id_persyaratan')
                    ->where('br.deleted_at', null);
            })
            ->whereNull('cs.deleted_at', 'u.deleted_at')
            // ->where('ps.nama_persyaratan', 'ilike', '%kartu keluarga%')

            ->select(
                'cs.id_calon_siswa',
                'cs.id_user',
                'jr.nama_jalur',
                'cs.nama_lengkap',
                'dr.nomor_peserta',
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
                'cs.nilai_akreditasi_sekolah',
                'cs.predikat_akreditasi_sekolah',
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
                //no kk
                'br.data_berkas as no_kk',
                // rapot sem 3
                'rp.nilai_rapot->0->data->matematika as mat_3',
                'rp.nilai_rapot->0->data->bahasa_indonesia as bind_3',
                'rp.nilai_rapot->0->data->bahasa_inggris as eng_3',
                'rp.nilai_rapot->0->data->pai as pai_3',
                'rp.nilai_rapot->0->data->ipa as ipa_3',
                'rp.nilai_rapot->0->data->ips as ips_3',
                // rapot sem 4
                'rp.nilai_rapot->1->data->matematika as mat_4',
                'rp.nilai_rapot->1->data->bahasa_indonesia as bind_4',
                'rp.nilai_rapot->1->data->bahasa_inggris as eng_4',
                'rp.nilai_rapot->1->data->pai as pai_4',
                'rp.nilai_rapot->1->data->ipa as ipa_4',
                'rp.nilai_rapot->1->data->ips as ips_4',
                // rapot sem 5
                'rp.nilai_rapot->2->data->bahasa_indonesia as bind_5',
                'rp.nilai_rapot->2->data->matematika as mat_5',
                'rp.nilai_rapot->2->data->bahasa_inggris as eng_5',
                'rp.nilai_rapot->2->data->pai as pai_5',
                'rp.nilai_rapot->2->data->ipa as ipa_5',
                'rp.nilai_rapot->2->data->ips as ips_5',
            )
            ->get();

        // dd($siswa);

        foreach ($siswa as $index => $s) {
            // dd($s);
            $exportedCollection->push([
                'No' => $index + 1,
                'Jalur' => $s->nama_jalur,
                'NISN' => $s->NISN,
                'No. Pendaftaran' => $s->nomor_peserta,
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
                'Ayah' => @$s->nama_ayah,
                'Pekerjaan Ayah' => @$s->pekerjaan_ayah,
                'NIK Ayah' => @$s->NIK_ayah,
                'Telp Ayah' => @$s->no_telp_ayah,
                'Ibu' => @$s->nama_ibu,
                'Pekerjaan Ibu' => @$s->pekerjaan_ibu,
                'NIK Ibu' => @$s->NIK_ibu,
                'Telp Ibu' => @$s->no_telp_ibu,
                'Wali' => @$s->nama_wali,
                'Pekerjaan Wali' => @$s->pekerjaan_wali,
                'NIK Wali' => @$s->NIK_wali,
                'Telp Wali' => @$s->no_telp_wali,
                'No KK' => @$s->no_kk,
                'Akreditasi Sekolah (Nilai)' => @$s->nilai_akreditasi_sekolah,
                'Akreditasi Sekolah (Predikat)' => @$s->predikat_akreditasi_sekolah,
                'Posisi' => '',
                'Status Verifikasi' => '',
                'Status Penerimaan' => '',
                'Nomor Suket' => '',
                'Eng 3' => @$s->eng_3,
                'Mat 3' => @$s->mat_3,
                'Ind 3' => @$s->bind_3,
                'IPA 3' => @$s->ipa_3,
                'IPS 3' => @$s->ips_3,
                'PAI 3' => @$s->pai_3,
                'Eng 4' => @$s->eng_4,
                'Mat 4' => @$s->mat_4,
                'Ind 4' => @$s->bind_4,
                'IPA 4' => @$s->ipa_4,
                'IPS 4' => @$s->ips_4,
                'PAI 4' => @$s->pai_4,
                'Eng 5' => @$s->eng_5,
                'Mat 5' => @$s->mat_5,
                'Ind 5' => @$s->bind_5,
                'IPA 5' => @$s->ipa_5,
                'IPS 5' => @$s->ips_5,
                'PAI 5' => @$s->pai_5,
            ]);
        }
        return Excel::download(new PendaftaranExport($exportedCollection), 'data-pendaftaran-' . now()->timestamp . '.xlsx');
    }
    public function render()
    {
        return view('livewire.operator.export-data-siswa');
    }
}
