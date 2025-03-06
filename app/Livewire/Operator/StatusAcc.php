<?php

namespace App\Livewire\Operator;

use Livewire\Component;
use App\Models\CalonSiswa;
use Illuminate\Support\Facades\Mail;
use App\Mail\StatusAcc as StatusAccMail;

class StatusAcc extends Component
{
    public $modalOpen = false;
    public $siswa;
    public $status;
    public $statusList = [
        5 => 'Belum Ditentukan',
        6 => 'Tidak Diterima',
        7 => 'Diterima',
        8 => 'Dicadangkan',
    ];

    protected $listeners = ['openModal' => 'openModal'];

    public function openModal($id)
    {
        $this->siswa = CalonSiswa::findOrFail($id);
        $this->status = $this->siswa->dataRegistrasi->status;
        $this->modalOpen = true;
    }

    public function simpan()
{
    $this->validate([
        'status' => 'required|in:5,6,7,8',
    ]);

    $this->siswa->dataRegistrasi->status = $this->status;
    $this->siswa->dataRegistrasi->save();

    // Kirim email jika status adalah Tidak Diterima, Diterima, atau Dicadangkan
    if (in_array($this->status, [6, 7, 8])) {
        $messageBody = $this->status == 7 
        ? "Selamat, Kamu telah diterima."
        : ($this->status == 6 
            ? "Maaf, Kamu tidak diterima."
            : "Kamu dicadangkan.");
        };

        Mail::to($this->siswa->user->email)->send(new StatusAccMail($this->siswa, $messageBody, $this->status));

    

    $this->modalOpen = false;
    return redirect()->route('operator.datasiswa')->with('success', 'Status berhasil diubah.');
    }

    public function render()
    {
        return view('livewire.operator.status-acc');
    }
}
