<?php

namespace App\Http\Controllers;

use App\Models\CalonSiswa;
use App\Models\DataSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Services\DataSekolahService;

class BiodataController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        $calonSiswa = CalonSiswa::with('user')->get();
        return response()->json($calonSiswa);
    }

    public function show($id)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        $calonSiswa = CalonSiswa::with('user')->findOrFail($id);
        return response()->json($calonSiswa);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_user' => 'required|integer|exists:users,id',
            'nama_lengkap' => 'required|string|max:255',
            'NIK' => 'required|string|size:16',
            'NISN' => 'required|string|max:20',
            'no_telp' => 'nullable|string|max:20',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'NPSN' => 'nullable|string|max:10|alpha_num',
            'sekolah_asal' => 'nullable|string|max:255',
            'status_sekolah' => 'nullable|string|max:50',
            'alamat_domisili' => 'nullable|string|max:500',
            'alamat_kk' => 'nullable|string|max:500',
            'id_provinsi' => 'nullable|integer',
            'id_kota' => 'nullable|integer',
            'predikat_akreditasi_sekolah' => 'nullable|string|max:10',
            'nilai_akreditasi_sekolah' => 'nullable|numeric',
        ]);

        $calonSiswa = CalonSiswa::create($validated);
        return response()->json($calonSiswa, 201);
    }

    public function update(Request $request, $id)
    {
        $calonSiswa = CalonSiswa::findOrFail($id);

        $validated = $request->validate([
            'nama_lengkap' => 'sometimes|string|max:255',
            'NIK' => 'sometimes|string|size:16',
            'NISN' => 'sometimes|string|max:20',
            'no_telp' => 'nullable|string|max:20',
            'jenis_kelamin' => 'sometimes|in:L,P',
            'tanggal_lahir' => 'sometimes|date',
            'tempat_lahir' => 'sometimes|string|max:255',
            'NPSN' => 'nullable|string|max:10|alpha_num',
            'sekolah_asal' => 'nullable|string|max:255',
            'status_sekolah' => 'nullable|string|max:50',
            'alamat_domisili' => 'nullable|string|max:500',
            'alamat_kk' => 'nullable|string|max:500',
            'id_provinsi' => 'nullable|integer',
            'id_kota' => 'nullable|integer',
            'predikat_akreditasi_sekolah' => 'nullable|string|max:10',
            'nilai_akreditasi_sekolah' => 'nullable|numeric',
        ]);

        $calonSiswa->update($validated);
        return response()->json($calonSiswa);
    }

    public function destroy($id)
    {
        $calonSiswa = CalonSiswa::findOrFail($id);
        $calonSiswa->delete();
        return response()->json(null, 204);
    }

    public function searchByNpsn(Request $request)
    {
        // Validate NPSN input
        $request->validate([
            'npsn' => 'required|string|regex:/^[A-Za-z0-9]{1,10}$/',
        ]);

        $npsn = trim($request->query('npsn'));

        $service = app(DataSekolahService::class);
        $result = $service->getOrFetchByNpsnResult($npsn);

        if (($result['status'] ?? null) === 'service_down') {
            return response()->json([
                'error' => 'Layanan referensi sekolah sedang tidak dapat diakses.'
            ], 503);
        }

        $dataSekolah = $result['data'] ?? null;

        if (!$dataSekolah) {
            return response()->json([
                'error' => 'Referensi sekolah tidak ditemukan.'
            ], 404);
        }

        $bentuk = strtoupper(trim((string) $dataSekolah->bentuk_sekolah));
        $allowed = in_array($bentuk, ['SMP', 'MTS'], true);
        if (!$allowed) {
            return response()->json([
                'error' => 'Masukkan NPSN Sekolah SMP/MTs Sederajat'
            ], 422);
        }

        try {
            DB::transaction(function () use ($dataSekolah) {
                CalonSiswa::updateOrCreate(
                    ['NPSN' => $dataSekolah->npsn],
                    [
                        'sekolah_asal' => $dataSekolah->sekolah_asal,
                        'status_sekolah' => $dataSekolah->status_sekolah,
                        'predikat_akreditasi_sekolah' => $dataSekolah->predikat_akreditasi_sekolah,
                        'nilai_akreditasi_sekolah' => $dataSekolah->nilai_akreditasi_sekolah,
                    ]
                );
            });
        } catch (\Throwable $e) {
            return response()->json([
                'warning' => 'Data sekolah ditemukan namun sinkronisasi calon_siswa gagal.',
                'sekolah' => [
                    'npsn' => $dataSekolah->npsn,
                    'sekolah_asal' => $dataSekolah->sekolah_asal,
                    'status_sekolah' => $dataSekolah->status_sekolah,
                    'predikat_akreditasi_sekolah' => $dataSekolah->predikat_akreditasi_sekolah,
                    'nilai_akreditasi_sekolah' => $dataSekolah->nilai_akreditasi_sekolah,
                ],
            ], 200);
        }

        return response()->json([
            'npsn' => $dataSekolah->npsn,
            'sekolah_asal' => $dataSekolah->sekolah_asal,
            'status_sekolah' => $dataSekolah->status_sekolah,
            'bentuk_sekolah' => $dataSekolah->bentuk_sekolah,
            'predikat_akreditasi_sekolah' => $dataSekolah->predikat_akreditasi_sekolah,
            'nilai_akreditasi_sekolah' => $dataSekolah->nilai_akreditasi_sekolah,
        ]);
    }
}
