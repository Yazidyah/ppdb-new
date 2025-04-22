<?php

use App\Http\Controllers\OperatorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GetPersyaratan;
use App\Http\Controllers\DashboardController;
use App\Livewire\Admin\DataSiswa;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Siswa;
use App\Http\Middleware\Operator;
use App\Livewire\Counter;
use App\Livewire\Siswa\StepSatu;
use App\Http\Controllers\PekerjaanOrangTuaController;
use App\Http\Controllers\Operator\VerifOpController;
use App\Livewire\Operator\StatusAcc;
use App\Livewire\Operator\KonfigurasiPersyaratan;
use App\Livewire\Operator\KonfigurasiJalur;
use App\Livewire\Operator\KonfigurasiTes;
use App\Livewire\Operator\DatasiswaModal;

use App\Livewire\Registrasi\StepDua;
use App\Livewire\Dokumen\StepTiga;
use App\Livewire\Verifikasi\StepEmpat;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\NpsnController;

use App\Livewire\Admin\Dashboard;

// Route::get('/log-viewer', 'LogViewerController@index')->middleware('auth');


Route::get('/sementara', function () {
    return view('sementara');
});
Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/alurpendaftaran', function () {
    return view('alurpendaftaran');
});

Route::get('/persyaratan', [GetPersyaratan::class, 'showPersyaratan'])->name('persyaratan.show');

Route::get('/daftar/step1', function () {
    return view('daftar');
});
Route::get('/daftar/step2', function () {
    return view('daftar-step2');
});
Route::get('/daftar/step3/prestasi', function () {
    return view('daftar-step3-prestasi');
});
Route::get('/daftar/step3/KETM', function () {
    return view('daftar-step3-ketm');
});
Route::get('/daftar/step3/AnakBerkemampuanKhusus', function () {
    return view('daftar-step3-abk');
});
Route::get('/daftar/step4', function () {
    return view('daftar-step4');
});


Route::get('/coba', Counter::class)->name('testing');


Route::middleware(['auth', 'verified', 'siswa'])->group(function () {
    Route::get('/siswa/', function () {
        return redirect()->route('siswa.dashboard');
    });
    Route::get('/siswa/dashboard', [SiswaController::class, 'index'])->name('siswa.dashboard');
    Route::get('/siswa/alurpendaftaran', function () {
        return view('siswa.alurpendaftaran');
    })->name('siswa.alurpendaftaran');
    Route::get('/siswa/persyaratan', [SiswaController::class, 'showPersyaratan'])->name('siswa.persyaratan');
    

    Route::get('/siswa/daftar-reguler', function () {
        return view('siswa.daftar-reguler');
    })->name('siswa.daftar-reguler');
    Route::get('/siswa/daftar-step1', function () {
        return view('siswa.daftar-step1');
    })->name('siswa.daftar-step1');
    Route::get('/siswa/daftar-step-satu', StepSatu::class)->name('siswa.daftar-step-satu');
    Route::get('/siswa/daftar-step-dua', StepDua::class)->name('siswa.daftar-step-dua');
    Route::get('/siswa/daftar-step-tiga', StepTiga::class)->name('siswa.daftar-step-tiga');
    Route::get('/siswa/daftar-step-empat', StepEmpat::class)->name('siswa.daftar-step-empat');
    Route::get('/siswa/daftar-step2', function () {
        return view('siswa.daftar-step2');
    })->name('tambah-step2');
    Route::post('/siswa/daftar-step2', [SiswaController::class, 'jalur'])->name('siswa.daftar-step2');
    Route::get('/siswa/daftar-step3', [SiswaController::class, 'persyaratan'])->name('siswa.daftar-step3');
});

