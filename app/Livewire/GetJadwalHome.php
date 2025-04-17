<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\JalurRegistrasi;
use Carbon\Carbon;

class GetJadwalHome extends Component
{
    public $tanggalBukaReguler;
    public $tanggalBukaAfirmatif;
    public $tanggalTutupReguler; // Added
    public $tanggalTutupAfirmatif; // Added
    public $tanggalBukaRegulerShort;
    public $tanggalBukaAfirmatifShort;
    public $messageAfirmatif;
    public $messageReguler;

    public function mount()
    {
        $this->initializeJalurData(1, 'Reguler');
        $this->initializeJalurData(2, 'Afirmatif');
    }

    private function initializeJalurData($idJalur, $jalurType)
    {
        $tanggalBukaRaw = $this->getTanggalBuka($idJalur);
        $tanggalTutupRaw = $this->getTanggalTutup($idJalur);

        $this->{"tanggalBuka{$jalurType}"} = $this->formatTanggal($tanggalBukaRaw, true);
        $this->{"tanggalBuka{$jalurType}Short"} = $tanggalBukaRaw ? $this->formatTanggalShort($tanggalBukaRaw) : 'Belum dijadwalkan';
        $this->{"tanggalTutup{$jalurType}"} = $this->formatTanggal($tanggalTutupRaw, false);
        $this->{"tanggalTutup{$jalurType}Short"} = $tanggalTutupRaw ? $this->formatTanggalShort($tanggalTutupRaw) : 'Belum dijadwalkan';
    }

    private function getTanggalBuka($idJalur)
    {
        $jalur = JalurRegistrasi::where('id_jalur', $idJalur)->first();
        return $jalur ? $jalur->tanggal_buka : null;
    }

    private function getTanggalTutup($idJalur)
    {
        $jalur = JalurRegistrasi::where('id_jalur', $idJalur)->first();
        return $jalur ? $jalur->tanggal_tutup : null;
    }

    private function formatTanggal($tanggal, $isTanggalBuka = true)
    {
        return $tanggal 
            ? Carbon::parse($tanggal)->locale('id')->isoFormat($isTanggalBuka ? 'D MMMM' : 'D MMMM Y') 
            : null;
    }

    private function formatTanggalShort($tanggal)
    {
        return $tanggal ? Carbon::parse($tanggal)->locale('id')->isoFormat('MMMM Y') : null;
    }

    public function render()
    {
        return view('livewire.get-jadwal-home');
    }
}
