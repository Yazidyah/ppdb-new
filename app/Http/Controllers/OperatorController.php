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

        $idJalurArray = $request->input('id_jalur');
        foreach ($idJalurArray as $idJalur) {
            Persyaratan::create([
                'nama_persyaratan' => $request->input('nama_persyaratan'),
                'id_jalur' => $idJalur,
                'deskripsi' => $request->input('deskripsi')
            ]);
        }

        return redirect()->back()->with('success', 'Persyaratan berhasil ditambahkan.');
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
    
    

    public function editPersyaratan($id)
    {
        $persyaratan = Persyaratan::findOrFail($id);
        $jalurRegistrasi = JalurRegistrasi::all();
        return response()->json(['persyaratan' => $persyaratan, 'jalurRegistrasi' => $jalurRegistrasi]);
    }

    public function updatePersyaratan(Request $request, $id)
    {
        $validator = $this->validatePersyaratan($request);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $persyaratan = Persyaratan::findOrFail($id);
        $persyaratan->update($request->only(['nama_persyaratan', 'id_jalur', 'deskripsi']));

        return redirect()->route('operator.show-persyaratan')->with('success', 'Persyaratan berhasil diperbarui.');
    }

    private function validatePersyaratan(Request $request)
    {
        return Validator::make($request->all(), [
            'nama_persyaratan' => 'required|string|max:255',
            'id_jalur' => 'required|array',
            'id_jalur.*' => 'integer|in:1,2,3,4',
            'deskripsi' => 'nullable|string',
        ]);
    }

    private function buildSiswaQuery(Request $request)
    {
        $query = CalonSiswa::with(['dataRegistrasi.rapot']);

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

    public function showJalur(Request $request)
    {
        $jalurRegistrasi = JalurRegistrasi::orderBy('id_jalur', 'asc')->get();
        return view('operator.tambah-jalur', compact('jalurRegistrasi'));
    }

    public function tambahJalur(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_jalur' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_buka' => 'required|date',
            'tanggal_tutup' => 'required|date|after:tanggal_buka',
            'is_open' => 'required|boolean',
        ],[
            'required' => 'Nilai tidak boleh kosong.',
            'after' => 'Tanggal tutup tutup tidak boleh lebih dari tanggal buka.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        JalurRegistrasi::create($request->only(['nama_jalur', 'deskripsi', 'tanggal_buka', 'tanggal_tutup', 'is_open']));

        return redirect()->back()->with('success', 'Jalur Registrasi berhasil ditambahkan.');
    }

    public function deleteJalur($id)
    {
        $jalur = JalurRegistrasi::findOrFail($id);
        $jalur->delete();

        return redirect()->back()->with('success', 'Jalur Registrasi berhasil dihapus.');
    }

    public function editJalur($id)
    {
        $jalur = JalurRegistrasi::findOrFail($id);
        return response()->json(['jalur' => $jalur]);
    }

    public function updateJalur(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_jalur' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_buka' => 'required|date',
            'tanggal_tutup' => 'required|date|after:tanggal_buka',
            'is_open' => 'required|boolean',
        ],[
            'required' => 'Nilai tidak boleh kosong.',
            'after' => 'Tanggal tutup tutup tidak boleh lebih dari tanggal buka.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $jalur = JalurRegistrasi::findOrFail($id);
        $jalur->update($request->only(['nama_jalur', 'deskripsi', 'tanggal_buka', 'tanggal_tutup', 'is_open']));

        return redirect()->route('operator.show-jalur')->with('success', 'Jalur Registrasi berhasil diperbarui.');
    }
}
