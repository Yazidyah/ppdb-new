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

    public function searchByNpsn(Request $request)
    {
        $npsn = trim((string) $request->query('npsn'));
        if ($npsn === '' || !preg_match('/^\d{1,8}$/', $npsn)) {
            return response()->json([
                'error' => 'NPSN tidak valid. Harus angka maksimal 8 digit.'
            ], 422);
        }

        /**
         * DB-first strategy: try local data_sekolah first; only scrape if not found.
         * Then upsert calon_siswa with the same school metadata to ensure consistency.
         */
        /** @var DataSekolahService $service */
        $service = app(DataSekolahService::class);
        $dataSekolah = $service->getOrFetchByNpsn($npsn);

        if (!$dataSekolah) {
            return response()->json([
                'error' => 'Referensi sekolah tidak tersedia saat ini dan belum ada di database lokal.'
            ], 503);
        }

        // Upsert calon_siswa rows referencing this NPSN if business rule requires immediate synchronization.
        // Here we demonstrate an example upsert-by-NPSN for the currently authenticated user, if provided.
        // If this endpoint is meant to be pure lookup, you can remove the upsert block.
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
            // Do not fail the entire request if local data exists; just return the school data and a warning.
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
            'predikat_akreditasi_sekolah' => $dataSekolah->predikat_akreditasi_sekolah,
            'nilai_akreditasi_sekolah' => $dataSekolah->nilai_akreditasi_sekolah,
        ]);
    }
}
