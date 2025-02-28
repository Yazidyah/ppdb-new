<?php

namespace App\Livewire\Operator;

use Livewire\Component;
use App\Models\CalonSiswa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

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

        // Send email notification
        if (in_array($this->status, [6, 7, 8])) {
            $pdf = Pdf::loadView('mail.surat-keterangan', [
                'siswa' => $this->siswa,
            ]);

            $messageBody = $this->status == 7 
                ? "Selamat, Kamu telah diterima."
                : ($this->status == 6 
                    ? "Maaf, Kamu tidak diterima."
                    : "Kamu dicadangkan.");

            $fileName = 'Surat_keterangan_ppdb_man1kotabogor_' . $this->siswa->dataRegistrasi->kode_registrasi . '.pdf';

            Mail::send([], [], function ($message) use ($pdf, $messageBody, $fileName) {
                $message->to($this->siswa->user->email)
                    ->subject('Hasil Seleksi')
                    ->text($messageBody)
                    ->attachData($pdf->output(), $fileName, [
                        'mime' => 'application/pdf',
                    ]);
            });
        }

        $this->modalOpen = false;
        return redirect()->route('operator.datasiswa')->with('success', 'Status berhasil diubah.');
    }

    public function render()
    {
        return view('livewire.operator.status-acc');
    }
}
