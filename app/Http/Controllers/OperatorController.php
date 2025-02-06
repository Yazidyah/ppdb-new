<?php

namespace App\Http\Controllers;

use App\Models\CalonSiswa;
use App\Models\DataRegistrasi;
use App\Models\Persyaratan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OperatorController extends Controller
{

    public function tambahpersyaratan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_persyaratan' => 'required|string|max:255',
            'id_jalur' => 'required|integer|in:1,2,3,4',
            'deskripsi' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Persyaratan::create([
            'nama_persyaratan' => $request->nama_persyaratan,
            'id_jalur' => $request->id_jalur,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->back()->with('success', 'Persyaratan berhasil ditambahkan.');
    }

    public function updatepersyaratan(Request $request)
    {
        $calonSiswa = Persyaratan::update($request->all());
        return response()->json($calonSiswa, 201);
    }

    public function showsiswa(Request $request)
    {
        $data = CalonSiswa::paginate(50);
        return view('operator.datasiswa', compact('data'));
    }

    public function showsiswaDetail($id)
    {
        $siswa = CalonSiswa::findOrFail($id);
        return view('operator.data-siswa-detail', compact('siswa'));
    }
    public function showsiswaLulus()
    {
        $data = CalonSiswa::whereHas('dataRegistrasi', function ($query) {
            $query->where('status', '1'); // Ubah '1' menjadi 1 (integer)
        })->get();

        return view('operator.data-lulus', compact('data'));
    }
    public function showsiswaTidakLulus()
    {
        $data = CalonSiswa::whereHas('dataRegistrasi', function ($query) {
            $query->where('status', '2');
        })->get();

        return view('operator.data-tidaklulus', compact('data'));
    }
    public function showsiswaReguler()
    {
        $data = CalonSiswa::whereHas('dataRegistrasi', function ($query) {
            $query->where('id_jalur', '1');
        })->get();

        return view('operator.data-reguler', compact('data'));
    }
    public function showsiswaPrestasi()
    {
        $data = CalonSiswa::whereHas('dataRegistrasi', function ($query) {
            $query->where('id_jalur', '2');
        })->get();

        return view('operator.data-afirmasi-prestasi', compact('data'));
    }
    public function showsiswaKetm()
    {
        $data = CalonSiswa::whereHas('dataRegistrasi', function ($query) {
            $query->where('id_jalur', '3');
        })->get();

        return view('operator.data-afirmasi-ketm', compact('data'));
    }
    public function showsiswaAbk()
    {
        $data = CalonSiswa::whereHas('dataRegistrasi', function ($query) {
            $query->where('id_jalur', '4');
        })->get();

        return view('operator.data-afirmasi-abk', compact('data'));
    }


    public function lulus($id)
    {
        // Cari berdasarkan id_calon_siswa
        $data = DataRegistrasi::where('id_calon_siswa', $id)->first();

        if (!$data) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $data->status = '1'; // Gunakan integer, bukan string
        $data->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui');
    }
    public function tidaklulus($id)
    {
        // Cari berdasarkan id_calon_siswa
        $data = DataRegistrasi::where('id_calon_siswa', $id)->first();

        if (!$data) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $data->status = '2'; // Gunakan integer, bukan string
        $data->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui');
    }
}
