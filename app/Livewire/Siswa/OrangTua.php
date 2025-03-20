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
        $this->orangTua = ModelsOrangTua::where('id_calon_siswa', $this->siswa->id_calon_siswa)->get();

        if ($this->siswa != null) {
            if ($this->orangTua->where('id_hubungan', 1)->isEmpty()) {
                ModelsOrangTua::create([
                    'id_calon_siswa' => $this->siswa->id_calon_siswa,
                    'id_hubungan' => 1,
                    'pekerjaan' => 1,
                ]);
            }
            if ($this->orangTua->where('id_hubungan', 2)->isEmpty()) {
                ModelsOrangTua::create([
                    'id_calon_siswa' => $this->siswa->id_calon_siswa,
                    'id_hubungan' => 2,
                    'pekerjaan' => 2,   
                ]);
            }
            $this->orangTua = ModelsOrangTua::where('id_calon_siswa', $this->siswa->id_calon_siswa)->get();
        }
    }

    public function tambahOrtu()
    {
        ModelsOrangTua::create([
            'id_calon_siswa' => $this->siswa->id_calon_siswa,
            'id_hubungan' => 3,
        ]);

        $this->orangTua = ModelsOrangTua::where('id_calon_siswa', $this->siswa->id_calon_siswa)->get();
        $this->dispatch('orangtuaAdded');
    }

    public function render()
    {
        return view('livewire.siswa.orang-tua', [
            'forms' => $this->forms,
        ]);
    }
}
