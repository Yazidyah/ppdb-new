<?php

namespace App\Http\Controllers;

use App\Models\DataRegistrasi;
class DashboardController extends Controller
{
    public function index()
    {
        $totalPendaftar = DataRegistrasi::where('status','>=',3)->whereIn('id_jalur',[2,3,4])->count();
        $pendaftarSudahDiproses = DataRegistrasi::where('status', '>', 3)->whereIn('id_jalur',[2,3,4])->count();
        $pendaftarHarusDiproses = DataRegistrasi::where('status', 3)->whereIn('id_jalur',[2,3,4])->count();
        
        $totalPendaftarReguler = DataRegistrasi::where('status','>=',3)->where('id_jalur',1)->count();
        $pendaftarSudahDiprosesReguler = DataRegistrasi::where('status', '>', 3)->where('id_jalur',1)->count();
        $pendaftarHarusDiprosesReguler = DataRegistrasi::where('status', 3)->where('id_jalur',1)->count();

        // Calculate the percentage
        $persentaseSudahDiproses = $totalPendaftar > 0 
            ? round(($pendaftarSudahDiproses / $totalPendaftar) * 100) 
            : 0;
        $persentaseSudahDiprosesReguler = $totalPendaftarReguler > 0 
            ? round(($pendaftarSudahDiprosesReguler / $totalPendaftarReguler) * 100) 
            : 0;
        return view('operator.dashboard', compact('pendaftarHarusDiproses', 'pendaftarSudahDiproses', 'persentaseSudahDiproses',
            'pendaftarHarusDiprosesReguler', 'pendaftarSudahDiprosesReguler', 'persentaseSudahDiprosesReguler',
            'totalPendaftar', 'totalPendaftarReguler'));
    }
}
