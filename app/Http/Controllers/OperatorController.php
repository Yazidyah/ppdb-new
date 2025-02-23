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
        $validator = Validator::make($request->all(), [
            'nama_persyaratan' => 'required|string|max:255',
            'id_jalur' => 'required|array',
            'id_jalur.*' => 'integer|exists:jalur_registrasi,id_jalur',
            'deskripsi' => 'nullable|string',
        ], [
            'required' => 'Nilai tidak boleh kosong.',
            'exists' => 'Jalur yang dipilih tidak valid.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $jalurIds = array_unique($request->input('id_jalur'));
        foreach ($jalurIds as $idJalur) {
            Persyaratan::create([
                'nama_persyaratan' => $request->input('nama_persyaratan'),
                'id_jalur' => $idJalur,
                'deskripsi' => $request->input('deskripsi')
            ]);
        }
        return redirect()->route('operator.show-persyaratan')->with('success', 'Persyaratan berhasil ditambahkan.');
    }

    public function editPersyaratan($id)
    {
        $persyaratan = Persyaratan::findOrFail($id);
        $jalurRegistrasi = JalurRegistrasi::all();
        return response()->json(['persyaratan' => $persyaratan, 'jalurRegistrasi' => $jalurRegistrasi]);
    }

    public function updatePersyaratan(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_persyaratan' => 'required|string|max:255',
            'id_jalur' => 'required|array',
            'id_jalur.*' => 'integer|exists:jalur_registrasi,id_jalur',
            'deskripsi' => 'nullable|string',
        ], [
            'required' => 'Nilai tidak boleh kosong.',
            'exists' => 'Jalur yang dipilih tidak valid.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $jalurIds = array_unique($request->input('id_jalur'));
        $persyaratan = Persyaratan::findOrFail($id);
        $persyaratan->update([
            'nama_persyaratan' => $request->input('nama_persyaratan'),
            'id_jalur' => $jalurIds[0], // Assuming only one id_jalur is needed for update
            'deskripsi' => $request->input('deskripsi')
        ]);

        return redirect()->route('operator.show-persyaratan')->with('success', 'Persyaratan berhasil diperbarui.');
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
            $item->dataRegistrasi->status_label = $this->getStatusLabel($item->dataRegistrasi->status);
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
            3 => 'Lolos Verifikasi Berkas',
            4 => 'Tidak Lolos Verifikasi Berkas',
            5 => 'Tidak Diterima',
            6 => 'Diterima',
            7 => 'Dicadangkan'
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
