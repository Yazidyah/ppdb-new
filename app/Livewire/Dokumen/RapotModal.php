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
            $rapot = json_decode($this->rapot->nilai_rapot, true);
            $this->matematika1 = @$rapot[0]['data']['matematika'];
            $this->matematika2 = @$rapot[1]['data']['matematika'];
            $this->matematika3 = @$rapot[2]['data']['matematika'];
            $this->matematika4 = @$rapot[3]['data']['matematika'];
            $this->matematika5 = @$rapot[4]['data']['matematika'];
            $this->bahasa_indonesia1 = @$rapot[0]['data']['bahasa_indonesia'];
            $this->bahasa_indonesia2 = @$rapot[1]['data']['bahasa_indonesia'];
            $this->bahasa_indonesia3 = @$rapot[2]['data']['bahasa_indonesia'];
            $this->bahasa_indonesia4 = @$rapot[3]['data']['bahasa_indonesia'];
            $this->bahasa_indonesia5 = @$rapot[4]['data']['bahasa_indonesia'];
            $this->bahasa_inggris1 = @$rapot[0]['data']['bahasa_inggris'];
            $this->bahasa_inggris2 = @$rapot[1]['data']['bahasa_inggris'];
            $this->bahasa_inggris3 = @$rapot[2]['data']['bahasa_inggris'];
            $this->bahasa_inggris4 = @$rapot[3]['data']['bahasa_inggris'];
            $this->bahasa_inggris5 = @$rapot[4]['data']['bahasa_inggris'];
            $this->pai1 = @$rapot[0]['data']['pai'];
            $this->pai2 = @$rapot[1]['data']['pai'];
            $this->pai3 = @$rapot[2]['data']['pai'];
            $this->pai4 = @$rapot[3]['data']['pai'];
            $this->pai5 = @$rapot[4]['data']['pai'];
            $this->ipa1 = @$rapot[0]['data']['ipa'];
            $this->ipa2 = @$rapot[1]['data']['ipa'];
            $this->ipa3 = @$rapot[2]['data']['ipa'];
            $this->ipa4 = @$rapot[3]['data']['ipa'];
            $this->ipa5 = @$rapot[4]['data']['ipa'];
            $this->ips1 = @$rapot[0]['data']['ips'];
            $this->ips2 = @$rapot[1]['data']['ips'];
            $this->ips3 = @$rapot[2]['data']['ips'];
            $this->ips4 = @$rapot[3]['data']['ips'];
            $this->ips5 = @$rapot[4]['data']['ips'];
        }
    }

    public function kirim()
    {
        $formattedData = [];
        for ($i = 1; $i <= 5; $i++) {
            if ($i == 1) {
                $matematika = $this->matematika1;
                $bind = $this->bahasa_indonesia1;
                $bing = $this->bahasa_inggris1;
                $pai = $this->pai1;
                $ipa = $this->ipa1;
                $ips = $this->ips1;
            }
            if ($i == 2) {
                $matematika = $this->matematika2;
                $bind = $this->bahasa_indonesia2;
                $bing = $this->bahasa_inggris2;
                $pai = $this->pai2;
                $ipa = $this->ipa2;
                $ips = $this->ips2;
            }
            if ($i == 3) {
                $matematika = $this->matematika3;
                $bind = $this->bahasa_indonesia3;
                $bing = $this->bahasa_inggris3;
                $pai = $this->pai3;
                $ipa = $this->ipa3;
                $ips = $this->ips3;
            }
            if ($i == 4) {
                $matematika = $this->matematika4;
                $bind = $this->bahasa_indonesia4;
                $bing = $this->bahasa_inggris4;
                $pai = $this->pai4;
                $ipa = $this->ipa4;
                $ips = $this->ips4;
            }
            if ($i == 5) {
                $matematika = $this->matematika5;
                $bind = $this->bahasa_indonesia5;
                $bing = $this->bahasa_inggris5;
                $pai = $this->pai5;
                $ipa = $this->ipa5;
                $ips = $this->ips5;
            }
            $formattedData[] = [
                'semester' => $i,
                'data' => [
                    'matematika' => $matematika,
                    'bahasa_indonesia' => $bind,
                    'bahasa_inggris' => $bing,
                    'pai' => $pai,
                    'ipa' => $ipa,
                    'ips' => $ips,
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
