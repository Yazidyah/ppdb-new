<?php

namespace App\Http\Controllers;

use App\Models\PekerjaanOrangTua;
use Illuminate\Http\Request;

class PekerjaanOrangTuaController extends Controller
{
    public function index()
    {
        $pekerjaanOrtu = PekerjaanOrangTua::orderBy('id_pekerjaan', 'asc')->get();
        return view('operator.pekerjaan-ortu.index', compact('pekerjaanOrtu'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pekerjaan' => 'required|string|max:255',
        ]);

        PekerjaanOrangTua::create($request->all());
        return redirect()->route('pekerjaan-ortu.index')->with('success', 'Pekerjaan Orang Tua berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pekerjaan' => 'required|string|max:255',
        ]);

        $pekerjaanOrtu = PekerjaanOrangTua::findOrFail($id);
        $pekerjaanOrtu->update($request->all());
        return redirect()->route('pekerjaan-ortu.index')->with('success', 'Pekerjaan Orang Tua berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pekerjaanOrtu = PekerjaanOrangTua::findOrFail($id);
        $pekerjaanOrtu->delete();
        return redirect()->route('pekerjaan-ortu.index')->with('success', 'Pekerjaan Orang Tua berhasil dihapus.');
    }
}
