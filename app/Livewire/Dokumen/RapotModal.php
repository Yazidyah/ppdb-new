<?php

namespace App\Livewire\Dokumen;

use App\Models\Rapot;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RapotModal extends Component
{
    public $modalSubmit = false;
    public $sem = 1;
    public $t;
    public $rapot;
    public $user;
    protected $queryString = [
        'sem' => ['except' => 1],
        't' => ['except' => 1],
    ];

    public function mount()
    {
        $this->user =  Auth::user();
        $this->sem = request()->query('sem', 1);
        $this->t = request()->query('t', 1);
        $this->rapot = $this->user->siswa->dataRegistrasi->rapot;
    }



    public function render()
    {
        return view('livewire.dokumen.rapot-modal');
    }
}
