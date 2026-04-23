<?php

namespace App\Livewire\Siswa;

use App\Models\CalonSiswa;
use App\Models\KategoriBerkas;
use App\Models\Province;
use App\Models\Regency;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Services\DataSekolahService;

class BiodataSiswa extends Component
{
    public $user;
    public $siswa;
    public $nama_lengkap, $NIK, $NISN, $no_telp, $jenis_kelamin, $tanggal_lahir, $tempat_lahir, $NPSN, $sekolah_asal, $alamat_domisili, $alamat_kk, $status_sekolah, $predikat_akreditasi_sekolah, $nilai_akreditasi_sekolah;

    public $kb;
    public $provinces;
    public $provinsi;
    public $cities = [];
    public $kota;
    public $searchNpsn;
    public $sekolahs = [];
    public $alamat_domisili_disabled = false;
    public $minTanggalLahir;
    public $maxTanggalLahir;

    protected $rules = [
        'nama_lengkap' => 'required|string|max:255',
        'NIK' => 'required|numeric|digits:16|unique:calon_siswa,NIK',
        'NISN' => 'required|numeric|digits_between:1,10|unique:calon_siswa,NISN',
        'no_telp' => 'required|numeric|digits_between:1,15',
        'jenis_kelamin' => 'required',
        'tanggal_lahir' => 'required|date|before_or_equal:minTanggalLahir|after_or_equal:maxTanggalLahir',
        'tempat_lahir' => 'required|string',
        'sekolah_asal' => 'required|string',
        'NPSN' => 'required|string|max:10|alpha_num',
        'alamat_domisili' => 'required|string',
        'alamat_kk' => 'required|string',
        'predikat_akreditasi_sekolah' => 'required|string',
        'nilai_akreditasi_sekolah' => 'required|numeric|max:100',
    ];

    public $messages = [
        'nama_lengkap.required' => 'Nama Lengkap tidak boleh kosong',
        'NIK.required' => 'NIK tidak boleh kosong',
        'NIK.numeric' => 'NIK harus berupa angka',
        'NIK.digits' => 'NIK harus terdiri dari 16 angka',
        'NIK.unique' => 'NIK sudah terdaftar',
        'NISN.required' => 'NISN tidak boleh kosong',
        'NISN.numeric' => 'NISN harus berupa angka',
        'NISN.unique' => 'NISN sudah terdaftar',
        'no_telp.required' => 'No. Telp tidak boleh kosong',
        'no_telp.numeric' => 'No. Telp harus berupa angka',
        'jenis_kelamin.required' => 'Jenis Kelamin tidak boleh kosong',
        'tanggal_lahir.required' => 'Tanggal Lahir tidak boleh kosong',
        'tanggal_lahir.date' => 'Tanggal Lahir harus berupa tanggal',
        'tanggal_lahir.before_or_equal' => 'Tanggal Lahir harus kurang dari atau sama dengan 13 tahun yang lalu.',
        'tanggal_lahir.after_or_equal' => 'Tanggal Lahir harus lebih dari atau sama dengan 21 tahun yang lalu.',
        'tempat_lahir.required' => 'Tempat Lahir tidak boleh kosong',
        'sekolah_asal.required' => 'Sekolah Asal tidak boleh kosong',
        'NPSN.required' => 'NPSN tidak boleh kosong',
        'NPSN.alpha_num' => 'NPSN hanya boleh berisi huruf dan angka',
        'NPSN.max' => 'NPSN harus terdiri dari maksimal 10 karakter',
        'alamat_domisili.required' => 'Alamat Domisili tidak boleh kosong',
        'alamat_kk.required' => 'Alamat KK tidak boleh kosong',
        'predikat_akreditasi_sekolah.required' => 'Predikat Akreditasi Sekolah tidak boleh kosong',
        'nilai_akreditasi_sekolah.required' => 'Nilai Akreditasi Sekolah tidak boleh kosong',
        'nilai_akreditasi_sekolah.numeric' => 'Nilai Akreditasi Sekolah harus berupa angka',
        'nilai_akreditasi_sekolah.max' => 'Nilai Akreditasi Sekolah tidak boleh lebih dari 100',
    ];

