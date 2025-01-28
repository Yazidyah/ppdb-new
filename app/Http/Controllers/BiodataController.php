<?php

namespace App\Http\Controllers;

use App\Models\CalonSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BiodataController extends Controller
{
    public function index()
    {
        $calonSiswa = CalonSiswa::all();
        return response()->json($calonSiswa);
    }

    public function show($id)
    {
        $calonSiswa = CalonSiswa::findOrFail($id);
        return response()->json($calonSiswa);
    }

    public function store(Request $request)
    {
        $calonSiswa = CalonSiswa::create($request->all());
        return response()->json($calonSiswa, 201);
    }

    public function update(Request $request, $id)
    {
        $calonSiswa = CalonSiswa::findOrFail($id);
        $calonSiswa->update($request->all());
        return response()->json($calonSiswa);
    }

    public function destroy($id)
    {
        $calonSiswa = CalonSiswa::findOrFail($id);
        $calonSiswa->delete();
        return response()->json(null, 204);
    }

    public function getNpsnData()
    {
        $apiUrl = env('NPSN_API_BASE_URL') . '/sekolah/SMP?page=1&perPage=5';
        $response = Http::get($apiUrl);

        if ($response->successful()) {
            $data = $response->json();
            $filteredData = array_map(function ($item) {
                return [
                    'npsn' => $item['npsn'],
                    'sekolah' => $item['sekolah']
                ];
            }, $data['dataSekolah']);
            return response()->json($filteredData);
        }

        return response()->json(['error' => 'Failed to fetch data'], 500);
    }

    public function searchByNpsn(Request $request)
    {
        $npsn = $request->query('npsn');
        $apiUrl = env('NPSN_API_BASE_URL') . "/sekolah?npsn={$npsn}";
        $response = Http::get($apiUrl);

        if ($response->successful()) {
            $data = $response->json();
            $filteredData = array_map(function ($item) {
                return [
                    'npsn' => $item['npsn'],
                    'sekolah' => $item['sekolah']
                ];
            }, $data['dataSekolah']);
            return response()->json($filteredData);
        }

        return response()->json(['error' => 'Failed to fetch data'], 500);
    }

    public function searchBySekolah(Request $request)
    {
        $nama = $request->query('nama');
        $nama = preg_replace('/^SMP\s*/', '', $nama);
        $apiUrl = env('NPSN_API_BASE_URL') . "/sekolah/s?sekolah=SMP%20{$nama}";
        $response = Http::get($apiUrl);

        if ($response->successful()) {
            $data = $response->json();
            $filteredData = array_map(function ($item) {
                return [
                    'npsn' => $item['npsn'],
                    'sekolah' => $item['sekolah']
                ];
            }, $data['dataSekolah']);
            return response()->json($filteredData);
        }

        return response()->json(['error' => 'Failed to fetch data'], 500);
    }
}
