<?php

namespace App\Http\Controllers;

use App\Models\CalonSiswa;
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
}
