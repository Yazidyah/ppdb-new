<?php

namespace App\Livewire;

use App\Models\CalonSiswa;
use Livewire\Component;
use App\Jobs\SendStatusAccEmail;
use Illuminate\Support\Facades\Log;

class KirimEmailJalurReguler extends Component
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
        foreach ($this->siswa->sortBy('id_calon_siswa') as $s) {
            if ($s->dataRegistrasi == null) {
                continue;
            } else {
                if ($s->dataRegistrasi->id_jalur == 1) {
                    if ($s->dataRegistrasi->status == 7  || $s->dataRegistrasi->status == 8) {
                        $messageBody = $s->dataRegistrasi->status === '8'
                            ? "Kamu dicadangkan."
                            : ($s->dataRegistrasi->status === '7'
                                ? "Selamat, Kamu telah diterima."
                                : ($s->dataRegistrasi->status === '6'
                                    ? "Maaf, Kamu tidak diterima."
                                    : "Status kamu belum diproses."));
                        SendStatusAccEmail::dispatch($s, $messageBody, $s->dataRegistrasi->status);
                        Log::info('Email sent to: ' . $s->user->email . ' with status: ' . $s->dataRegistrasi->status);
                    } else {
                        continue;
                    }
                } else {
                    continue;
                }
            }
        }
    }
    public function render()
    {
        return view('livewire.kirim-email-jalur-reguler');
    }
}
