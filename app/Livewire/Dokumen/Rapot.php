<?php

namespace App\Livewire\Dokumen;

use Livewire\Component;
use App\Models\Rapot as RapotModel;
use App\Models\DataRegistrasi;
use Illuminate\Support\Facades\Auth;

class Rapot extends Component
{
    public $rapot;
    public $user;
    public $dataRegistrasi;
    public $nilai_rapot = [];

    public function mount()
    {
        $this->user = Auth::user();
        $this->dataRegistrasi = DataRegistrasi::where('id_calon_siswa', function ($query) {
            $query->select('id_user')
                ->from('calon_siswa')
                ->where('id_user', $this->user->id)
                ->first();
        })->first();
        // dd($this->dataRegistrasi); 

        $this->rapot = RapotModel::firstOrCreate(
            ['id_registrasi' => $this->dataRegistrasi->id_registrasi],
            ['nilai_rapot' => json_encode([])]
        );

        $this->nilai_rapot = json_decode($this->rapot->nilai_rapot, true);
    }

    public function update()
    {
        $this->validate([
            'nilai_rapot' => 'required|array',
            'nilai_rapot.*.semester' => 'required|integer',
            'nilai_rapot.*.matematika' => 'required|integer',
            'nilai_rapot.*.bahasaindo' => 'required|integer',
            'nilai_rapot.*.pai' => 'required|integer',
            'nilai_rapot.*.bahasainggris' => 'required|integer',
            'nilai_rapot.*.ipa' => 'required|integer',
            'nilai_rapot.*.ips' => 'required|integer',
        ]);

        $this->rapot->update([
            'nilai_rapot' => json_encode($this->nilai_rapot),
        ]);

        session()->flash('message', 'Rapot updated successfully.');
    }

    public function render()
    {
        return view('livewire.dokumen.rapot');
    }
}
