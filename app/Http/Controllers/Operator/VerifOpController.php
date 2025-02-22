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


        $siswa = CalonSiswa::with('dataRegistrasi')->find($request->id_calon_siswa);
        if ($siswa && $siswa->dataRegistrasi) {
            $siswa->dataRegistrasi->status = $request->status;
            $siswa->dataRegistrasi->save();
            Log::info('Updated status for student ID: ' . $request->id_calon_siswa . ' to status: ' . $request->status);
            return redirect()->route('operator.datasiswa')->with('success', 'Status verifikasi berhasil diupdate.');
        } else {
            Log::error('Failed to update status for student ID: ' . $request->id_calon_siswa . '. Data registrasi tidak ditemukan.');
            return redirect()->route('operator.datasiswa')->with('error', 'Data registrasi tidak ditemukan.');
        }
    }

    public function updateVerifBerkas(Request $request)
    {
        $request->validate([
            'id_calon_siswa' => 'required|exists:calon_siswa,id_calon_siswa',
            'verif' => 'array',
            'catatan' => 'array',
        ]);

        $siswa = CalonSiswa::find($request->id_calon_siswa);
        Log::info('Updating verification for student ID: ' . $request->id_calon_siswa);

        if ($request->has('verif') || $request->has('catatan')) {
            if (is_array($request->verif)) {
                foreach ($request->verif as $berkasId => $verif) {
                    $berkas = Berkas::find($berkasId);
                    if ($berkas) {
                        $berkas->verify = $verif ? 1 : 0;
                        $berkas->verify_notes = $request->catatan[$berkasId] ?? '';
                        $berkas->save();
                        Log::info('Updated Berkas ID: ' . $berkasId . ' with verify: ' . $berkas->verify . ' and notes: ' . $berkas->verify_notes);
                    } else {
                        Log::warning('Berkas ID not found: ' . $berkasId);
                    }
                }

                // Handle unchecked items
                $allBerkasIds = Berkas::where('uploader_id', $siswa->id_calon_siswa)->pluck('id')->toArray();
                $uncheckedBerkasIds = array_diff($allBerkasIds, array_keys($request->verif));

                foreach ($uncheckedBerkasIds as $berkasId) {
                    $berkas = Berkas::find($berkasId);
                    if ($berkas) {
                        $berkas->verify = 0;
                        $berkas->verify_notes = $request->catatan[$berkasId] ?? '';
                        $berkas->save();
                        Log::info('Unchecked Berkas ID: ' . $berkasId . ' set verify to 0 and notes: ' . $berkas->verify_notes);
                    } else {
                        Log::warning('Berkas ID not found: ' . $berkasId);
                    }
                }
            }
        }

        return redirect()->route('operator.datasiswa')->with('success', 'Verifikasi berkas berhasil diupdate.');
    }

    public function getStatusVerif($id)
    {
        $siswa = CalonSiswa::with('dataRegistrasi')->findOrFail($id);

        return response()->json([
            'status' => $siswa->dataRegistrasi->status,
        ]);
    }

    public function getBerkas($id)
    {
        $siswa = CalonSiswa::with(['dataRegistrasi.berkas.kategoriBerkas'])->findOrFail($id);

        $dokumen = $siswa->dataRegistrasi->berkas ? $siswa->dataRegistrasi->berkas->map(function ($berkas) {
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
