<?php

namespace App\Livewire\Siswa;

use App\Models\CalonSiswa;
use App\Models\KategoriBerkas;
use App\Models\Province;
use App\Models\Regency;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

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
    public $sekolah_asal_enabled = true;
    protected $rules = [
        'nama_lengkap' => 'required|string|max:255',
        'NIK' => 'required|numeric|digits_between:1,16|unique:calon_siswa,NIK',
        'NISN' => 'required|numeric|digits_between:1,10|unique:calon_siswa,NISN',
        'no_telp' => 'required|numeric|digits_between:1,15',
        'jenis_kelamin' => 'required',
        'tanggal_lahir' => 'required|date',
        'tempat_lahir' => 'required|string',
        'sekolah_asal' => 'required|string',
        'status_sekolah' => 'required|string',
        'NPSN' => 'required|numeric|max:8',
        'alamat_domisili' => 'required|string',
        'alamat_kk' => 'required|string',
        'predikat_akreditasi_sekolah' => 'required|string|max:100',
        'nilai_akreditasi_sekolah' => 'required|numeric|max:100',
    ];

    public $messages = [
        'nama_lengkap.required' => 'Nama Lengkap tidak boleh kosong',
        'NIK.required' => 'NIK tidak boleh kosong',
        'NIK.numeric' => 'NIK harus berupa angka',
        'NIK.unique' => 'NIK sudah terdaftar',
        'NISN.required' => 'NISN tidak boleh kosong',
        'NISN.numeric' => 'NISN harus berupa angka',
        'NISN.unique' => 'NISN sudah terdaftar',
        'no_telp.required' => 'No. Telp tidak boleh kosong',
        'no_telp.numeric' => 'No. Telp harus berupa angka',
        'jenis_kelamin.required' => 'Jenis Kelamin tidak boleh kosong',
        'tanggal_lahir.required' => 'Tanggal Lahir tidak boleh kosong',
        'tanggal_lahir.date' => 'Tanggal Lahir harus berupa tanggal',
        'tempat_lahir.required' => 'Tempat Lahir tidak boleh kosong',
        'sekolah_asal.required' => 'Sekolah Asal tidak boleh kosong',
        'NPSN.required' => 'NPSN tidak boleh kosong',
        'NPSN.numeric' => 'NPSN harus berupa angka',
        'NPSN.digits_between' => 'NPSN harus terdiri dari maksimal 8 digit',
        'NPSN.max' => 'NPSN harus terdiri dari maksimal 8 karakter',
        'alamat_domisili.required' => 'Alamat Domisili tidak boleh kosong',
        'alamat_kk.required' => 'Alamat KK tidak boleh kosong',
        'predikat_akreditasi_sekolah.required' => 'Predikat Akreditasi Sekolah tidak boleh kosong',
        'nilai_akreditasi_sekolah.required' => 'Nilai Akreditasi Sekolah tidak boleh kosong',
        'nilai_akreditasi_sekolah.numeric' => 'Nilai Akreditasi Sekolah harus berupa angka',
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
        $this->predikat_akreditasi_sekolah = $this->siswa->predikat_akreditasi_sekolah ?? '';
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
        $this->sekolah_asal_enabled = !empty($this->sekolah_asal);
        $this->alamat_domisili_disabled = $this->getAlamatDomisiliDisabledFromLocalStorage();
    }

    public function updated($propertyName)
    {
        if ($propertyName == 'NIK') {
            $this->validateOnly($propertyName, [
                'NIK' => 'required|numeric|digits_between:1,16|unique:calon_siswa,NIK,' . $this->siswa->id_calon_siswa . ',id_calon_siswa',
            ]);
            $this->siswa->$propertyName = $this->$propertyName ?: null;
            $this->siswa->save();
        }

        if ($propertyName == 'NISN') {
            $this->validateOnly($propertyName, [
                'NISN' => 'required|numeric|digits_between:1,10|unique:calon_siswa,NISN,' . $this->siswa->id_calon_siswa . ',id_calon_siswa',
            ]);
            $this->siswa->$propertyName = $this->$propertyName ?: null;
            $this->siswa->save();
        }

        if ($propertyName != 'NIK' && $propertyName != 'NISN') {
            $this->siswa->$propertyName = $this->$propertyName ?: null;
            $this->siswa->save();
            $this->validateOnly($propertyName);
        }

        // $this->siswa->$propertyName = $this->$propertyName ?: null;
        // $this->siswa->save();
        // $this->validateOnly($propertyName);
        $this->dispatch('biodata-updated', ['complete' => $this->isBiodataComplete()]);
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
        $baseUrl = env('NPSN_API_BASE_URL');
        $url = "{$baseUrl}{$this->NPSN}";
        $data = $this->fetchNpsnFromHtml($url);
        if ($data['npsn']) {
            if (!in_array($data['tingkat_pendidikan'], ['SMP', 'MTs', 'PKBM'])) {
                $this->addError('sekolah_asal', 'Tingkat pendidikan harus SMP atau MTs');
                $this->NPSN = '';
                return;
            }
            if (!$this->getErrorBag()->has('sekolah_asal')) {
                $this->siswa->NPSN = $this->NPSN;
                $this->siswa->status_sekolah = strtolower($data['status_sekolah']);
                $this->siswa->sekolah_asal = strtolower($data['nama_sekolah']);
                $this->sekolah_asal = strtoupper($data['nama_sekolah']);
                $this->sekolah_asal_enabled = true;
                $this->siswa->save();
                $this->resetErrorBag('npsn');
                return redirect()->to(request()->header('Referer'));
            }
        } else {
            $this->addError('NPSN', 'NPSN tidak ditemukan');
            $this->sekolah_asal_enabled = false;
            $this->siswa->NPSN = $this->NPSN;
            $this->siswa->save();
        }
    }

    public function fetchNpsnFromHtml($url)
    {
        $html = file_get_contents($url);
        $dom = new \DOMDocument();
        @$dom->loadHTML($html);
        $xpath = new \DOMXPath($dom);

        $npsnNode = $xpath->query("//a[@class='link1']")->item(0);
        $npsn = $npsnNode ? $npsnNode->nodeValue : null;

        $nameNode = $xpath->query("//td[contains(text(), 'Nama')]/following-sibling::td[2]")->item(0);
        $schoolName = $nameNode ? $nameNode->nodeValue : null;

        $tingkatPendidikanNode = $xpath->query("//td[contains(text(), 'Bentuk Pendidikan')]/following-sibling::td[2]")->item(0);
        $tingkatPendidikan = $tingkatPendidikanNode ? $tingkatPendidikanNode->nodeValue : null;

        $statusSekolahNode = $xpath->query("//td[contains(text(), 'Status Sekolah')]/following-sibling::td[2]")->item(0);
        $statusSekolah = $statusSekolahNode ? $statusSekolahNode->nodeValue : null;

        return [
            'nama_sekolah' => $schoolName,
            'npsn' => $npsn,
            'tingkat_pendidikan' => $tingkatPendidikan,
            'status_sekolah' => $statusSekolah,

        ];
    }

    public function copyAlamatKk()
    {
        $this->alamat_domisili = $this->alamat_kk;
        $this->siswa->alamat_domisili = strtolower($this->alamat_kk);
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
        return $this->nama_lengkap && $this->NIK && $this->NISN && $this->no_telp && $this->jenis_kelamin && $this->tanggal_lahir && $this->tempat_lahir && $this->sekolah_asal && $this->status_sekolah && $this->alamat_kk && $this->alamat_domisili && $this->provinsi && $this->kota && $this->predikat_akreditasi_sekolah && $this->nilai_akreditasi_sekolah;
    }

    public function render()
    {
        return view('livewire.siswa.biodata-siswa');
    }
}
