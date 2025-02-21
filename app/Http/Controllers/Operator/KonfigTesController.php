<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tes;

class KonfigTesController extends Controller
{
    public function index()
    {
        $testSchedules = Tes::all();
        return view('operator.konfigurasi-tes.index', compact('testSchedules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tes' => 'required|string|max:255',
            'jadwal_tes' => 'required|date',
        ]);

        Tes::create($request->all());
        return redirect()->route('konfigurasi-tes.index')->with('success', 'Jadwal Tes berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_tes' => 'required|string|max:255',
            'jadwal_tes' => 'required|date',
        ]);

        $tes = Tes::findOrFail($id);
        $tes->update($request->all());
        return redirect()->route('konfigurasi-tes.index')->with('success', 'Jadwal Tes berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tes = Tes::findOrFail($id);
        $tes->delete();
        return redirect()->route('konfigurasi-tes.index')->with('success', 'Jadwal Tes berhasil dihapus.');
    }
}
