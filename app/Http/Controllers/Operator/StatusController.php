<?php
namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CalonSiswa;

class StatusController extends Controller
{
    public function updateStatus(Request $request)
    {
        $request->validate([
            'id_calon_siswa' => 'required|exists:calon_siswa,id_calon_siswa',
            'status' => 'required|in:5,6,7,8',
        ]);

        $siswa = CalonSiswa::find($request->id_calon_siswa);
        $siswa->dataRegistrasi->status = $request->status;
        $siswa->dataRegistrasi->save();

        return redirect()->route('operator.datasiswa')->with('success', 'Status berhasil diubah.');
    }

    public function getStatus($id)
    {
        $siswa = CalonSiswa::findOrFail($id);
        return response()->json(['status' => $siswa->dataRegistrasi->status]);
    }
}