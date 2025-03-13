<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CalonSiswa;
use App\Models\DataRegistrasi;

class SearchSiswa extends Component
{
    public $nisn;
    public $kode_registrasi;
    public $siswa;
    public $showModal = false;
    public $statusLabels = [
        0 => 'Memilih Jalur',
        1 => 'Upload Dokumen',
        2 => 'Submit Dokumen',
        3 => 'Tidak Lolos Verifikasi Berkas',
        4 => 'Lolos Verifikasi Berkas, Silahkan Cek Email secara berkala',
        5 => 'Belum Ditentukan',
        6 => 'Tidak Diterima',
        7 => 'Diterima',
        8 => 'Dicadangkan'
    ];

    protected $rules = [
        'nisn'            => 'required',
        'kode_registrasi' => 'required'
    ];

    public function search()
    {
        $this->validate();

        $this->siswa = DataRegistrasi::where('kode_registrasi', $this->kode_registrasi)
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
