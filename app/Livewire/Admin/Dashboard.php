<?php

namespace App\Livewire\Admin;

use App\Models\CalonSiswa;
use App\Models\DataRegistrasi;
use Livewire\Component;
use App\Models\Statistik;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $tab = 1;
    public $filterNamaStatistik = '';
    public $allNamaStatistik = [];
    public $statistik, $countLakiLaki, $countPerempuan, $countSekolahNegeri, $countSekolahSwasta, $countLuarBogor, $countDalamBogor, $countJalur, $countUpload, $countSubmit, $countTidakLolosAdministrasi, $countLolosAdministrasi, $countBelumDitentukan, $countDiterima, $countTidakDiterima, $countDicadangkan;

    protected $queryString = [
        'tab' => ['except' => 'konsep', 'as' => 't'],
    ];

    public function mount()
    {
        $this->updateStatistik();
        $this->loadStatistik();
        $this->loadAllNamaStatistik();
    }

    public function updateStatistik()
    {
        $cteCalonSiswa = CalonSiswa::withoutTrashed();
        $cteDataRegistrasi = DataRegistrasi::withoutTrashed();

        $totalCalonSiswa = $cteCalonSiswa->count();
        // Clone the base query for each condition to avoid query state pollution
        $countJalurReguler = (clone $cteDataRegistrasi)->where('id_jalur', 1)->count();
        $countJalurAfirmasiPrestasi = (clone $cteDataRegistrasi)->where('id_jalur', 2)->count();
        $countJalurAfirmasiKETM = (clone $cteDataRegistrasi)->where('id_jalur', 3)->count();
        $countJalurAfirmasiABK = (clone $cteDataRegistrasi)->where('id_jalur', 4)->count();

        $this->countLakiLaki = (clone $cteCalonSiswa)->where('jenis_kelamin', 'L')->count();
        $this->countPerempuan = $totalCalonSiswa - $this->countLakiLaki;
        $this->countSekolahNegeri = (clone $cteCalonSiswa)->where('status_sekolah', 'negeri')->count();
        $this->countSekolahSwasta = $totalCalonSiswa - $this->countSekolahNegeri;
        $this->countLuarBogor = (clone $cteCalonSiswa)->where('kota', '!=', 'KOTA BOGOR')->count();
        $this->countDalamBogor = $totalCalonSiswa - $this->countLuarBogor;

        $this->countJalur = (clone $cteDataRegistrasi)->where('status', '1')->count();
        $this->countUpload = (clone $cteDataRegistrasi)->where('status', '2')->count();
        $this->countSubmit = (clone $cteDataRegistrasi)->where('status', '3')->count();
        $this->countTidakLolosAdministrasi = (clone $cteDataRegistrasi)->where('status', '4')->count();
        $this->countLolosAdministrasi = (clone $cteDataRegistrasi)->where('status', '5')->count();
        $this->countTidakDiterima = (clone $cteDataRegistrasi)->where('status', '6')->count();
        $this->countDiterima = (clone $cteDataRegistrasi)->where('status', '7')->count();
        $this->countDicadangkan = (clone $cteDataRegistrasi)->where('status', '8')->count();

        $statistikData = $this->prepareStatistikData($totalCalonSiswa, $countJalurReguler, $countJalurAfirmasiPrestasi, $countJalurAfirmasiKETM, $countJalurAfirmasiABK);

        foreach ($statistikData as $nama_statistik => $count) {
            Statistik::updateOrCreate(
                ['nama_statistik' => $nama_statistik],
                ['count' => $count, 'updated_at' => now()]
            );
        }
    }

    private function prepareStatistikData($totalCalonSiswa, $countJalurReguler, $countJalurAfirmasiPrestasi, $countJalurAfirmasiKETM, $countJalurAfirmasiABK)
    {
        return [
            'Total Pendaftar' => $totalCalonSiswa,
            'Pendaftar Jalur Reguler' => $countJalurReguler,
            'Pendaftar Jalur Afirmasi Prestasi' => $countJalurAfirmasiPrestasi,
            'Pendaftar Jalur Afirmasi KETM' => $countJalurAfirmasiKETM,
            'Pendaftar Jalur Afirmasi ABK' => $countJalurAfirmasiABK,
            'Pendaftar Laki-laki' => $this->countLakiLaki,
            'Pendaftar Perempuan' => $this->countPerempuan,
            'Dari Sekolah Negeri' => $this->countSekolahNegeri,
            'Dari Sekolah Swasta' => $this->countSekolahSwasta,
            'Dari Luar Kota' => $this->countLuarBogor,
            'Dari Dalam Kota' => $this->countDalamBogor,
            'Pendaftar Memilih Jalur' => $this->countJalur,
            'Pendaftar Upload Dokumen' => $this->countUpload,
            'Pendaftar Submit' => $this->countSubmit,
            'Pendaftar Tidak Lolos Administrasi' => $this->countTidakLolosAdministrasi,
            'Pendaftar Lolos Administrasi' => $this->countLolosAdministrasi,
            'Pendaftar Tidak Diterima' => $this->countTidakDiterima,
            'Pendaftar Diterima' => $this->countDiterima,
            'Pendaftar Dicadangkan' => $this->countDicadangkan,
        ];
    }

    public function updatedFilterNamaStatistik()
    {
        $this->loadStatistik();
    }

    private function loadStatistik()
    {
        if ($this->filterNamaStatistik) {
            $this->statistik = Statistik::where('nama_statistik', $this->filterNamaStatistik)
                ->orderBy('id', 'asc')
                ->get();
        } else {
            $this->statistik = Statistik::orderBy('id', 'asc')->get();
        }
    }

    private function loadAllNamaStatistik()
    {
        $this->allNamaStatistik = Statistik::orderBy('id', 'asc')->pluck('nama_statistik')->toArray();
    }

    public function render()
    {
        return view('livewire.admin.dashboard')->layout('layouts.app');
    }
}
