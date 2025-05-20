<?php

namespace App\Livewire\Verifikasi;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\DataRegistrasi;
use App\Models\CalonSiswa;
use App\Helpers\DocumentHelper;
use App\Models\Persyaratan;

class StepEmpat extends Component
{
    public $tab = 1;
    protected $queryString = [
        'tab' => ['except' => 'konsep', 'as' => 't'],
    ];

    public $user;
    public $persyaratan;
    public $isValid = true;

    public function mount()
    {
        $this->user = Auth::user();
        $calonSiswa = CalonSiswa::where('id_user', $this->user->id)->first();
        $dataRegistrasi = DataRegistrasi::where('id_calon_siswa', $calonSiswa->id_calon_siswa)->first();

        if ($dataRegistrasi->status == 3) {
            session()->flash('message', 'Kamu sudah pernah mendaftar');
            return redirect('/siswa/dashboard');
        }
        $idjalur = $dataRegistrasi->id_jalur;
        $this->persyaratan = Persyaratan::where('id_jalur', $idjalur)
            ->orderBy('id_persyaratan', 'asc')
            ->get();
        $this->isSyaratComplete();
    }

    public function updateStatus()
    {
        $calonSiswa = CalonSiswa::where('id_user', $this->user->id)->first();
        $dataRegistrasi = DataRegistrasi::where('id_calon_siswa', $calonSiswa->id_calon_siswa)->first();

        // Update status ke 3
        $dataRegistrasi->status = 3;
        $dataRegistrasi->save();

        // Generate nomor jika status == 3 dan belum punya nomor
        if ($dataRegistrasi->status == 3 && (empty($dataRegistrasi->nomor_peserta) || empty($dataRegistrasi->nomor_suket))) {
            $kodeData = $this->generateNomor($dataRegistrasi->id_jalur, $dataRegistrasi->id_registrasi);
            $dataRegistrasi->nomor_peserta = $kodeData['kodeRegistrasi'];
            $dataRegistrasi->nomor_suket = $kodeData['nomorSuket'];
            $dataRegistrasi->save();
        }

        return redirect('/siswa/dashboard');
    }

    protected function generateNomor($jalurId, $currentId)
    {
        // Ambil semua registrasi status 3 dan sudah punya nomor, urutkan berdasarkan id_registrasi
        if ($jalurId == 1) {
            $registrasiList = DataRegistrasi::where('id_jalur', 1)
                ->where('status', 3)
                ->whereNotNull('nomor_peserta')
                ->orderBy('id_registrasi')
                ->pluck('id_registrasi')
                ->toArray();
        } else {
            $registrasiList = DataRegistrasi::where('id_jalur', '!=', 1)
                ->where('status', 3)
                ->whereNotNull('nomor_peserta')
                ->orderBy('id_registrasi')
                ->pluck('id_registrasi')
                ->toArray();
        }

        // Cari posisi registrasi saat ini di list
        $index = array_search($currentId, $registrasiList);

        // Jika belum ada, berarti ini pendaftar berikutnya
        if ($index === false) {
            $urut = count($registrasiList) + 1;
        } else {
            // Sudah pernah dapat nomor, gunakan urutan yang sama
            $urut = $index + 1;
        }

        $year = date('y');
        $nextYear = date('y', strtotime('+1 year'));
        $registrasi = str_pad($urut, 4, '0', STR_PAD_LEFT);

        if ($jalurId == 1) {
            $kodeRegistrasi = 'R' . $year . $nextYear . $registrasi;
        } else {
            $kodeRegistrasi = 'A' . $year . $nextYear . $registrasi;
        }

        $nomorSuket = $registrasi;

        return ['kodeRegistrasi' => $kodeRegistrasi, 'nomorSuket' => $nomorSuket];
    }

    public function isSyaratComplete()
    {
        foreach ($this->persyaratan as $syarat) {
            if (count($syarat->berkas->where('deleted_at', null)) == 0) {
                $this->isValid = false;
                return false;
            }
            foreach ($syarat->berkas->where('deleted_at', null)->where('uploader_id', $this->user->id) as $berkas) {
                $namaPersyaratan = $berkas->persyaratan->nama_persyaratan ?? 'Tidak diketahui';
                if (str_contains(strtolower($namaPersyaratan), 'kartu keluarga')) {
                    // dd($berkas->data_berkas);
                    if (
                        $berkas->data_berkas == null or $berkas->data_berkas == ''
                    ) {
                        $this->isValid = false;
                        return false;
                    }
                }

                if (str_contains(strtolower($namaPersyaratan), 'nisn')) {
                    if (
                        $berkas->data_berkas == null or $berkas->data_berkas == '' or empty($berkas->data_berkas)
                    ) {
                        $this->isValid = false;
                        return false;
                    }
                }
            }
        }

        $this->isValid = true;
        return true;
    }

    public function render()
    {
        return view('livewire.verifikasi.step-empat')->layout('layouts.apk');
    }
}
