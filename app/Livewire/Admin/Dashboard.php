<?php

namespace App\Livewire\Admin;

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
        $totalCalonSiswa = DB::table('calon_siswa')->count();
        $countJalurReguler = DB::table('data_registrasi')->where('id_jalur', 1)->count();
        $countJalurAfirmasiPrestasi = DB::table('data_registrasi')->where('id_jalur', 2)->count();
        $countJalurAfirmasiKETM = DB::table('data_registrasi')->where('id_jalur', 3)->count();
        $countJalurAfirmasiABK = DB::table('data_registrasi')->where('id_jalur', 4)->count();
        $this->countLakiLaki = DB::table('calon_siswa')->where('jenis_kelamin', 'L')->count();
        $this->countPerempuan = $totalCalonSiswa - $this->countLakiLaki;
        $this->countSekolahNegeri = DB::table('calon_siswa')->where('status_sekolah', 'negeri')->count();
        $this->countSekolahSwasta = $totalCalonSiswa - $this->countSekolahNegeri;
        $this->countLuarBogor = DB::table('calon_siswa')->where('kota', '!=', 'KOTA BOGOR')->count();
        $this->countDalamBogor = $totalCalonSiswa - $this->countLuarBogor;
        $this->countJalur = DB::table('data_registrasi')->where('status', '0')->count();
        $this->countUpload = DB::table('data_registrasi')->where('status', '1')->count();
        $this->countSubmit = DB::table('data_registrasi')->where('status', '2')->count();
        $this->countTidakLolosAdministrasi = DB::table('data_registrasi')->where('status', '3')->count();
        $this->countLolosAdministrasi = DB::table('data_registrasi')->where('status', '4')->count();
        $this->countBelumDitentukan = DB::table('data_registrasi')->where('status', '5')->count();
        $this->countTidakDiterima = DB::table('data_registrasi')->where('status', '6')->count();
        $this->countDiterima = DB::table('data_registrasi')->where('status', '7')->count();
        $this->countDicadangkan = DB::table('data_registrasi')->where('status', '8')->count();

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
            'Pendaftar Memilih Jalur' => $this->countJalur,
            'Pendaftar Upload Dokumen' => $this->countUpload,
            'Pendaftar Submit' => $this->countSubmit,
            'Pendaftar Tidak Lolos Administrasi' => $this->countTidakLolosAdministrasi,
            'Pendaftar Lolos Administrasi' => $this->countLolosAdministrasi,
            'Pendaftar Belum Ditentukan' => $this->countBelumDitentukan,
            'Pendaftar Diterima' => $this->countDiterima,
            'Pendaftar Tidak Diterima' => $this->countTidakDiterima,
            'Pendaftar Dicadangkan' => $this->countDicadangkan,
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
