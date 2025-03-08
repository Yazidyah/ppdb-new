<?php

namespace App\Http\Controllers;

use App\Models\CalonSiswa;
use App\Models\DataRegistrasi;
use App\Models\Persyaratan;
use App\Models\JalurRegistrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OperatorController extends Controller
{

    public function showsiswa(Request $request)
    {
        $query = $this->buildSiswaQuery($request);

        $sortBy = $request->input('sort_by', 'id_calon_siswa');
        $sortOrder = $request->input('sort_order', 'asc');

        $query = $this->applySorting($query, $sortBy, $sortOrder);

        $data = $query->get()->map(function ($item) {
            $item->nama_lengkap = ucwords(strtolower($item->nama_lengkap));
            $item->jenis_kelamin = $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan';
            $item->status_label = $this->getStatusLabel($item->dataRegistrasi->status ?? null);
            $item->no_telp = $item->no_telp; 
            return $item;
        });

        $jalurRegistrasi = JalurRegistrasi::all();
        $statuses = DataRegistrasi::select('status')->distinct()->get();
        return view('operator.datasiswa', compact('data', 'jalurRegistrasi', 'statuses'));
    }

    private function getStatusLabel($status)
    {
        $statusLabels = [
            0 => 'Jalur',
            1 => 'Upload',
            2 => 'Submit',
            3 => 'Tidak Lolos',
            4 => 'Lolos',
            5 => 'Belum Ditentukan',
            6 => 'Tidak Diterima',
            7 => 'Diterima',
            8 => 'Dicadangkan'
        ];

        return $statusLabels[$status] ?? '-';
    }

    public function showsiswaDetail($id)
    {
        $siswa = CalonSiswa::findOrFail($id);
        return view('operator.data-siswa-detail', compact('siswa'));
    }

    public function showsiswaLulus()
    {
        $data = CalonSiswa::whereHas('dataRegistrasi', function ($query) {
            $query->where('status', 1);
        })->get();

        return view('operator.data-lulus', compact('data'));
    }

    private function buildSiswaQuery(Request $request)
    {
        $query = CalonSiswa::with(['dataRegistrasi.rapot']);

        if ($request->has('search')) {
            $search = strtolower($request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(nama_lengkap) like ?', ["%$search%"])
                    ->orWhere('NISN', 'like', "%$search%");
            });
        }

        if ($request->has('filter') && $request->input('filter') != '') {
            $filter = $request->input('filter');
            $query->whereHas('dataRegistrasi', function ($q) use ($filter) {
                $q->where('status', $filter);
            });
        }

        if ($request->has('jalur') && $request->input('jalur') != '') {
            $jalur = (int) $request->input('jalur');
            $query->whereHas('dataRegistrasi', function ($q) use ($jalur) {
                $q->where('id_jalur', $jalur);
            });
        }

        if ($request->has('sekolah_asal') && $request->input('sekolah_asal') != '') {
            $sekolahAsal = strtolower($request->input('sekolah_asal'));
            $query->whereRaw('LOWER(sekolah_asal) like ?', ["%$sekolahAsal%"]);
        }

        return $query;
    }

    private function applySorting($query, $sortBy, $sortOrder)
    {
        $validSortByColumns = ['id_calon_siswa', 'nama_lengkap', 'NISN', 'sekolah_asal', 'jenis_kelamin', 'status'];
        if (!in_array($sortBy, $validSortByColumns)) {
            $sortBy = 'id_calon_siswa';
        }

        if (!in_array($sortOrder, ['asc', 'desc'])) {
            $sortOrder = 'asc';
        }

        if ($sortBy == 'status') {
            $query->join('data_registrasi', 'calon_siswa.id_calon_siswa', '=', 'data_registrasi.id_calon_siswa')
                ->orderBy('data_registrasi.status', $sortOrder);
        } else {
            $query->orderBy($sortBy, $sortOrder);
        }

        return $query;
    }
}