    public function mount()
    {
        $this->kb = KategoriBerkas::where('key', 'test')->first();
        $this->user = Auth::user();
        $this->siswa = CalonSiswa::where('id_user', $this->user->id)->first();
        $this->nama_lengkap = ucwords($this->siswa->nama_lengkap ?? '');
        $this->NIK = $this->siswa->NIK ?? '';
        $this->NISN = $this->siswa->NISN ?? '';
        $this->no_telp = $this->siswa->no_telp ?? '';
        $this->jenis_kelamin = $this->siswa->jenis_kelamin ?? '';
        $this->tanggal_lahir = $this->siswa->tanggal_lahir ?? '';
        $this->tempat_lahir = $this->siswa->tempat_lahir ?? '';
        $this->NPSN = $this->siswa->NPSN ?? '';
        $this->sekolah_asal = strtoupper($this->siswa->sekolah_asal ?? '');
        $this->status_sekolah = strtoupper($this->siswa->status_sekolah ?? '');
        $this->alamat_kk = ucwords($this->siswa->alamat_kk ?? '');
        $this->alamat_domisili = ucwords($this->siswa->alamat_domisili ?? '');
        $this->provinsi = $this->siswa->provinsi ?? '';
        $this->kota = $this->siswa->kota ?? '';
        $this->predikat_akreditasi_sekolah = $this->normalizePredikatAkreditasi($this->siswa->predikat_akreditasi_sekolah ?? '');
        $this->nilai_akreditasi_sekolah = $this->siswa->nilai_akreditasi_sekolah ?? '';
        $this->provinces = Province::all()->map(function ($province) {
            return [
                'id' => (string) $province->id,
                'name' => $province->name
            ];
        });
        $this->provinsi = @Province::where('name', $this->siswa->provinsi)->first()->id ?? '';
        $this->kota = @Regency::where('name', $this->siswa->kota)->first()->id ?? '';
        $this->updateCities();
        $this->alamat_domisili_disabled = $this->getAlamatDomisiliDisabledFromLocalStorage();
        $this->minTanggalLahir = now()->subYears(13)->format('Y-m-d');
        $this->maxTanggalLahir = now()->subYears(21)->format('Y-m-d');
    }

    public function updated($propertyName)
    {
        $this->isBiodataComplete();
        if ($propertyName == 'nama_lengkap') {
            $this->siswa->$propertyName = strtolower($this->$propertyName ?: null);
            $this->dispatch('biodata-updated', ['complete' => $this->isBiodataComplete()]);
            $this->siswa->save();
            $this->validateOnly($propertyName);
            return;
        }

        if ($propertyName == 'NIK') {
            if ($this->$propertyName) {
                // $this->validateOnly($propertyName, [
                //     'NIK' => 'required|numeric|digits:16|unique:calon_siswa,NIK,' . $this->siswa->id_calon_siswa . ',id_calon_siswa',
                // ]);
                $this->siswa->$propertyName = $this->$propertyName;
            } else {
                $this->siswa->$propertyName = null;
            }

            $this->siswa->save();
            $this->dispatch('biodata-updated', ['complete' => $this->isBiodataComplete()]);
            $this->validateOnly($propertyName, [
                'NIK' => 'required|numeric|digits:16|unique:calon_siswa,NIK,' . $this->siswa->id_calon_siswa . ',id_calon_siswa',
            ]);
            return;
        }

        if ($propertyName == 'NISN') {
            $this->siswa->$propertyName = $this->$propertyName ?: null;
            $this->siswa->save();
            $this->dispatch('biodata-updated', ['complete' => $this->isBiodataComplete()]);
            $this->validateOnly($propertyName, [
                'NISN' => 'required|numeric|digits_between:1,10|unique:calon_siswa,NISN,' . $this->siswa->id_calon_siswa . ',id_calon_siswa',
            ]);
        }

        if ($propertyName == 'nilai_akreditasi_sekolah') {
            $this->siswa->$propertyName = $this->$propertyName === '0' ? 0 : ($this->$propertyName ?: null);
            $this->dispatch('biodata-updated', ['complete' => $this->isBiodataComplete()]);
            $this->siswa->save();
            $this->validateOnly($propertyName);
            return;
        }

        if ($propertyName == 'tanggal_lahir') {
            $this->validateOnly($propertyName, [
                'tanggal_lahir' => 'required|date|before_or_equal:' . $this->minTanggalLahir . '|after_or_equal:' . $this->maxTanggalLahir,
            ]);
        }

        if ($propertyName != 'NIK' && $propertyName != 'NISN') {
            $this->siswa->$propertyName = $this->$propertyName ?: null;
            $this->dispatch('biodata-updated', ['complete' => $this->isBiodataComplete()]);
            $this->siswa->save();
            $this->validateOnly($propertyName);
        }

        // $this->siswa->$propertyName = $this->$propertyName ?: null;
        // $this->siswa->save();
        // $this->validateOnly($propertyName);
    }

