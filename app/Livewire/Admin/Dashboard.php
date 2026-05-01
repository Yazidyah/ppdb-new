<?php

namespace App\Livewire\Admin;

use App\Models\CalonSiswa;
use App\Models\DataRegistrasi;
use App\Models\Pembukaan;
use Livewire\Component;
use App\Models\Statistik;
use App\Models\JalurRegistrasi;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $tab = 1;
    public $filterNamaStatistik = '';
    public $allNamaStatistik = [];
    public $statistik, $countLakiLaki, $countPerempuan, $countSekolahNegeri, $countSekolahSwasta, $countLuarBogor, $countDalamBogor, $countJalur, $countUpload, $countSubmit, $countTidakLolosAdministrasi, $countLolosAdministrasi, $countBelumDitentukan, $countDiterima, $countTidakDiterima, $countDicadangkan;
    public $isOpen;
    protected $queryString = [
        'tab' => ['except' => '1', 'as' => 't', 'type' => 'integer'],
    ];

    public function mount()
    {
        $this->isOpen = Pembukaan::first() ?? new Pembukaan(['is_open' => false]);
        $this->updateStatistik();
        $this->loadStatistik();
        $this->loadAllNamaStatistik();
    }

    public function bukatutup()
    {

        $pembukaan = Pembukaan::first();
        $pembukaan->is_open = !$pembukaan->is_open;
        $pembukaan->save();
        $this->mount();
    }
    public function updateStatistik()
    {
        $cteCalonSiswa = CalonSiswa::withoutTrashed();
        $cteDataRegistrasi = DataRegistrasi::withoutTrashed();

        $jalurList = JalurRegistrasi::all();

        $statistikJalur = [];

        foreach ($jalurList as $jalur) {
            $count = (clone $cteDataRegistrasi)
                ->where('id_jalur', $jalur->id)
                ->count();

        $statistikJalur["Pendaftar Jalur {$jalur->nama_jalur}"] = $count;
}
        $totalCalonSiswa = (clone $cteDataRegistrasi)->count();
        // Clone the base query for each condition to avoid query state pollution
        

        $this->countLakiLaki = (clone $cteCalonSiswa)->where('jenis_kelamin', 'L')->count();
        $this->countPerempuan = (clone $cteCalonSiswa)->where('jenis_kelamin', 'P')->count();
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

        $statistikData = $this->prepareStatistikData($totalCalonSiswa, $statistikJalur);

        foreach ($statistikData as $nama_statistik => $count) {
            Statistik::updateOrCreate(
                ['nama_statistik' => $nama_statistik],
                ['count' => $count, 'updated_at' => now()]
            );
        }
    }

    private function prepareStatistikData($totalCalonSiswa, $statistikJalur)
{
    return array_merge([
        'Total Pendaftar' => $totalCalonSiswa,
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
    ], $statistikJalur);
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
