<?php

namespace App\Http\Controllers\Operator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CalonSiswa;
use App\Models\Berkas;
use Illuminate\Support\Facades\Log;

class VerifOpController extends Controller
{
    public function updateVerifStatus(Request $request)
    {
        $request->validate([
            'id_calon_siswa' => 'required|integer|exists:calon_siswa,id_calon_siswa',
            'status' => 'required|integer|in:3,4,5,6,7,8',
        ]);

        $siswa = CalonSiswa::with(['dataRegistrasi', 'user'])
            ->whereHas('user', function($q) {
                $q->whereNull('deleted_at');
            })
            ->findOrFail($request->id_calon_siswa);

        if (!$siswa->dataRegistrasi) {
            Log::error('Failed to update status for student ID: ' . $request->id_calon_siswa . '. Data registrasi tidak ditemukan.');
            return redirect()->route('operator.datasiswa')->with('error', 'Data registrasi tidak ditemukan.');
        }

        $siswa->dataRegistrasi->status = $request->status;
        $siswa->dataRegistrasi->save();
        Log::info('Updated status for student ID: ' . $request->id_calon_siswa . ' to status: ' . $request->status);
        return redirect()->route('operator.datasiswa')->with('success', 'Status verifikasi berhasil diupdate.');
    }

    public function updateVerifBerkas(Request $request)
    {
        $request->validate([
            'id_calon_siswa' => 'required|exists:calon_siswa,id_calon_siswa',
            'verif' => 'array',
            'verif.*' => 'boolean',
            'catatan' => 'array',
            'catatan.*' => 'nullable|string|max:1000',
        ]);

        $siswa = CalonSiswa::whereHas('user', function($q) {
            $q->whereNull('deleted_at');
        })->findOrFail($request->id_calon_siswa);
        
        Log::info('Updating verification for student ID: ' . $request->id_calon_siswa);

        $ownedBerkasIds = Berkas::where('uploader_id', $siswa->id_calon_siswa)->pluck('id')->toArray();

        if ($request->has('verif') || $request->has('catatan')) {
            if (is_array($request->verif)) {
                $submittedBerkasIds = array_keys($request->verif);
                $invalidIds = array_diff($submittedBerkasIds, $ownedBerkasIds);
                if (!empty($invalidIds)) {
                    Log::warning('Attempt to verify berkas not belonging to student ID: ' . $request->id_calon_siswa . '. Invalid IDs: ' . implode(',', $invalidIds));
                    return redirect()->route('operator.datasiswa')->with('error', 'Berkas tidak valid untuk siswa ini.');
                }

                foreach ($request->verif as $berkasId => $verif) {
                    $berkas = Berkas::find($berkasId);
                    if ($berkas && $berkas->uploader_id == $siswa->id_calon_siswa) {
                        $berkas->verify = $verif ? 1 : 0;
                        $berkas->verify_notes = $request->catatan[$berkasId] ?? '';
                        $berkas->save();
                    }
                }

                $uncheckedBerkasIds = array_diff($ownedBerkasIds, $submittedBerkasIds);

                foreach ($uncheckedBerkasIds as $berkasId) {
                    $berkas = Berkas::find($berkasId);
                    if ($berkas) {
                        $berkas->verify = 0;
                        $berkas->verify_notes = $request->catatan[$berkasId] ?? '';
                        $berkas->save();
                    }
                }
            }
        }

        return redirect()->route('operator.datasiswa')->with('success', 'Verifikasi berkas berhasil diupdate.');
    }

    public function getStatusVerif($id)
    {
        $siswa = CalonSiswa::with('dataRegistrasi')
            ->whereHas('user', function($q) {
                $q->whereNull('deleted_at');
            })
            ->findOrFail($id);

        if (!$siswa->dataRegistrasi) {
            return response()->json(['error' => 'Data registrasi tidak ditemukan.'], 404);
        }

        return response()->json([
            'status' => $siswa->dataRegistrasi->status,
        ]);
    }

    public function getBerkas($id)
    {
        $siswa = CalonSiswa::with([
            'dataRegistrasi.berkas' => function($query) use ($id) {
                $query->where('uploader_id', $id);
            },
            'dataRegistrasi.berkas.kategoriBerkas',
            'user'
        ])
        ->whereHas('user', function($q) {
            $q->whereNull('deleted_at');
        })
        ->findOrFail($id);

        if (!$siswa->dataRegistrasi) {
            return response()->json(['error' => 'Data registrasi tidak ditemukan.'], 404);
        }

        $dokumen = $siswa->dataRegistrasi->berkas ? $siswa->dataRegistrasi->berkas
            ->map(function ($berkas) {
            return [
                'id' => $berkas->id,
                'path' => $berkas->path,
                'nama' => $berkas->kategoriBerkas->nama ?? 'Tidak ada nama',
                'verif' => $berkas->verify,
                'catatan' => $berkas->verify_notes,
                'kategori_berkas_id' => $berkas->kategori_berkas_id,
            ];
        })->toArray() : [];

        // Sort dokumen by kategori_berkas_id
        usort($dokumen, function ($a, $b) {
            return $a['kategori_berkas_id'] <=> $b['kategori_berkas_id'];
        });

        return response()->json([
            'dokumen' => $dokumen,
        ]);
    }
}
