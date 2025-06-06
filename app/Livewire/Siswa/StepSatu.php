<?php

namespace App\Livewire\Siswa;

use App\Models\CalonSiswa;
use App\Models\DataRegistrasi;
use App\Models\OrangTua;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class StepSatu extends Component
{
    public $tab = 1;
    public $siswa;
    public $user;
    public $orangTua;
    public $regis;
    public $isCompleteBiodata = false;
    public $isCompleteOrangtua = false;
    protected $queryString = [
        'tab' => ['except' => 'konsep', 'as' => 't'],
    ];

    #[On('biodata-updated')]
    public function mount()
    {
        $this->initializeUser();
        $this->initializeSiswa();
        $this->checkRegistrationStatus();
        $this->initializeOrangTua();
        $this->isBiodataComplete();
        $this->isOrangtuaComplete();
    }

    public function initializeUser()
    {
        $this->user = Auth::user();
        if ($this->user->siswa == null) {
            $calonSiswa = CalonSiswa::create([
                'id_user' => $this->user->id,
            ]);
            $this->user->siswa()->associate($calonSiswa);
            $this->user->save();
        }

        if ($this->user->siswa && $this->user->siswa->dataRegistrasi == null) {
            $this->regis = DataRegistrasi::firstOrCreate(
                ['id_calon_siswa' => $this->user->siswa->id_calon_siswa],
                ['status' => '0']
            );
        }
    }


    public function initializeSiswa()
    {
        $this->siswa = CalonSiswa::where('id_user', $this->user->id)->first();
        if ($this->siswa == null) {
            $this->siswa = CalonSiswa::create([
                'id_user' => $this->user->id,
            ]);
        }
    }

    public function checkRegistrationStatus()
    {
        if (!$this->siswa || !$this->siswa->dataRegistrasi) {
            return;
        }

        $status = $this->siswa->dataRegistrasi->status;

        if ($status == 1) {
            return redirect()->to('/siswa/daftar-step-dua?t=1');
        } elseif ($status == 2) {
            return redirect()->to('/siswa/daftar-step-tiga?t=1');
        } elseif ($status >= 3) {
            session()->flash('message', 'Kamu sudah pernah mendaftar');
            return redirect()->to('/siswa/dashboard');
        }
    }

    public function initializeOrangTua()
    {
        $this->orangTua = OrangTua::where('id_calon_siswa', $this->siswa->id_calon_siswa)->first();
        if ($this->orangTua == null) {
            $this->orangTua = OrangTua::create([
                'id_calon_siswa' => $this->siswa->id_calon_siswa,
                'id_hubungan' => 1,
                'pekerjaan' => 1,
            ]);
        }
    }

    #[On('biodata-updated')]
    public function isBiodataComplete()
    {
        $siswa = $this->siswa;
        if (
            $siswa->nama_lengkap &&
            $siswa->NIK &&
            $siswa->NISN &&
            $siswa->no_telp &&
            $siswa->jenis_kelamin &&
            $siswa->tanggal_lahir &&
            $siswa->tempat_lahir &&
            $siswa->sekolah_asal &&
            $siswa->status_sekolah &&
            $siswa->alamat_kk &&
            $siswa->alamat_domisili &&
            $siswa->provinsi &&
            $siswa->kota &&
            $siswa->predikat_akreditasi_sekolah &&
            ($siswa->nilai_akreditasi_sekolah !== null || $siswa->nilai_akreditasi_sekolah === 0)
            && $siswa->NISN != null
            && $siswa->NIK != null
            && preg_match('/^\d{16}$/', $siswa->NIK)
            && strlen($siswa->NIK) === 16
            && ctype_digit($siswa->NIK)
        ) {
            $this->isCompleteBiodata = true;
        } else {
            $this->isCompleteBiodata = false;
        }
    }

    #[On('orangtua-updated')]
    public function isOrangtuaComplete()
    {
        $ibu = $this->siswa->ortu->where('id_hubungan', 1)->first();
        $ayah = $this->siswa->ortu->where('id_hubungan', 2)->first();

        if ($ibu->nama_lengkap && $ibu->nik && $ibu->pekerjaan && $ibu->no_telp && $ayah->nama_lengkap && $ayah->nik && $ayah->pekerjaan && $ayah->no_telp && $ibu->nama_lengkap != '' && $ibu->nik != '' && $ibu->pekerjaan != '' && $ibu->no_telp != '' && $ayah->nama_lengkap != '' && $ayah->nik != '' && $ayah->pekerjaan != '' && $ayah->no_telp != '') {
            $this->isCompleteOrangtua = true;
        } else {
            $this->isCompleteOrangtua = false;
        }
    }



    public function render()
    {
        return view('livewire.siswa.step-satu');
    }
}
