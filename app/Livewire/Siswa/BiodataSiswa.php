<?php

namespace App\Livewire\Siswa;

use App\Models\CalonSiswa;
use App\Models\KategoriBerkas;
use App\Models\Province;
use App\Models\Regency;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Http; // Add this line

class BiodataSiswa extends Component
{
    public $user;
    public $siswa;
    public $nama_lengkap, $nik, $nisn, $no_telp, $jenis_kelamin, $tanggal_lahir, $tempat_lahir, $npsn, $sekolah_asal, $alamat_domisili, $alamat_kk;

    public $kb;
    public $provinces;
    public $provinsi;
    public $cities = [];
    public $kota;
    public $searchNpsn;
    public $sekolahs = [];
    protected $rules = [
        'nama_lengkap' => 'required|string|max:255',
        'nik' => 'required|numeric',
        'nisn' => 'required|numeric',
        'no_telp' => 'required|numeric',
        'jenis_kelamin' => 'required',
        'tanggal_lahir' => 'required|date',
        'tempat_lahir' => 'required|string',
        'sekolah_asal' => 'required|string',
        'npsn' => 'required|numeric',
        'alamat_domisili' => 'required|string',
        'alamat_kk' => 'required|string',
    ];

    public $messages = [
        'nama_lengkap.required' => 'Nama Lengkap tidak boleh kosong',
        'nik.required' => 'NIK tidak boleh kosong',
        'nik.numeric' => 'NIK harus berupa angka',
        'nisn.required' => 'NISN tidak boleh kosong',
        'nisn.numeric' => 'NISN harus berupa angka',
        'no_telp.required' => 'No. Telp tidak boleh kosong',
        'no_telp.numeric' => 'No. Telp harus berupa angka',
        'jenis_kelamin.required' => 'Jenis Kelamin tidak boleh kosong',
        'tanggal_lahir.required' => 'Tanggal Lahir tidak boleh kosong',
        'tanggal_lahir.date' => 'Tanggal Lahir harus berupa tanggal',
        'tempat_lahir.required' => 'Tempat Lahir tidak boleh kosong',
        'sekolah_asal.required' => 'Sekolah Asal tidak boleh kosong',
        'npsn.required' => 'NPSN tidak boleh kosong',
        'npsn.numeric' => 'NPSN harus berupa angka',
        'alamat_domisili.required' => 'Alamat Domisili tidak boleh kosong',
        'alamat_kk.required' => 'Alamat KK tidak boleh kosong',
    ];

    public function mount()
    {
        $this->kb = KategoriBerkas::where('key', 'test')->first();
        // dd($this->kb);

        $this->user = Auth::user();
        $this->siswa = CalonSiswa::where('id_user', $this->user->id)->first();
        $this->nama_lengkap = $this->siswa->nama_lengkap ?? '';
        $this->nik = $this->siswa->NIK ?? '';
        $this->nisn = $this->siswa->NISN ?? '';
        $this->no_telp = $this->siswa->no_telp ?? '';
        $this->jenis_kelamin = $this->siswa->jenis_kelamin ?? '';
        $this->tanggal_lahir = $this->siswa->tanggal_lahir ?? '';
        $this->tempat_lahir = $this->siswa->tempat_lahir ?? '';
        $this->npsn = $this->siswa->NPSN ?? '';
        $this->sekolah_asal = $this->siswa->sekolah_asal ?? '';
        $this->alamat_domisili = $this->siswa->alamat_domisili ?? '';
        $this->alamat_kk = $this->siswa->alamat_kk ?? '';
        $this->provinsi = $this->siswa->provinsi ?? '';
        $this->kota = $this->siswa->kota ?? '';
        $this->provinces = Province::all()->map(function ($province) {
            return [
                'id' => (string) $province->id,
                'name' => $province->name
            ];
        });
        $this->provinsi = @Province::where('name', $this->siswa->provinsi)->first()->id ?? '';
        $this->kota = @Regency::where('name', $this->siswa->kota)->first()->id ?? '';
        $this->updateCities();
    }

    public function updatedNamaLengkap($value)
    {
        $this->validateOnly('nama_lengkap');
        $this->siswa->nama_lengkap = $value;
        $this->siswa->save();
    }

    public function updatedNik($value)
    {
        $this->validateOnly('nik');
        $this->siswa->NIK = $value;
        $this->siswa->save();
    }

    public function updatedNisn($value)
    {
        $this->validateOnly('nisn');
        $this->siswa->NISN = $value;
        $this->siswa->save();
    }

    public function updatedNoTelp($value)
    {
        $this->validateOnly('no_telp');
        $this->siswa->no_telp = $value;
        $this->siswa->save();
    }

    public function updatedSekolahAsal($value)
    {
        $this->validateOnly('sekolah_asal');
        $this->siswa->sekolah_asal = $value;
        $this->siswa->save();
    }

    public function updatedAlamatDomisili($value)
    {
        $this->validateOnly('alamat_domisili');
        $this->siswa->alamat_domisili = $value;
        $this->siswa->save();
    }

    public function updatedAlamatKk($value)
    {
        $this->validateOnly('alamat_kk');
        $this->siswa->alamat_kk = $value;
        $this->siswa->save();
    }

    public function updatedJenisKelamin($value)
    {
        $this->siswa->jenis_kelamin = $value;
        $this->siswa->save();
    }

    public function updatedTanggalLahir($value)
    {
        $this->validateOnly('tanggal_lahir');
        $this->siswa->tanggal_lahir = $value;
        $this->siswa->save();
    }

    public function updatedTempatLahir($value)
    {
        $this->validateOnly('tempat_lahir');
        $this->siswa->tempat_lahir = $value;
        $this->siswa->save();
    }

    public function updatedProvinsi($value)
    {
        $province = Province::find($value);
        if ($province) {
            $this->siswa->provinsi = $province->name;
            $this->siswa->save();
            $this->updateCities();
        }
    }

    public function updatedKota($value) // Add this method
    {
        $city = Regency::find($value);
        if ($city) {
            $this->siswa->kota = $city->name;
            $this->siswa->save();
        }
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

    public function searchByNpsn()
    {
        $baseUrl = env('NPSN_API_BASE_URL');
        $url = "{$baseUrl}{$this->npsn}";
        $data = $this->fetchNpsnFromHtml($url);
        if ($data['npsn']) {
            if (!in_array($data['tingkat_pendidikan'], ['SMP', 'MTs'])) {
                $this->addError('sekolah_asal', 'Tingkat pendidikan harus SMP atau MTs');
                $this->npsn = '';
                return;
            }
            if (!$this->getErrorBag()->has('sekolah_asal')) {
                $this->siswa->NPSN = $this->npsn;
                $this->siswa->sekolah_asal = $data['nama_sekolah'];
                $this->sekolah_asal = $data['nama_sekolah'];
                $this->siswa->save();
                // $this->updatedSekolahAsal($data['nama_sekolah']);
            }
        } else {
            $this->addError('npsn', 'NPSN not found');
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

        return [
            'nama_sekolah' => $schoolName,
            'npsn' => $npsn,
            'tingkat_pendidikan' => $tingkatPendidikan,
        ];
    }

    public function render()
    {
        return view('livewire.siswa.biodata-siswa');
    }
}
