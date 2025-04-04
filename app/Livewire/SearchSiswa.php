<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CalonSiswa;
use App\Models\DataRegistrasi;

class SearchSiswa extends Component
{
    public $nisn;
    public $nomor_peserta;
    public $siswa;
    public $showModal = false;
    public $statusLabels = [
        0 => 'Mengisi Biodata',
        1 => 'Memilih Jalur',
        2 => 'Upload Dokumen',
        3 => 'Submit Dokumen',
        4 => 'Tidak Lolos Verifikasi Berkas',
        5 => 'Lolos Verifikasi Berkas, Silahkan Cek Email secara berkala',
        6 => 'Belum Ditentukan',
        7 => 'Tidak Diterima',
        8 => 'Diterima',
        9 => 'Dicadangkan'
    ];

    protected $rules = [
        'nisn'            => 'required',
        'nomor_peserta' => 'required'
    ];

    public function search()
    {
        $this->validate();

        $this->siswa = DataRegistrasi::where('nomor_peserta', $this->nomor_peserta)
            ->whereHas('calonSiswa', function ($query) {
                $query->where('NISN', $this->nisn);
            })
            ->with('calonSiswa')
            ->first();

        if ($this->siswa) {
            $this->showModal = true;
        } else {
            $this->addError('not_found', 'Data tidak ditemukan.');
        }
    }

    public function render()
    {
        return view('livewire.search-siswa', [
            'statusLabels' => $this->statusLabels
        ]);
    }
}
