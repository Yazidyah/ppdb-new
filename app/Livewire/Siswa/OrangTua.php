<?php

namespace App\Livewire\Siswa;

use Livewire\Component;
use App\Models\CalonSiswa;
use App\Models\OrangTua as ModelsOrangTua;
use App\Models\HubunganOrangTua;
use App\Models\PekerjaanOrangTua;
use Illuminate\Support\Facades\Auth;

class OrangTua extends Component
{
    public $user;
    public $siswa;
    public $forms = [];
    public $orangTua;
    protected $rules = [
        'forms.*.id_hubungan' => 'required|exists:hubungan_orang_tua,id_hubungan',
        'forms.*.nama_lengkap' => 'required|string|max:255',
        'forms.*.nik' => 'required|numeric',
        'forms.*.pekerjaan' => 'required|exists:pekerjaan_orang_tua,id_pekerjaan',
        'forms.*.no_telp' => 'required|numeric',
    ];

    public function mount()
    {
        $this->user = Auth::user();
        $this->siswa = CalonSiswa::where('id_user', $this->user->id)->first();
        $this->orangTua = ModelsOrangTua::firstOrCreate([
            'id_calon_siswa' => $this->user->id,
            'id_hubungan' => 1,
        ]);
        $this->forms[] = $this->initializeForm();
    }

    public function initializeForm()
    {
        return [
            'id_hubungan' => '',
            'nama_lengkap' => '',
            'nik' => '',
            'pekerjaan' => '',
            'no_telp' => '',
            'hubunganOptions' => HubunganOrangTua::orderBy('id_hubungan', 'asc')->get(),
            'pekerjaanOptions' => PekerjaanOrangTua::all(),
        ];
    }

    // public function addForm()
    // {
    //     if (count($this->forms) < 2) {
    //         $this->forms[] = $this->initializeForm();
    //     }
    // }

    // public function updatedForms($value, $name)
    // {
    //     list($index, $field) = explode('.', $name);
    //     $orangTua = ModelsOrangTua::where('id_calon_siswa', $this->siswa->id_calon_siswa)->first();
    //     $orangTua->$field = $value;
    //     $orangTua->save();
    //     if ($field == 'id_hubungan') {
    //         $this->filterPekerjaanOptions($index);
    //     }
    // }

    // public function filterPekerjaanOptions($index)
    // {
    //     $idHubungan = $this->forms[$index]['id_hubungan'];
    //     $this->PekerjaanOrangTua = PekerjaanOrangTua::query()->get();
    //     dd($this->PekerjaanOrangTua);
    //     $this->forms[$index]['pekerjaanOptions'] = PekerjaanOrangTua::when($idHubungan == 2, function ($query) {
    //         return $query->where('id_pekerjaan', '!=', 1);
    //     })->get();
    // }

    public function render()
    {
        return view('livewire.siswa.orang-tua', [
            'forms' => $this->forms,
        ]);
    }
}
