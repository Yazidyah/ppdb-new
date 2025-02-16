<?php

use App\Http\Controllers\OperatorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Siswa;
use App\Http\Middleware\Operator;
use App\Livewire\Counter;
use App\Livewire\Siswa\StepSatu;




use App\Livewire\Registrasi\StepDua;
use App\Livewire\Dokumen\StepTiga;
use App\Livewire\Verifikasi\StepEmpat;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\NpsnController;


use App\Livewire\Admin\Dashboard;


Route::get('/sementara', function () {
    return view('sementara');
});
Route::get('/', function () {
    return view('home');
});
Route::get('/alurpendaftaran', function () {
    return view('alurpendaftaran');
});
Route::get('/persyaratan', function () {
    return view('persyaratan');
});
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
    Route::get('/siswa/dashboard', function () {
        return view('siswa.dashboard');
    })->name('siswa.dashboard');
    Route::get('/siswa/alurpendaftaran', function () {
        return view('siswa.alurpendaftaran');
    })->name('siswa.alurpendaftaran');
    Route::get('/siswa/persyaratan', function () {
        return view('siswa.persyaratan');
    })->name('siswa.persyaratan');

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
    Route::get('/operator/dashboard', function () {
        return view('operator.dashboard');
    })->name('operator.dashboard');

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
    Route::get('/operator/tambah-persyaratan', [OperatorController::class, 'showPersyaratan'])->name('operator.show-persyaratan');
    Route::get('/operator/edit-persyaratan/{id}', [OperatorController::class, 'editPersyaratan'])->name('operator.update-persyaratan');
    Route::post('/operator/update-persyaratan/{id}', [OperatorController::class, 'updatePersyaratan'])->name('operator.update-persyaratan');
    Route::get('/operator/tambah-jalur', function () {
        return view('operator.tambah-jalur');
    })->name('operator.tambah-jalur');
    Route::get('/operator/tambah-jalur', [OperatorController::class, 'showJalur'])->name('operator.show-jalur');
    Route::post('/operator/tambah-jalur', [OperatorController::class, 'tambahJalur'])->name('operator.tambah-jalur');
    Route::post('/operator/delete-jalur/{id}', [OperatorController::class, 'deleteJalur'])->name('operator.delete-jalur');
    Route::get('/operator/edit-jalur/{id}', [OperatorController::class, 'editJalur'])->name('operator.edit-jalur');
    Route::post('/operator/update-jalur/{id}', [OperatorController::class, 'updateJalur'])->name('operator.update-jalur');
});
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/admin/dashboard', Dashboard::class)->name('admin.dashboard');
    Route::get('/admin/persyaratan', function () {
        return view('admin.persyaratan');
    })->name('admin.persyaratan');
    Route::get('/admin/alur-pendaftaran', function () {
        return view('admin.alur-pendaftaran');
    })->name('admin.alur-pendaftaran');
    
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

Route::get('/fetch-npsn', [NpsnController::class, 'getNpsn']);

require __DIR__ . '/auth.php';
