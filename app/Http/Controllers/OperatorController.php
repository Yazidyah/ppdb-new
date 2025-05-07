<?php

namespace App\Http\Controllers;

use App\Models\CalonSiswa;
use App\Models\DataRegistrasi;
use App\Models\Persyaratan;
use App\Models\JalurRegistrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class OperatorController extends Controller
{

    public function showsiswa(Request $request)
    {
        $query = $this->buildSiswaQuery($request);

        $sortBy = $request->input('sort_by', 'id_calon_siswa');
        $sortOrder = $request->input('sort_order', 'asc');
        $perPage = $request->input('per_page', 10); // Default to 10 items per page

        $query = $this->applySorting($query, $sortBy, $sortOrder);

        $data = $query->paginate($perPage)->withQueryString(); // Use pagination with per_page

        $data->getCollection()->transform(function ($item) {
            $item->nama_lengkap = ucwords(strtolower($item->nama_lengkap));
            $item->jenis_kelamin = $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan';
            $item->status_label = $this->getStatusLabel($item->dataRegistrasi->status ?? null);
            $item->no_telp = $item->no_telp;
            $item->tanggal_daftar = $item->dataRegistrasi->created_at 
                ? Carbon::parse($item->dataRegistrasi->created_at)->locale('id')->translatedFormat('d-M-Y') 
                : '-';
            return $item;
        });

        $jalurRegistrasi = JalurRegistrasi::all();
        $statuses = DataRegistrasi::select('status')->distinct()->get();
        return view('operator.datasiswa', compact('data', 'jalurRegistrasi', 'statuses'));
    }

    private function getStatusLabel($status)
    {
        $statusLabels = [
            0 => 'Biodata',
            1 => 'Jalur',
            2 => 'Upload',
            3 => 'Submit',
            4 => 'Tidak Lolos Verifikasi',
            5 => 'Lolos Verifikasi',
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
        $query = CalonSiswa::with(['dataRegistrasi.rapot', 'dataRegistrasi.dataTes'])
            ->whereHas('user', function ($q) {
                $q->whereNull('deleted_at'); // Only include users where deleted_at is null
            });

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
        $validSortByColumns = ['id_calon_siswa', 'nama_lengkap', 'NISN', 'sekolah_asal', 'jenis_kelamin', 'status', 'total_rata_nilai', 'created_at'];
        if (!in_array($sortBy, $validSortByColumns)) {
            $sortBy = 'id_calon_siswa';
        }

        // Ensure sortOrder is valid
        if (!in_array($sortOrder, ['asc', 'desc'])) {
            $sortOrder = 'asc';
        }

        if ($sortBy == 'status') {
            $query->join('data_registrasi', 'calon_siswa.id_calon_siswa', '=', 'data_registrasi.id_calon_siswa')
                ->orderBy('data_registrasi.status', $sortOrder);
        } elseif ($sortBy == 'total_rata_nilai') {
            $query->join('data_registrasi', 'calon_siswa.id_calon_siswa', '=', 'data_registrasi.id_calon_siswa')
                ->join('rapot', 'data_registrasi.id_registrasi', '=', 'rapot.id_registrasi')
                ->orderBy('rapot.total_rata_nilai', $sortOrder);
        } elseif ($sortBy == 'created_at') {
            $query->join('data_registrasi', 'calon_siswa.id_calon_siswa', '=', 'data_registrasi.id_calon_siswa')
                ->orderBy('data_registrasi.created_at', $sortOrder);
        } else {
            $query->orderBy($sortBy, $sortOrder);
        }

        return $query;
    }

    public function showPersyaratan()
    {
        $jalurRegistrasi = JalurRegistrasi::with('persyaratan')->get();
        return view('operator.persyaratan', ['jalurRegistrasi' => $jalurRegistrasi]);
    }
    public function showPersyaratanAdmin()
    {
        $jalurRegistrasi = JalurRegistrasi::with('persyaratan')->get();
        return view('admin.persyaratan', ['jalurRegistrasi' => $jalurRegistrasi]);
    }
}
