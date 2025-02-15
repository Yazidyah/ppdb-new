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
    public function tambahpersyaratan(Request $request)
    {
        $validator = $this->validatePersyaratan($request);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Persyaratan::create($request->only(['nama_persyaratan', 'id_jalur', 'deskripsi']));

        return redirect()->back()->with('success', 'Persyaratan berhasil ditambahkan.');
    }

    public function updatepersyaratan(Request $request)
    {
        $calonSiswa = Persyaratan::update($request->all());
        return response()->json($calonSiswa, 201);
    }

    public function deletepersyaratan($id)
    {
        $persyaratan = Persyaratan::findOrFail($id);
        $persyaratan->delete();

        return redirect()->back()->with('success', 'Persyaratan berhasil dihapus.');
    }

    public function showsiswa(Request $request)
    {
        $query = $this->buildSiswaQuery($request);

        $sortBy = $request->input('sort_by', 'id_calon_siswa');
        $sortOrder = $request->input('sort_order', 'asc');

        $query = $this->applySorting($query, $sortBy, $sortOrder);

        $data = $query->get()->map(function ($item) {
            $item->nama_lengkap = ucwords(strtolower($item->nama_lengkap));
            $item->jenis_kelamin = $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan';
            return $item;
        });

        $jalurRegistrasi = JalurRegistrasi::all();
        $statuses = DataRegistrasi::select('status')->distinct()->get();
        return view('operator.datasiswa', compact('data', 'jalurRegistrasi', 'statuses'));
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

    public function showPersyaratan(Request $request)
    {
        $filterJalur = $request->input('filter_jalur');
        $query = Persyaratan::query();

        if ($filterJalur) {
            $query->where('id_jalur', $filterJalur);
        }

        $persyaratan = $query->orderBy('id_jalur', 'asc')->get();
        $jalurRegistrasi = JalurRegistrasi::all();
        return view('operator.tambah-persyaratan', compact('persyaratan', 'jalurRegistrasi'));
    }

    public function lulus($id)
    {
        $data = DataRegistrasi::where('id_calon_siswa', $id)->first();

        if (!$data) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $data->status = 1;
        $data->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui');
    }

    public function tidaklulus($id)
    {
        $data = DataRegistrasi::where('id_calon_siswa', $id)->first();

        if (!$data) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $data->status = 2;
        $data->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui');
    }

    private function validatePersyaratan(Request $request)
    {
        return Validator::make($request->all(), [
            'nama_persyaratan' => 'required|string|max:255',
            'id_jalur' => 'required|integer|in:1,2,3,4',
            'deskripsi' => 'nullable|string',
        ]);
    }

    private function buildSiswaQuery(Request $request)
    {
        $query = CalonSiswa::with('dataRegistrasi');

        if ($request->has('search')) {
            $search = strtolower($request->input('search'));
            $query->where(function($q) use ($search) {
                $q->whereRaw('LOWER(nama_lengkap) like ?', ["%$search%"])
                  ->orWhere('NISN', 'like', "%$search%");
            });
        }

        if ($request->has('filter') && $request->input('filter') != '') {
            $filter = $request->input('filter');
            if (in_array($filter, ['L', 'P'])) {
                $query->where('jenis_kelamin', $filter);
            } elseif (in_array($filter, ['NEGERI', 'SWASTA'])) {
                $query->where('status_sekolah', $filter);
            } else {
                $query->whereHas('dataRegistrasi', function($q) use ($filter) {
                    $q->where('status', $filter);
                });
            }
        }

        if ($request->has('jalur') && $request->input('jalur') != '') {
            $jalur = (int) $request->input('jalur');
            $query->whereHas('dataRegistrasi', function($q) use ($jalur) {
                $q->where('id_jalur', $jalur);
            });
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
