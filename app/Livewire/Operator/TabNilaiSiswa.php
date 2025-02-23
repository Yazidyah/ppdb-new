<?php

namespace App\Livewire\Operator;

use App\Models\DataRegistrasi;
use Livewire\Component;
use App\Models\Rapot;

class TabNilaiSiswa extends Component
{
    public $siswa;
    public $rapotData;
    public $averageScores;
    public $grandAverageScore;

    public $data_registrasi;

    public function mount()
    {
        $this->data_registrasi = DataRegistrasi::where('id_calon_siswa', $this->siswa->id_calon_siswa)->first();

        $this->rapotData = Rapot::where('id_registrasi', $this->data_registrasi->id_registrasi)->get()->map(function ($rapot) {
            $nilaiRapot = $rapot->nilai_rapot ?? [];
            return array_map(function ($item) {
            return [
                'semester' => $item['semester'] ?? 'Unknown',
                'data' => $item['data'] ?? []
            ];
            }, $nilaiRapot);
        })->flatten(1)->toArray();

        $this->grandAverageScore = Rapot::where('id_registrasi', $this->data_registrasi->id_registrasi)->sum('total_rata_nilai');
        $this->calculateAverageScores();
    }

    private function calculateAverageScores()
    {
        $this->averageScores = array_map(function ($rapot) {
            $totalScore = array_sum($rapot['data']);
            $subjectCount = count($rapot['data']);
            return $subjectCount > 0 ? round($totalScore / $subjectCount, 3) : 0;
        }, $this->rapotData);
    }

    public function render()
    {
        return view('livewire.operator.tab-nilai-siswa', [
            'averageScores' => $this->averageScores,
            'grandAverageScore' => $this->grandAverageScore
        ]);
    }
}
