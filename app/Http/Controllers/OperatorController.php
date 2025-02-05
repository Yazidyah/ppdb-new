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
    public function showsiswaLulus()
{
    $data = CalonSiswa::whereHas('dataRegistrasi', function ($query) {
        $query->where('status', 1);
    })->get();

    return view('operator.data-lulus', compact('data'));
}
    public function showsiswaTidakLulus()
{
    $data = CalonSiswa::whereHas('dataRegistrasi', function ($query) {
        $query->where('status', 2);
    })->get();

    return view('operator.data-tidaklulus', compact('data'));
}
    public function showsiswaReguler()
{
    $data = CalonSiswa::whereHas('dataRegistrasi', function ($query) {
        $query->where('id_jalur', 1);
    })->get();

    return view('operator.data-reguler', compact('data'));
}
    public function showsiswaPrestasi()
{
    $data = CalonSiswa::whereHas('dataRegistrasi', function ($query) {
        $query->where('id_jalur', 2);
    })->get();

    return view('operator.data-afirmasi-prestasi', compact('data'));
}
    public function showsiswaKetm()
{
    $data = CalonSiswa::whereHas('dataRegistrasi', function ($query) {
        $query->where('id_jalur', 3);
    })->get();

    return view('operator.data-afirmasi-ketm', compact('data'));
}
    public function showsiswaAbk()
{
    $data = CalonSiswa::whereHas('dataRegistrasi', function ($query) {
        $query->where('id_jalur', 4);
    })->get();

    return view('operator.data-afirmasi-abk', compact('data'));
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
