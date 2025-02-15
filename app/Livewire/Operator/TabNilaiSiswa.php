<?php

namespace App\Livewire\Operator;

use Livewire\Component;
use App\Models\Rapot;

class TabNilaiSiswa extends Component
{
    public $rapotData;
    public $averageScores;
    public $grandAverageScore;

    public function mount()
    {
        $this->rapotData = Rapot::all()->map(function ($rapot) {
            $nilaiRapot = $rapot->nilai_rapot;
            return array_map(function ($item) {
                return [
                    'semester' => $item['semester'] ?? 'Unknown',
                    'data' => $item['data'] ?? []
                ];
            }, $nilaiRapot);
        })->flatten(1)->toArray();

        $this->calculateAverageScores();
        $this->calculateGrandAverageScore();
    }

    private function calculateAverageScores()
    {
        $this->averageScores = array_map(function ($rapot) {
            $totalScore = array_sum($rapot['data']);
            $subjectCount = count($rapot['data']);
            return $subjectCount > 0 ? round($totalScore / $subjectCount, 3) : 0;
        }, $this->rapotData);
    }

    private function calculateGrandAverageScore()
    {
        $totalAverage = array_sum($this->averageScores);
        $semesterCount = count($this->averageScores);
        $this->grandAverageScore = $semesterCount > 0 ? round($totalAverage / $semesterCount, 3) : 0;
    }

    public function render()
    {
        return view('livewire.operator.tab-nilai-siswa', [
            'averageScores' => $this->averageScores,
            'grandAverageScore' => $this->grandAverageScore
        ]);
    }
}
