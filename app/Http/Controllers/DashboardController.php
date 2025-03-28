<?php

namespace App\Http\Controllers;

use App\Models\DataRegistrasi;
class DashboardController extends Controller
{
    public function index()
    {
        $totalPendaftar = DataRegistrasi::where('status','>=',3)->count();
        $pendaftarSudahDiproses = DataRegistrasi::where('status', '>', 3)->count();
        $pendaftarHarusDiproses = DataRegistrasi::where('status', 3)->count();

        // Calculate the percentage
        $persentaseSudahDiproses = $totalPendaftar > 0 
            ? round(($pendaftarSudahDiproses / $totalPendaftar) * 100) 
            : 0;
        return view('operator.dashboard', compact('pendaftarHarusDiproses', 'pendaftarSudahDiproses', 'persentaseSudahDiproses'));
    }
}
