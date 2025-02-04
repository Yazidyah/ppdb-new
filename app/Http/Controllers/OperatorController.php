<?php

namespace App\Http\Controllers;

use App\Models\CalonSiswa;
use App\Models\DataRegistrasi;
use App\Models\Persyaratan;
use Illuminate\Http\Request;


class OperatorController extends Controller
{

public function tambahpersyaratan(Request $request)
    {
        $calonSiswa = Persyaratan::create($request->all());
        return response()->json($calonSiswa, 201);
    }
public function updatepersyaratan(Request $request)
    {
        $calonSiswa = Persyaratan::update($request->all());
        return response()->json($calonSiswa, 201);
    }

    public function showsiswa(Request $request)
    {
        $data = CalonSiswa::all();
        return view('operator.datasiswa', compact('data'));
    }
    public function showsiswaLulus(Request $request)
    {
        $data = CalonSiswa::when(DataRegistrasi::where('status', '1'));
        return view('operator.data-lulus', compact('data'));
    }
    public function showsiswaTidakLulus(Request $request)
    {
        $data = CalonSiswa::when(DataRegistrasi::where('status', '2'));
        return view('operator.data-tidaklulus', compact('data'));
    }

    public function lulus($id){
        $data = DataRegistrasi::find($id);
        $data->status = '1';
        $data->save();
        return redirect()->back();
    }
    public function tidaklulus($id){
        $data = DataRegistrasi::find($id);
        $data->status = '2';
        $data->save();
        return redirect()->back();
    }
}
