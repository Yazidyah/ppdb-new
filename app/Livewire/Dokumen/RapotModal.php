<?php

namespace App\Livewire\Dokumen;

use App\Models\Rapot;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RapotModal extends Component
{
    public $modalSubmit = false;

    protected $listeners = ['openRapotModal' => 'openModal'];

    public function openModal()
    {
        $this->modalSubmit = true;
    }

    public $sem;
    public $t;
    public $rapot;
    public $user;
    public $matematika1, $matematika2, $matematika3, $matematika4, $matematika5;
    public $bahasa_indonesia1, $bahasa_indonesia2, $bahasa_indonesia3, $bahasa_indonesia4, $bahasa_indonesia5;
    public $bahasa_inggris1, $bahasa_inggris2, $bahasa_inggris3, $bahasa_inggris4, $bahasa_inggris5;
    public $agama1, $agama2, $agama3, $agama4, $agama5;
    public $pai3, $pai4, $pai5;
    public $ipa1, $ipa2, $ipa3, $ipa4, $ipa5;
    public $ips1, $ips2, $ips3, $ips4, $ips5;
    protected $queryString = [
        't' => ['except' => 1],
    ];

    public function mount()
    {
        $this->user = Auth::user();
        $this->sem = request()->query('sem', 3);
        $this->t = request()->query('t', 1);
        $this->rapot = $this->user->siswa->dataRegistrasi->rapot;
        if ($this->rapot && $this->rapot->nilai_rapot != null) {
            $rapot = is_string($this->rapot->nilai_rapot) ? json_decode($this->rapot->nilai_rapot, true) : $this->rapot->nilai_rapot;
            $this->initializeRapotValues($rapot);
        } else {
            $this->rapot = Rapot::firstOrCreate([
                'id_registrasi' => $this->user->siswa->dataRegistrasi->id_registrasi,
                'total_rata_nilai' => 0,
            ]);
        }
    }

    private function initializeRapotValues($rapot)
    {
        // matematika sem 3 - 5
        $this->matematika3 = (float)($rapot[0]['data']['matematika'] ?? 0);
        $this->matematika4 = (float)($rapot[1]['data']['matematika'] ?? 0);
        $this->matematika5 = (float)($rapot[2]['data']['matematika'] ?? 0);

        // bahasa indonesia sem 3 - 5
        $this->bahasa_indonesia3 = (float)($rapot[0]['data']['bahasa_indonesia'] ?? 0);
        $this->bahasa_indonesia4 = (float)($rapot[1]['data']['bahasa_indonesia'] ?? 0);
        $this->bahasa_indonesia5 = (float)($rapot[2]['data']['bahasa_indonesia'] ?? 0);

        // bahasa inggris sem 3 - 5
        $this->bahasa_inggris3 = (float)($rapot[0]['data']['bahasa_inggris'] ?? 0);
        $this->bahasa_inggris4 = (float)($rapot[1]['data']['bahasa_inggris'] ?? 0);
        $this->bahasa_inggris5 = (float)($rapot[2]['data']['bahasa_inggris'] ?? 0);

        // pai sem 3 - 5
        $this->pai3 = (float)($rapot[0]['data']['pai'] ?? 0);
        $this->pai4 = (float)($rapot[1]['data']['pai'] ?? 0);
        $this->pai5 = (float)($rapot[2]['data']['pai'] ?? 0);

        // ipa sem 3 - 5
        $this->ipa3 = (float)($rapot[0]['data']['ipa'] ?? 0);
        $this->ipa4 = (float)($rapot[1]['data']['ipa'] ?? 0);
        $this->ipa5 = (float)($rapot[2]['data']['ipa'] ?? 0);

        // ips sem 3 - 5
        $this->ips3 = (float)($rapot[0]['data']['ips'] ?? 0);
        $this->ips4 = (float)($rapot[1]['data']['ips'] ?? 0);
        $this->ips5 = (float)($rapot[2]['data']['ips'] ?? 0);
    }

    public function validateRapotInput()
    {
        $this->validate([
            // matematika sem 3 - 5
            'matematika3' => 'required|min:0|max:100',
            'matematika4' => 'required|min:0|max:100',
            'matematika5' => 'required|min:0|max:100',

            // bahasa indonesia sem 3 - 5
            'bahasa_indonesia3' => 'required|min:0|max:100',
            'bahasa_indonesia4' => 'required|min:0|max:100',
            'bahasa_indonesia5' => 'required|min:0|max:100',

            // bahasa inggris sem 3 - 5
            'bahasa_inggris3' => 'required|min:0|max:100',
            'bahasa_inggris4' => 'required|min:0|max:100',
            'bahasa_inggris5' => 'required|min:0|max:100',


            // pai sem 3 - 5
            'pai3' => 'required|min:0|max:100',
            'pai4' => 'required|min:0|max:100',
            'pai5' => 'required|min:0|max:100',

            // ipa sem 3 - 5
            'ipa3' => 'required|min:0|max:100',
            'ipa4' => 'required|min:0|max:100',
            'ipa5' => 'required|min:0|max:100',

            // ips sem 3 - 5
            'ips3' => 'required|min:0|max:100',
            'ips4' => 'required|min:0|max:100',
            'ips5' => 'required|min:0|max:100',
        ], [
            'required' => 'Nilai tidak boleh kosong.',
            'min' => 'Nilai tidak boleh kurang dari 0.',
            'max' => 'Nilai tidak boleh lebih dari 100.',
        ]);
    }


    public function kirim()
    {
        $this->validate(
            [
                'matematika3' => 'required|numeric|gt:0|lte:100',
                'matematika4' => 'required|numeric|gt:0|lte:100',
                'matematika5' => 'required|numeric|gt:0|lte:100',
                'bahasa_indonesia3' => 'required|numeric|gt:0|lte:100',
                'bahasa_indonesia4' => 'required|numeric|gt:0|lte:100',
                'bahasa_indonesia5' => 'required|numeric|gt:0|lte:100',
                'bahasa_inggris3' => 'required|numeric|gt:0|lte:100',
                'bahasa_inggris4' => 'required|numeric|gt:0|lte:100',
                'bahasa_inggris5' => 'required|numeric|gt:0|lte:100',
                'pai3' => 'required|numeric|gt:0|lte:100',
                'pai4' => 'required|numeric|gt:0|lte:100',
                'pai5' => 'required|numeric|gt:0|lte:100',
                'ipa3' => 'required|numeric|gt:0|lte:100',
                'ipa4' => 'required|numeric|gt:0|lte:100',
                'ipa5' => 'required|numeric|gt:0|lte:100',
                'ips3' => 'required|numeric|gt:0|lte:100',
                'ips4' => 'required|numeric|gt:0|lte:100',
                'ips5' => 'required|numeric|gt:0|lte:100',
            ],
            [
                'required' => 'Nilai tidak boleh kosong.',
                'gt' => 'Nilai tidak boleh kurang dari 0.',
                'lte' => 'Nilai tidak boleh lebih dari 100.',
            ]
        );

        $formattedData = [];
        $totalAverage = 0;

        for ($i = 3; $i <= 5; $i++) {
            $rapotData = $this->getRapotData($i);
            $formattedData[] = [
                'semester' => $i,
                'data' => $rapotData,
            ];
            $totalAverage += array_sum($rapotData) / count($rapotData);
        }

        $totalAverage /= 3;

        $jsonData = json_encode($formattedData, JSON_PRETTY_PRINT);
        // dd($jsonData);

        $this->rapot->nilai_rapot = $jsonData;
        $this->rapot->total_rata_nilai = $totalAverage;
        $this->rapot->save();

        $this->dispatch('isian-updated');
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
