<?php

namespace App\Livewire;

use Livewire\Attributes\On;
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
        'nik' => 'required|digits:16',
        'pekerjaan' => 'required',
        'no_telp' => 'required|numeric',
    ];

    public $messages = [
        'nama_lengkap.required' => 'Nama Lengkap tidak boleh kosong',
        'nik.required' => 'NIK tidak boleh kosong',
        'nik.numeric' => 'NIK harus berupa angka',
        'nik.digits' => 'NIK harus terdiri dari 16 angka',
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
        $this->pekerjaanOptions = PekerjaanOrangTua::query()
            ->when($this->orangTua->id_hubungan != 1, function ($query) {
                return $query->where('id_pekerjaan', '!=', 1);
            })
            ->orderBy('id_pekerjaan', 'asc')
            ->get();
        $this->nama_lengkap = $this->orangTua->nama_lengkap;
        $this->id_hubungan = $this->orangTua->id_hubungan;
        $this->nik = $this->orangTua->nik;
        $this->pekerjaan = $this->orangTua->pekerjaan;
        $this->no_telp = $this->orangTua->no_telp;
    }

    #[On('orangtuaAdded')]
    public function cekOrangTua()
    {
        redirect(request()->header('Referer'));
    }

    public function updated($propertyName)
    {
        $this->orangTua->$propertyName = $this->$propertyName;
        $this->orangTua->save();

        $this->dispatch('orangtua-updated', ['complete' => $this->isOrangTuaComplete()]);
        $this->validateOnly($propertyName);
    }

    public function isOrangTuaComplete()
    {
        $orangTua = $this->orangTua;
        if ($orangTua->nama_lengkap && $orangTua->nik && $orangTua->pekerjaan && $orangTua->no_telp && $orangTua->nama_lengkap != '' && $orangTua->nik != '' && $orangTua->pekerjaan != '' && $orangTua->no_telp != '') {
            return true;
        } else {
            return false;
        }
    }
    // public function updatedNamaLengkap($value)
    // {
    //     $this->validateOnly('nama_lengkap');
    //     $this->orangTua->nama_lengkap = $value;
    //     $this->orangTua->save();
    // }

    // public function updatedIdHubungan($value)
    // {
    //     $this->validateOnly('id_hubungan');
    //     $this->orangTua->id_hubungan = $value;
    //     $this->orangTua->save();
    // }

    // public function updatedNik($value)
    // {
    //     $this->validateOnly('nik');
    //     $this->orangTua->nik = $value;
    //     $this->orangTua->save();
    // }

    // public function updatedPekerjaan($value)
    // {
    //     $this->validateOnly('pekerjaan');
    //     $this->orangTua->pekerjaan = $value;
    //     $this->orangTua->save();
    // }

    // public function updatedNoTelp($value)
    // {
    //     $this->validateOnly('no_telp');
    //     $this->orangTua->no_telp = $value;
    //     $this->orangTua->save();
    // }

    public function render()
    {
        return view('livewire.orang-tua-form');
    }
}
