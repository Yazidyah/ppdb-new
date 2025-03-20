<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JalurRegistrasi;

class GetPersyaratan extends Controller
{
    public $jalurRegistrasi;
    public function getPersyaratanByJalur($id_jalur)
    {
        $jalur = JalurRegistrasi::with('persyaratan')->find($id_jalur);

        if (!$jalur) {
            return response()->json(['message' => 'Jalur tidak ditemukan'], 404);
        }

        return response()->json($jalur->persyaratan);
    }

    public function showPersyaratan()
    {
        $jalurRegistrasi = JalurRegistrasi::with('persyaratan')->get();
        return view('persyaratan', ['jalurRegistrasi' => $jalurRegistrasi]);
    }
}
