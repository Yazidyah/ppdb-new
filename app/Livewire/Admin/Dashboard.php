<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Statistik;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $statistik;
    public $filterNamaStatistik = '';
    public $allNamaStatistik = [];
    public $countLakiLaki;
    public $countPerempuan;
    public $countSekolahNegeri;
    public $countSekolahSwasta;
    public $countLuarBogor;
    public $countDalamBogor;
    public $countBelumDiproses;
    public $countLulus;
    public $countTidakLulus;

    public function mount()
    {
        $this->updateStatistik();
        $this->loadStatistik();
        $this->loadAllNamaStatistik();
    }

    public function updateStatistik()
    {
        $totalCalonSiswa = DB::table('calon_siswa')->count();
        $countJalurReguler = DB::table('data_registrasi')->where('id_jalur', 1)->count();
        $countJalurAfirmasiPrestasi = DB::table('data_registrasi')->where('id_jalur', 2)->count();
        $countJalurAfirmasiKETM = DB::table('data_registrasi')->where('id_jalur', 3)->count();
        $countJalurAfirmasiABK = DB::table('data_registrasi')->where('id_jalur', 4)->count();
        $this->countLakiLaki = DB::table('calon_siswa')->where('jenis_kelamin', 'L')->count();
        $this->countPerempuan = $totalCalonSiswa - $this->countLakiLaki;
        $this->countSekolahNegeri = DB::table('calon_siswa')->where('status_sekolah', 'NEGERI')->count();
        $this->countSekolahSwasta = $totalCalonSiswa - $this->countSekolahNegeri;
        $this->countLuarBogor = DB::table('calon_siswa')->where('kota', '!=', 'KOTA BOGOR')->count();
        $this->countDalamBogor = $totalCalonSiswa - $this->countLuarBogor;
        $this->countBelumDiproses = DB::table('data_registrasi')->where('status', '0')->count();
        $this->countLulus = DB::table('data_registrasi')->where('status', '1')->count();
        $this->countTidakLulus = DB::table('data_registrasi')->where('status', '2')->count();

        $statistikData = [
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
            'Pendaftar Belum di Proses' => $this->countBelumDiproses,
            'Pendaftar Lulus' => $this->countLulus,
            'Pendaftar Tidak Lulus' => $this->countTidakLulus,
        ];

        foreach ($statistikData as $nama_statistik => $count) {
            Statistik::updateOrCreate(
                ['nama_statistik' => $nama_statistik],
                ['count' => $count, 'updated_at' => now()]
            );
        }
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
