<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Statistik;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $statistik;

    public function mount()
    {
        $this->statistik = Statistik::orderBy('id', 'asc')->get();
        $this->updateStatistik();
    }

    private function updateStatistik()
    {
        $totalCalonSiswa = DB::table('calon_siswa')->count();
        $countLakiLaki = DB::table('calon_siswa')->where('jenis_kelamin', 'L')->count();
        $countSekolahNegeri = DB::table('calon_siswa')->where('status_sekolah', 'NEGERI')->count();
        $countLuarBogor = DB::table('calon_siswa')->where('kota', '!=', 'KOTA BOGOR')->count();


        $statistikData = [
            1 => $totalCalonSiswa,
            2 => DB::table('data_registrasi')->where('id_jalur', 1)->count(),
            3 => DB::table('data_registrasi')->where('id_jalur', 2)->count(),
            4 => DB::table('data_registrasi')->where('id_jalur', 3)->count(),
            5 => DB::table('data_registrasi')->where('id_jalur', 4)->count(), 
            6 => $countLakiLaki,
            7 => $totalCalonSiswa - $countLakiLaki,
            8 => $countSekolahNegeri,
            9 => $totalCalonSiswa - $countSekolahNegeri,
            10 => $countLuarBogor,
            11 => $totalCalonSiswa - $countLuarBogor,
            12 => DB::table('data_registrasi')->where('status', '1')->count(),
            13 => DB::table('data_registrasi')->where('status', '2')->count(),
        ];

        foreach ($statistikData as $id => $count) {
            Statistik::where('id', $id)->update(['count' => $count]);
        }
    }

    public function render()
    {
        return view('livewire.admin.dashboard')->layout('layouts.app');
    }
}
