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
        foreach ($this->siswa->whereIn('id_calon_siswa', [855, 854, 853, 852, 851, 850, 849, 848, 847, 846, 845, 844, 843, 842, 841, 840, 839, 838, 837, 836, 835, 834, 833, 832, 831, 830, 829, 828, 827, 826, 825, 824, 823, 822, 821, 820, 819, 818, 817, 816, 815, 814, 813, 812, 811, 810, 809, 808, 807, 806, 805, 804, 803, 802, 801])->sortBy('id_calon_siswa') as $s) {
            if ($s->dataRegistrasi == null) {
                continue;
            } else {
                if ($s->dataRegistrasi->id_jalur == 1) {
                    if ($s->dataRegistrasi->status == 6) {
                        if ($s->user->email !== null) {
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
