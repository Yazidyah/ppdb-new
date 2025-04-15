<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use App\Models\CalonSiswa;

class SiswaController extends Controller
{
    public function index()
    {
        // Mengambil data user yang sedang login
        $user = Auth::user();
        $calonSiswa = CalonSiswa::with(['dataRegistrasi.jalur', 'dataRegistrasi.jadwalTes'])
            ->where('id_user', $user->id)
            ->first();
    
        $status = ($calonSiswa && $calonSiswa->dataRegistrasi) ? $calonSiswa->dataRegistrasi->status : 0;
        $nomor_peserta = $calonSiswa && $calonSiswa->dataRegistrasi ? $calonSiswa->dataRegistrasi->nomor_peserta : 'Belum tersedia';

        // --- Tahap Daftar Diri ---
        if (isset($status) && $status <= 2) {
            $daftarDiriDetail = [
                0 => 'Mengisi Biodata',
                1 => 'Memilih Jalur Pendaftaran',
                2 => 'Upload Berkas'
            ][$status];
        } else {
            $daftarDiriDetail = 'Selesai';
        }

        // --- Tahap Verifikasi Berkas ---
        if (isset($status) && $status >= 3 && $status <= 5) {
            $verifikasiDetail = [
                3 => 'Berkas Sedang Diverifikasi',
                4 => 'Tidak Lolos Verifikasi Berkas',
                5 => 'Lolos Verifikasi Berkas'
            ][$status];
        } elseif (isset($status) && $status > 5) {
            $verifikasiDetail = 'Lolos Verifikasi Berkas';
        } else {
            $verifikasiDetail = 'Belum dijadwalkan';
        }

        // --- Tahap Tes Wawancara ---
        if (isset($status) && $status >= 5) {
            $tesWawancaraDetail = ($status == 5) ? 'Dijadwalkan' : 'Lolos Tes Wawancara';
        } else {
            $tesWawancaraDetail = 'Belum dijadwalkan';
        }

        // --- Tahap Penetapan Siswa Baru ---
        if (isset($status) && $status >= 6 && $status <= 9) {
            $penetapanDetail = [
                6 => 'Belum Ditentukan',
                7 => 'Tidak Diterima',
                8 => 'Diterima',
                9 => 'Dicadangkan'
            ][$status];
        } else {
            $penetapanDetail = 'Belum ditetapkan';
        }

        if ($status <= 2) {
            $activeStep = 1;
        } elseif ($status >= 3 && $status < 5) {
            $activeStep = 2;
        } elseif ($status == 5) {
            $activeStep = 3;
        } else {
            $activeStep = 4;
        }

        // Kirim data ke view
        return view('siswa.dashboard', compact('calonSiswa', 'daftarDiriDetail', 'verifikasiDetail', 'tesWawancaraDetail', 'penetapanDetail', 'activeStep', 'status', 'nomor_peserta'));
    }
}
