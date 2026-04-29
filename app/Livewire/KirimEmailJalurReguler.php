<?php

namespace App\Livewire;

use App\Models\CalonSiswa;
use Livewire\Component;
use App\Jobs\SendStatusAccEmail;
use Illuminate\Support\Facades\Log;

class KirimEmailJalurReguler extends Component
{
    public $siswa;
    public $totalEmail = 0;

    public function mount()
    {
        $this->siswa = CalonSiswa::whereHas('dataRegistrasi', function($query) {
            $query->where('id_jalur', 1)
                  ->whereIn('status', [6, 7, 8]);
        })
        ->whereNull('deleted_at')
        ->get();
        
        $this->totalEmail = $this->siswa->count();
    }

    public function kirimEmail()
    {
        $emailSent = 0;
        $emailFailed = 0;

        foreach ($this->siswa as $s) {
            if ($s->dataRegistrasi == null || $s->user == null || $s->user->email == null) {
                $emailFailed++;
                Log::warning('Email gagal dikirim - Data tidak lengkap untuk siswa ID: ' . $s->id_calon_siswa);
                continue;
            }

            $messageBody = match((int)$s->dataRegistrasi->status) {
                7 => "Selamat! Anda telah diterima di MAN 1 Kota Bogor",
                6 => "Pemberitahuan Hasil Seleksi PPDB MAN 1 Kota Bogor",
                8 => "Anda masuk dalam daftar cadangan MAN 1 Kota Bogor",
                default => "Update Status Pendaftaran PPDB MAN 1 Kota Bogor"
            };

            try {
                SendStatusAccEmail::dispatch($s, $messageBody, $s->dataRegistrasi->status);
                $emailSent++;
                Log::info('Email berhasil dikirim ke: ' . $s->user->email . ' (Status: ' . $s->dataRegistrasi->status . ')');
            } catch (\Exception $e) {
                $emailFailed++;
                Log::error('Email gagal dikirim ke: ' . $s->user->email . ' - Error: ' . $e->getMessage());
            }
        }

        session()->flash('success', "Blasting email selesai! Berhasil: {$emailSent}, Gagal: {$emailFailed}");
        
        $this->dispatch('emailSent');
    }

    public function render()
    {
        return view('livewire.kirim-email-jalur-reguler');
    }
}
