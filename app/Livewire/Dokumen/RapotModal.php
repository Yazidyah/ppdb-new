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
    }

    public function updatedMatematika1($value)
    {
        $this->matematika1 = $value;
    }

    // public function updatedMatematika($value)
    // {
    //     // Ensure that the incoming value is an array
    //     if (is_array($value)) {
    //         foreach ($value as $item) {
    //             // Check if the item has the expected structure
    //             if (isset($item['semester']) && isset($item['data']['matematika'])) {
    //                 $semester = $item['semester'];
    //                 $score = $item['data']['matematika'];

    //                 // Store the score in the matematika array
    //                 $this->matematika[$semester] = $score;
    //             }
    //         }
    //     } else {
    //         // Log an error if the incoming value is not an array
    //     }
    // }

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
