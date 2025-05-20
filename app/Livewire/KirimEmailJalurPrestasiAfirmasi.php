<?php

namespace App\Livewire;

use App\Models\CalonSiswa;
use Livewire\Component;
use App\Jobs\SendStatusAccEmail;


class KirimEmailJalurPrestasiAfirmasi extends Component
{
    public $siswa;

    public function mount()
    {
        $this->siswa = CalonSiswa::where('deleted_at',  null)
            ->get();
        // dd($this->siswa);
    }

    public function kirimEmail()
    {
        foreach ($this->siswa as $s) {
            // dd($s->dataRegistrasi);
            $messageBody = $s->dataRegistrasi->status === '8'
                ? "Kamu dicadangkan."
                : ($s->dataRegistrasi->status === '7'
                    ? "Selamat, Kamu telah diterima."
                    : ($s->dataRegistrasi->status === '6'
                        ? "Maaf, Kamu tidak diterima."
                        : "Status kamu belum diproses."));
            // dd($messageBody);
            SendStatusAccEmail::dispatch($s, $messageBody, $s->dataRegistrasi->status);
        }
        // dd('Kirim email jalur prestasi afirmasi');
    }
    public function render()
    {
        return view('livewire.kirim-email-jalur-prestasi-afirmasi');
    }
}
