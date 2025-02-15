<?php

namespace App\Livewire\Dokumen;

use Livewire\Component;
use App\Models\Rapot as RapotModel;
use App\Models\DataRegistrasi;
use App\Models\CalonSiswa;
use Illuminate\Support\Facades\Auth;

class Rapot extends Component
{
    public $rapot;
    public $user;
    public $dataRegistrasi;
    public $id_calon_siswa;
    public $nilai_rapot = [];

    public function mount()
    {
        $this->user = Auth::user();
        $this->id_calon_siswa = CalonSiswa::where('id_user', $this->user->id)->pluck('id_calon_siswa')->first();

        if ($this->id_calon_siswa) {
            $this->dataRegistrasi = DataRegistrasi::where('id_calon_siswa', $this->id_calon_siswa)->first();
            $this->rapot = RapotModel::firstOrCreate(
                ['id_registrasi' => $this->dataRegistrasi->id_registrasi],
                ['nilai_rapot' => json_encode([])]
            );

            $this->nilai_rapot = json_decode($this->rapot->nilai_rapot, true);
        } else {
            // Handle the case where $id_calon_siswa is not found
            session()->flash('error', 'Calon siswa tidak ditemukan.');
        }
    }

    public static function calculateGrandAverageScore($averageScores)
    {
        $totalAverage = array_sum($averageScores);
        $semesterCount = count($averageScores);
        return $semesterCount > 0 ? round($totalAverage / $semesterCount, 3) : 0;
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

        $averageScores = array_map(function ($rapot) {
            $totalScore = array_sum($rapot['data']);
            $subjectCount = count($rapot['data']);
            return $subjectCount > 0 ? round($totalScore / $subjectCount, 3) : 0;
        }, $this->nilai_rapot);

        $grandAverageScore = self::calculateGrandAverageScore($averageScores);

        $this->rapot->update([
            'nilai_rapot' => json_encode($this->nilai_rapot),
            'total_rata_nilai' => $grandAverageScore,
        ]);

        session()->flash('message', 'Rapot updated successfully.');
    }

    public function render()
    {
        return view('livewire.dokumen.rapot');
    }
}
