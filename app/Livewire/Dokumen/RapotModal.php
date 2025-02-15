<?php

namespace App\Livewire\Dokumen;

use App\Models\Rapot;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RapotModal extends Component
{
    public $modalSubmit = false;
    public $sem;
    public $t;
    public $rapot;
    public $user;
    public $matematika1, $matematika2, $matematika3, $matematika4, $matematika5;
    public $bahasa_indonesia1, $bahasa_indonesia2, $bahasa_indonesia3, $bahasa_indonesia4, $bahasa_indonesia5;
    public $bahasa_inggris1, $bahasa_inggris2, $bahasa_inggris3, $bahasa_inggris4, $bahasa_inggris5;
    public $pai1, $pai2, $pai3, $pai4, $pai5;
    public $ipa1, $ipa2, $ipa3, $ipa4, $ipa5;
    public $ips1, $ips2, $ips3, $ips4, $ips5;
    protected $queryString = [
        'sem' => ['except' => 1],
        't' => ['except' => 1],
    ];

    public function mount()
    {
        $this->user = Auth::user();
        $this->sem = request()->query('sem', 1);
        $this->t = request()->query('t', 1);
        $this->rapot = $this->user->siswa->dataRegistrasi->rapot;
        if ($this->rapot->nilai_rapot) {
            $rapot = is_string($this->rapot->nilai_rapot) ? json_decode($this->rapot->nilai_rapot, true) : $this->rapot->nilai_rapot;
            $this->initializeRapotValues($rapot);
        }
    }

    private function initializeRapotValues($rapot)
    {
        $this->matematika1 = (float)($rapot[0]['data']['matematika'] ?? 0);
        $this->matematika2 = (float)($rapot[1]['data']['matematika'] ?? 0);
        $this->matematika3 = (float)($rapot[2]['data']['matematika'] ?? 0);
        $this->matematika4 = (float)($rapot[3]['data']['matematika'] ?? 0);
        $this->matematika5 = (float)($rapot[4]['data']['matematika'] ?? 0);
        $this->bahasa_indonesia1 = (float)($rapot[0]['data']['bahasa_indonesia'] ?? 0);
        $this->bahasa_indonesia2 = (float)($rapot[1]['data']['bahasa_indonesia'] ?? 0);
        $this->bahasa_indonesia3 = (float)($rapot[2]['data']['bahasa_indonesia'] ?? 0);
        $this->bahasa_indonesia4 = (float)($rapot[3]['data']['bahasa_indonesia'] ?? 0);
        $this->bahasa_indonesia5 = (float)($rapot[4]['data']['bahasa_indonesia'] ?? 0);
        $this->bahasa_inggris1 = (float)($rapot[0]['data']['bahasa_inggris'] ?? 0);
        $this->bahasa_inggris2 = (float)($rapot[1]['data']['bahasa_inggris'] ?? 0);
        $this->bahasa_inggris3 = (float)($rapot[2]['data']['bahasa_inggris'] ?? 0);
        $this->bahasa_inggris4 = (float)($rapot[3]['data']['bahasa_inggris'] ?? 0);
        $this->bahasa_inggris5 = (float)($rapot[4]['data']['bahasa_inggris'] ?? 0);
        $this->pai1 = (float)($rapot[0]['data']['pai'] ?? 0);
        $this->pai2 = (float)($rapot[1]['data']['pai'] ?? 0);
        $this->pai3 = (float)($rapot[2]['data']['pai'] ?? 0);
        $this->pai4 = (float)($rapot[3]['data']['pai'] ?? 0);
        $this->pai5 = (float)($rapot[4]['data']['pai'] ?? 0);
        $this->ipa1 = (float)($rapot[0]['data']['ipa'] ?? 0);
        $this->ipa2 = (float)($rapot[1]['data']['ipa'] ?? 0);
        $this->ipa3 = (float)($rapot[2]['data']['ipa'] ?? 0);
        $this->ipa4 = (float)($rapot[3]['data']['ipa'] ?? 0);
        $this->ipa5 = (float)($rapot[4]['data']['ipa'] ?? 0);
        $this->ips1 = (float)($rapot[0]['data']['ips'] ?? 0);
        $this->ips2 = (float)($rapot[1]['data']['ips'] ?? 0);
        $this->ips3 = (float)($rapot[2]['data']['ips'] ?? 0);
        $this->ips4 = (float)($rapot[3]['data']['ips'] ?? 0);
        $this->ips5 = (float)($rapot[4]['data']['ips'] ?? 0);
    }

    public function validateRapotInput()
    {
        $this->validate([
            'matematika1' => 'required|numeric|min:0|max:100',
            'matematika2' => 'required|numeric|min:0|max:100',
            'matematika3' => 'required|numeric|min:0|max:100',
            'matematika4' => 'required|numeric|min:0|max:100',
            'matematika5' => 'required|numeric|min:0|max:100',
            'bahasa_indonesia1' => 'required|numeric|min:0|max:100',
            'bahasa_indonesia2' => 'required|numeric|min:0|max:100',
            'bahasa_indonesia3' => 'required|numeric|min:0|max:100',
            'bahasa_indonesia4' => 'required|numeric|min:0|max:100',
            'bahasa_indonesia5' => 'required|numeric|min:0|max:100',
            'bahasa_inggris1' => 'required|numeric|min:0|max:100',
            'bahasa_inggris2' => 'required|numeric|min:0|max:100',
            'bahasa_inggris3' => 'required|numeric|min:0|max:100',
            'bahasa_inggris4' => 'required|numeric|min:0|max:100',
            'bahasa_inggris5' => 'required|numeric|min:0|max:100',
            'pai1' => 'required|numeric|min:0|max:100',
            'pai2' => 'required|numeric|min:0|max:100',
            'pai3' => 'required|numeric|min:0|max:100',
            'pai4' => 'required|numeric|min:0|max:100',
            'pai5' => 'required|numeric|min:0|max:100',
            'ipa1' => 'required|numeric|min:0|max:100',
            'ipa2' => 'required|numeric|min:0|max:100',
            'ipa3' => 'required|numeric|min:0|max:100',
            'ipa4' => 'required|numeric|min:0|max:100',
            'ipa5' => 'required|numeric|min:0|max:100',
            'ips1' => 'required|numeric|min:0|max:100',
            'ips2' => 'required|numeric|min:0|max:100',
            'ips3' => 'required|numeric|min:0|max:100',
            'ips4' => 'required|numeric|min:0|max:100',
            'ips5' => 'required|numeric|min:0|max:100',
        ], [
            'numeric' => 'Nilai harus berupa angka.',
            'min' => 'Nilai tidak boleh kurang dari 0.',
            'max' => 'Nilai tidak boleh lebih dari 100.',
        ]);
    }

    public function kirim()
    {
        $this->validateRapotInput();

        $formattedData = [];
        $totalAverage = 0;
        for ($i = 1; $i <= 5; $i++) {
            $rapotData = $this->getRapotData($i);
            $formattedData[] = [
                'semester' => $i,
                'data' => $rapotData,
            ];
            $totalAverage += array_sum($rapotData) / count($rapotData);
        }

        $totalAverage /= 5;

        // convert to json
        $jsonData = json_encode($formattedData, JSON_PRETTY_PRINT);
        $this->rapot->nilai_rapot = $jsonData;
        $this->rapot->total_rata_nilai = $totalAverage;
        $this->rapot->save();
        $this->modalSubmit = false;
    }

    private function getRapotData($semester)
    {
        return [
            'matematika' => (float)$this->{"matematika$semester"},
            'bahasa_indonesia' => (float)$this->{"bahasa_indonesia$semester"},
            'bahasa_inggris' => (float)$this->{"bahasa_inggris$semester"},
            'pai' => (float)$this->{"pai$semester"},
            'ipa' => (float)$this->{"ipa$semester"},
            'ips' => (float)$this->{"ips$semester"},
        ];
    }

    public function render()
    {
        return view('livewire.dokumen.rapot-modal');
    }
}
