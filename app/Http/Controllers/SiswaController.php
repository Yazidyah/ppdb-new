<?php

namespace App\Http\Controllers;

use App\Models\CalonSiswa;
use App\Models\DataRegistrasi;
use App\Models\Persyaratan;
use Illuminate\Http\Request;
use App\Models\User;

class SiswaController extends Controller
{
    public function persyaratan(Request $request) 
    {
        // Ambil id_jalur dari request
        $id_jalur = $request->query('id_jalur', 1);
    
        // Ambil data persyaratan sesuai jalur yang dipilih
        $data = Persyaratan::where("id_jalur", $id_jalur)->get();
    
        return view('siswa.daftar-step3', compact('data'));
    }
    public function jalur(Request $request)
{
    // Validasi input dari form
    // $request->validate([
    //     'id_jalur' => 'required|integer',
    // ]);

    // Ambil id_calon_siswa berdasarkan user yang sedang login (asumsinya user terkait dengan calon siswa)
    $calonSiswa = CalonSiswa::where('id_calon_siswa', auth()->id())->first();


    if (!$calonSiswa) {
        return response()->json(['message' => 'Calon siswa tidak ditemukan'], 404);
    }

    // Simpan data ke DataRegistrasi
    $dataRegistrasi = DataRegistrasi::create([
        'id_calon_siswa' => $calonSiswa->id_calon_siswa,
        'id_jalur' => $request->id_jalur,
        'status' => $request->status,
    ]);

    return response()->json($dataRegistrasi, 201);
}
}