    public function updateCities() // Add this method
    {
        if ($this->provinsi) {
            $province = Province::find($this->provinsi);
            if ($province) {
                $this->cities = $province->regencies->map(function ($city) {
                    return [
                        'id' => (string) $city->id,
                        'name' => $city->name
                    ];
                });
            }
        } else {
            $this->cities = [];
        }
    }

    public function updatedProvinsi($value)
    {
        $province = Province::find($value);
        if ($province) {
            $this->siswa->provinsi = $province->name;
            $this->siswa->save();
            $this->updateCities();
            $this->updateCities();
        }
    }

    public function updatedKota($value)
    {
        $city = Regency::find($value);
        if ($city) {
            $this->siswa->kota = $city->name;
            $this->siswa->save();
        }
    }


    public function searchByNpsn()
    {
        $this->NPSN = preg_replace('/\s+/', '', $this->NPSN);
        if ($this->NPSN === '' || !preg_match('/^[A-Za-z0-9]{1,10}$/', $this->NPSN)) {
            $this->addError('NPSN', 'NPSN tidak valid. Harus huruf/angka maksimal 10 karakter.');
            return;
        }

        /** @var DataSekolahService $service */
        $service = app(DataSekolahService::class);
        $dataSekolah = $service->getOrFetchByNpsn($this->NPSN);

        if (!$dataSekolah) {
            $this->resetErrorBag(['sekolah_asal']);
            $this->addError('NPSN', 'Referensi sekolah tidak tersedia saat ini dan belum ada di database lokal.');
            return;
        }

        $bentuk = strtoupper(trim((string) ($dataSekolah->bentuk_sekolah ?? '')));
        $allowed = in_array($bentuk, ['SMP', 'MTS'], true);
        if (!$allowed) {
            $this->resetErrorBag(['sekolah_asal']);
            $this->addError('NPSN', 'Masukkan NPSN Sekolah SMP/MTs Sederajat');
            // Reset related fields to avoid persisting invalid school types
            $this->sekolah_asal = '';
            $this->status_sekolah = '';
            $this->siswa->NPSN = null;
            $this->siswa->sekolah_asal = null;
            $this->siswa->status_sekolah = null;
            $this->siswa->save();
            return;
        }

        try {
            $predikatAkreditasi = $this->normalizePredikatAkreditasi($dataSekolah->predikat_akreditasi_sekolah ?? '');

            DB::transaction(function () use ($dataSekolah) {
                $this->siswa->NPSN = $dataSekolah->npsn;
                $this->siswa->status_sekolah = strtolower($dataSekolah->status_sekolah ?? '');  
                $this->siswa->sekolah_asal = strtolower($dataSekolah->sekolah_asal ?? '');
                $this->siswa->predikat_akreditasi_sekolah = $this->normalizePredikatAkreditasi($dataSekolah->predikat_akreditasi_sekolah ?? '');
                $this->siswa->nilai_akreditasi_sekolah = $dataSekolah->nilai_akreditasi_sekolah;
                $this->siswa->save();
            });

            $this->sekolah_asal = strtoupper($dataSekolah->sekolah_asal ?? '');
            $this->status_sekolah = strtoupper($dataSekolah->status_sekolah ?? '');
            $this->predikat_akreditasi_sekolah = $predikatAkreditasi;
            $this->nilai_akreditasi_sekolah = $dataSekolah->nilai_akreditasi_sekolah ?? '';
            $this->dispatch('biodata-updated', ['complete' => $this->isBiodataComplete()]);
        } catch (\Throwable $e) {
            $this->addError('NPSN', 'Data sekolah ditemukan namun penyimpanan biodata gagal.');
        }
    }

