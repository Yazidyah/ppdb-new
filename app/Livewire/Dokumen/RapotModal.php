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
            $rapot = json_decode($this->rapot->nilai_rapot, true);
            $this->matematika1 = $rapot[0]['data']['matematika'];
            $this->matematika2 = $rapot[1]['data']['matematika'];
            $this->matematika3 = $rapot[2]['data']['matematika'];
            $this->matematika4 = $rapot[3]['data']['matematika'];
            $this->matematika5 = $rapot[4]['data']['matematika'];
        }
    }

    public function kirim()
    {
        $formattedData = [];
        for ($i = 1; $i <= 5; $i++) {
            if ($i == 1) {
                $matematika = $this->matematika1;
            }
            if ($i == 2) {
                $matematika = $this->matematika2;
            }
            if ($i == 3) {
                $matematika = $this->matematika3;
            }
            if ($i == 4) {
                $matematika = $this->matematika4;
            }
            if ($i == 5) {
                $matematika = $this->matematika5;
            }
            $formattedData[] = [
                'semester' => $i,
                'data' => [
                    'matematika' => $matematika,
                ],
            ];
        }

        // Convert the array to JSON
        $jsonData = json_encode($formattedData, JSON_PRETTY_PRINT);
        $this->rapot->nilai_rapot = $jsonData;
        $this->rapot->save();
    }

    public function render()
    {
        return view('livewire.dokumen.rapot-modal');
    }
}
