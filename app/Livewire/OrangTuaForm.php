<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\OrangTua as ModelsOrangTua;
use App\Models\HubunganOrangTua;
use App\Models\PekerjaanOrangTua;

class OrangTuaForm extends Component
{
    public $index;
    public $id_hubungan, $nama_lengkap, $nik, $pekerjaan, $no_telp;
    public $hubunganOptions;
    public $pekerjaanOptions;

    protected $rules = [
        'id_hubungan' => 'required|exists:hubungan_orang_tua,id_hubungan',
        'nama_lengkap' => 'required|string|max:255',
        'nik' => 'required|numeric',
        'pekerjaan' => 'required|exists:pekerjaan_orang_tua,id_pekerjaan',
        'no_telp' => 'required|numeric',
    ];

    public function mount($index)
    {
        $this->index = $index;
        $this->hubunganOptions = HubunganOrangTua::orderBy('id_hubungan', 'asc')->get();
        $this->pekerjaanOptions = PekerjaanOrangTua::all();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.orang-tua-form');
    }
}
