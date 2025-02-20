<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\OrangTua as ModelsOrangTua;
use App\Models\HubunganOrangTua;
use App\Models\PekerjaanOrangTua;

class OrangTuaForm extends Component
{
    public $orangTua;
    public $id_hubungan, $nama_lengkap, $nik, $pekerjaan = 1, $no_telp;
    public $hubunganOptions;
    public $pekerjaanOptions;

    protected $rules = [
        'id_hubungan' => 'required|exists:hubungan_orang_tua,id_hubungan',
        'nama_lengkap' => 'required|string|max:255',
        'nik' => 'required|numeric',
        'pekerjaan' => 'required',
        'no_telp' => 'required|numeric',
    ];

    public $messages = [
        'nama_lengkap.required' => 'Nama Lengkap tidak boleh kosong',
        'nik.required' => 'NIK tidak boleh kosong',
        'nik.numeric' => 'NIK harus berupa angka',
        'pekerjaan.required' => 'Pekerjaan tidak boleh kosong',
        'no_telp.required' => 'No. Telp tidak boleh kosong',
        'no_telp.numeric' => 'No. Telp harus berupa angka',
    ];


    protected $listeners = [
        'orangtuaAdded' => 'cekOrangTua',
    ];


    public function mount()
    {

        $this->hubunganOptions = HubunganOrangTua::orderBy('id_hubungan', 'asc')->get();
        $this->pekerjaanOptions = PekerjaanOrangTua::query()->when($this->orangTua->id_hubungan != 1, function ($query) {
            return $query->where('id_pekerjaan', '!=', 1);
        })->orderBy('id_pekerjaan', 'asc')->get();
        $this->nama_lengkap = $this->orangTua->nama_lengkap;
        $this->id_hubungan = $this->orangTua->id_hubungan;
        $this->nik = $this->orangTua->nik;
        $this->no_telp = $this->orangTua->no_telp;
    }

    public function cekOrangTua()
    {
        redirect(request()->header('Referer'));
    }
    public function updatedNamaLengkap($value)
    {
        $this->validateOnly('nama_lengkap');
        $this->orangTua->nama_lengkap = $value;
        $this->orangTua->save();
    }

    public function updatedIdHubungan($value)
    {
        $this->validateOnly('id_hubungan');
        $this->orangTua->id_hubungan = $value;
        $this->orangTua->save();
    }

    public function updatedNik($value)
    {
        $this->validateOnly('nik');
        $this->orangTua->nik = $value;
        $this->orangTua->save();
    }

    public function updatedPekerjaan($value)
    {
        $this->validateOnly('pekerjaan');
        $this->orangTua->pekerjaan = $value;
        $this->orangTua->save();
    }

    public function updatedNoTelp($value)
    {
        $this->validateOnly('no_telp');
        $this->orangTua->no_telp = $value;
        $this->orangTua->save();
    }

    public function render()
    {
        return view('livewire.orang-tua-form');
    }
}
