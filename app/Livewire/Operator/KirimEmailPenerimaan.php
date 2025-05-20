<?php

namespace App\Livewire\Operator;

use Livewire\Component;
use App\Models\CalonSiswa;
use App\Jobs\SendStatusAccEmail;
use App\Mail\StatusAcc as StatusAccMail;
class KirimEmailPenerimaan extends Component
{
    public $status;
    public $selectedSiswa = [];
    public $modalOpen = false;
    
    public function kirim()
{
    $this->validate([
        'status' => 'required|in:6,7,8,9',
        'selectedSiswa' => 'required|array|min:1',
    ]);

$siswas = CalonSiswa::with('dataRegistrasi')->whereIn('id_calon_siswa', $this->selectedSiswa)->get();

    foreach ($siswas as $siswa) {
        $siswa->dataRegistrasi->status = $this->status;
        $siswa->dataRegistrasi->save();

        // Kirim email berdasarkan status
        $messageBody = match ($this->status) {
            '8' => 'Selamat, Kamu telah diterima.',
            '7' => 'Maaf, Kamu tidak diterima.',
            '9' => 'Kamu dicadangkan.',
            default => null
        };

        if ($messageBody) {
            SendStatusAccEmail::dispatch($siswa, $messageBody, $this->status);
        }
    }

    $this->modalOpen = false;
    $this->reset(['selectedSiswa', 'status']);
    
    return redirect()->route('operator.datasiswa')->with('success', 'Email berhasil dikirim ke semua siswa yang dipilih.');
}
    
    public function render()
    {
        return view('livewire.operator.kirim-email-penerimaan');
    }
}
