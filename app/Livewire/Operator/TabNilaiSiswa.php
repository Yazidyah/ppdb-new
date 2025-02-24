<?php

namespace App\Livewire\Operator;

use App\Models\DataRegistrasi;
use App\Models\Rapot;
use Livewire\Component;

class TabNilaiSiswa extends Component
{
    public $siswa;
    public $rapot;          // Model Rapot
    public $rapotData;      // Data rapot dalam bentuk array (hasil decode JSON)
    public $averageScores;
    public $grandAverageScore;

    public $data_registrasi;

    public function mount()
    {
        // Ambil data registrasi berdasarkan siswa
        $this->data_registrasi = DataRegistrasi::where('id_calon_siswa', $this->siswa->id_calon_siswa)->first();
    
        // Ambil atau buat data rapot
        $this->rapot = Rapot::firstOrCreate(
            ['id_registrasi' => $this->data_registrasi->id_registrasi],
            ['total_rata_nilai' => 0, 'nilai_rapot' => json_encode([])]
        );
    
        // Cek apakah nilai_rapot berupa string atau array
        if (is_string($this->rapot->nilai_rapot)) {
            $nilaiRapot = json_decode($this->rapot->nilai_rapot, true);
        } else {
            $nilaiRapot = $this->rapot->nilai_rapot;
        }
    
        $this->rapotData = is_array($nilaiRapot) && count($nilaiRapot) ? $nilaiRapot : [];
    
        // Hitung nilai rata-rata per semester
        $this->calculateAverageScores();
        $this->grandAverageScore = $this->rapot->total_rata_nilai;
    }

    // Fungsi untuk menghitung rata-rata per semester
    public function calculateAverageScores()
    {
        $this->averageScores = array_map(function ($rapot) {
            $totalScore = array_sum($rapot['data']);
            $subjectCount = count($rapot['data']);
            return $subjectCount > 0 ? round($totalScore / $subjectCount, 3) : 0;
        }, $this->rapotData);
    }

    // Method untuk menyimpan/update nilai rapot
    public function updateRapot()
    {
        // Hitung ulang rata-rata per semester
        $this->calculateAverageScores();

        // Hitung rata-rata keseluruhan
        $total = array_sum($this->averageScores);
        $count = count($this->averageScores);
        $grandAverage = $count > 0 ? round($total / $count, 3) : 0;

        // Update properti dan model
        $this->grandAverageScore = $grandAverage;
        $this->rapot->total_rata_nilai = $grandAverage;
        $this->rapot->nilai_rapot = json_encode($this->rapotData, JSON_PRETTY_PRINT);
        $this->rapot->save();

        session()->flash('message', 'Nilai rapot berhasil diperbarui.');
    }

    public function render()
    {
        return view('livewire.operator.tab-nilai-siswa', [
            'averageScores' => $this->averageScores,
            'grandAverageScore' => $this->grandAverageScore
        ]);
    }
}