Route::middleware(['auth', 'verified', 'operator'])->group(function () {
    Route::get('/operator/dashboard', [DashboardController::class, 'index'])->name('operator.dashboard');

    Route::get('/operator/data-afirmasi-prestasi', [OperatorController::class, 'showsiswaPrestasi'])->name('operator.data-afirmasi-prestasi');
    Route::get('/operator/data-afirmasi-abk', [OperatorController::class, 'showsiswaAbk'])->name('operator.data-afirmasi-abk');
    Route::get('/operator/data-afirmasi-ketm', [OperatorController::class, 'showsiswaKetm'])->name('operator.data-afirmasi-ketm');
    Route::get('/operator/persyaratan', function () {
        return view('operator.persyaratan');
    })->name('operator.persyaratan');
    Route::get('/operator/tambah-persyaratan', function () {
        return view('operator.tambah-persyaratan');
    })->name('operator.tambah-persyaratan');
    Route::post('/operator/tambah-persyaratan', [OperatorController::class, 'tambahpersyaratan'])->name('operator.tambah-persyaratan');
    Route::post('/operator/delete-persyaratan/{id}', [OperatorController::class, 'deletepersyaratan'])->name('operator.delete-persyaratan');
    Route::get('/operator/alur-pendaftaran', function () {
        return view('operator.alur-pendaftaran');
    })->name('operator.alur-pendaftaran');
    Route::get('/operator/data-siswa', [OperatorController::class, 'showsiswa'])->name('operator.datasiswa');
    Route::get('/operator/data-siswa/{id}', [OperatorController::class, 'showsiswaDetail'])->name('operator.datasiswa-detail');
    Route::get('/operator/data-reguler', [OperatorController::class, 'showsiswaReguler'])->name('operator.data-reguler');
    Route::get('/operator/data-lulus', [OperatorController::class, 'showsiswaLulus'])->name('operator.data-lulus');
    Route::get('/operator/data-tidaklulus', [OperatorController::class, 'showsiswaTidakLulus'])->name('operator.data-tidaklulus');
    Route::get('/operator/Lulus/{id}', [OperatorController::class, 'lulus'])->name('operator.lulus');
    Route::get('/operator/TidakLulus/{id}', [OperatorController::class, 'tidaklulus'])->name('operator.tidaklulus');
    // Route::get('/operator/tambah-persyaratan', [OperatorController::class, 'showPersyaratan'])->name('operator.show-persyaratan');
    Route::get('/operator/edit-persyaratan/{id}', [OperatorController::class, 'editPersyaratan'])->name('operator.edit-persyaratan');
    Route::post('/operator/update-persyaratan/{id}', [OperatorController::class, 'updatePersyaratan'])->name('operator.update-persyaratan');
    Route::resource('operator/pekerjaan-ortu', PekerjaanOrangTuaController::class);
    Route::get('/operator/tambah-pekerjaan-ortu', function () {
        return redirect()->route('pekerjaan-ortu.index');
    })->name('operator.tambah-pekerjaan-ortu');
    Route::post('/operator/update-status', [VerifOpController::class, 'updateStatus'])->name('operator.updateStatus');
    Route::get('/operator/get-status/{id}', [VerifOpController::class, 'getStatus']);
    Route::post('/operator/update-verif-berkas', [VerifOpController::class, 'updateVerifBerkas'])->name('operator.updateVerifBerkas');
    Route::get('/operator/get-status/{id}', [VerifOpController::class, 'getStatus'])->name('operator.getStatus');
    Route::get('/operator/get-berkas/{id}', [VerifOpController::class, 'getBerkas'])->name('operator.getBerkas');
    Route::post('/operator/update-verif-status', [VerifOpController::class, 'updateVerifStatus'])->name('operator.updateVerifStatus');
    Route::get('/operator/get-status-verif/{id}', [VerifOpController::class, 'getStatusVerif'])->name('operator.getStatusVerif');
    Route::get('/operator/status-acc/{id}', StatusAcc::class)->name('operator.status-acc');
    Route::get('/operator/konfigurasi-persyaratan', KonfigurasiPersyaratan::class)->name('operator.konfigurasi-persyaratan');
    Route::get('/operator/konfigurasi-jalur', KonfigurasiJalur::class)->name('operator.konfigurasi-jalur');
    Route::get('/operator/konfigurasi-tes', KonfigurasiTes::class)->name('operator.konfigurasi-tes');
    Route::get('/operator/datasiswa-modal', DatasiswaModal::class)->name('operator.datasiswa-modal');
});
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/admin/dashboard', Dashboard::class)->name('admin.dashboard');
    Route::get('/admin/persyaratan', function () {
        return view('admin.persyaratan');
    })->name('admin.persyaratan');
    Route::get('/admin/alur-pendaftaran', function () {
        return view('admin.alur-pendaftaran');
    })->name('admin.alur-pendaftaran');
    Route::get('/admin/data-siswa/{id}', DataSiswa::class)->name('admin.data-siswa');

    // Route::get('/admin/data-siswa', function () {
    //     return view('admin.datasiswa');
    // })->name('admin.datasiswa');
    // Route::get('/admin/data-afirmasi-prestasi', function () {
    //     return view('admin.data-afirmasi-prestasi');
    // })->name('admin.data-afirmasi-prestasi');
    // Route::get('/admin/data-afirmasi-abk', function () {
    //     return view('admin.data-afirmasi-abk');
    // })->name('admin.data-afirmasi-abk');
    // Route::get('/admin/data-afirmasi-ketm', function () {
    //     return view('admin.data-afirmasi-ketm');
    // })->name('admin.data-afirmasi-ketm');
    // Route::get('/admin/data-reguler', function () {
    //     return view('admin.data-reguler');
    // })->name('admin.data-reguler');
    // Route::get('/admin/data-lulus', function () {
    //     return view('admin.data-lulus');
    // })->name('admin.data-lulus');
    // Route::get('/admin/data-tidaklulus', function () {
    //     return view('admin.data-tidaklulus');
    // })->name('admin.data-tidaklulus');

    Route::get('/admin/tambah-persyaratan', function () {
        return view('admin.tambah-persyaratan');
    })->name('admin.tambah-persyaratan');
    Route::post('/admin/tambah-persyaratan', [OperatorController::class, 'tambahpersyaratan'])->name('admin.tambah-persyaratan');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('biodata', BiodataController::class);
    Route::get('npsn-data', [BiodataController::class, 'getNpsnData'])->name('npsn.data');
    Route::get('npsn-data/sekolah', [BiodataController::class, 'searchByNpsn'])->name('search.npsn');
    Route::get('npsn-data/sekolah', [BiodataController::class, 'searchBySekolah'])->name('search.sekolah');
});

Route::get('local/temp/{path}', function (string $path) {
    $decoded = base64_decode($path, true);

    if ($decoded === false || !Storage::disk('local')->exists($decoded)) {
        return response('File not found.', 404);
    }

    try {
        return Storage::disk('local')->response($decoded);
    } catch (\Throwable $th) {
        if (app()->isLocal())
            return $th->getMessage();
        return '';
    }
})->name('local.temp');

// Route::get('/fetch-npsn', [NpsnController::class, 'getNpsn']);

require __DIR__ . '/auth.php';