    private function normalizePredikatAkreditasi(?string $predikat): string
    {
        $value = strtoupper(trim((string) $predikat));
        if ($value === '') {
            return '';
        }

        if (str_contains($value, 'BELUM')) {
            return 'Belum Terakreditasi';
        }

        if (preg_match('/\bA\b/', $value)) {
            return 'A';
        }
        if (preg_match('/\bB\b/', $value)) {
            return 'B';
        }
        if (preg_match('/\bC\b/', $value)) {
            return 'C';
        }

        // Keep original-ish value so UI can still force-select dynamic option.
        return trim((string) $predikat);
    }

    public function copyAlamatKk()
    {
        $this->alamat_domisili = $this->alamat_kk;
        $this->siswa->alamat_domisili = $this->alamat_kk;
        $this->siswa->save();
    }

    public function toggleAlamatDomisili()
    {
        $this->alamat_domisili_disabled = !$this->alamat_domisili_disabled;
        $this->setAlamatDomisiliDisabledToLocalStorage($this->alamat_domisili_disabled);
        if ($this->alamat_domisili_disabled) {
            $this->copyAlamatKk();
        }
    }

    public function getAlamatDomisiliDisabledFromLocalStorage()
    {
        return json_decode(request()->cookie('alamat_domisili_disabled', 'false'));
    }

    public function setAlamatDomisiliDisabledToLocalStorage($value)
    {
        cookie()->queue('alamat_domisili_disabled', json_encode($value), 60 * 24); // Store for 1 day
    }

    public function isBiodataComplete()
    {
        if (
            $this->nama_lengkap &&
            $this->NIK &&
            $this->NISN &&
            $this->no_telp &&
            $this->jenis_kelamin &&
            $this->tanggal_lahir &&
            $this->tempat_lahir &&
            $this->sekolah_asal &&
            $this->status_sekolah &&
            $this->alamat_kk &&
            $this->alamat_domisili &&
            $this->provinsi &&
            $this->kota &&
            $this->predikat_akreditasi_sekolah &&
            ($this->nilai_akreditasi_sekolah !== null || $this->nilai_akreditasi_sekolah === 0)
            && $this->NISN != null
            && $this->NIK != null
            && preg_match('/^\d{16}$/', $this->NIK)
            && strlen($this->NIK) === 16
            && ctype_digit($this->NIK)
        ) {
            return true;
        } else {
            return false;
        }
        // return $this->nama_lengkap && $this->NIK && $this->NISN && $this->no_telp && $this->jenis_kelamin && $this->tanggal_lahir && $this->tempat_lahir && $this->sekolah_asal && $this->status_sekolah && $this->alamat_kk && $this->alamat_domisili && $this->provinsi && $this->kota && $this->predikat_akreditasi_sekolah && $this->nilai_akreditasi_sekolah;
    }

    public function render()
    {
        return view('livewire.siswa.biodata-siswa');
    }
}
