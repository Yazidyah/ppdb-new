<?php

use App\Http\Controllers\OperatorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Siswa;
use App\Http\Middleware\Operator;


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

Route::middleware(['auth', 'verified', 'siswa'])->group(function(){
    Route::get('/siswa/dashboard', function () {return view('siswa.dashboard');})->name('siswa.dashboard');
    Route::get('/siswa/daftar-reguler', function () {return view('siswa.daftar-reguler');})->name('siswa.daftar-reguler');
    Route::get('/siswa/daftar-step1', function () {return view('siswa.daftar-step1');})->name('siswa.daftar-step1');
    Route::get('/siswa/daftar-step2', function () {return view('siswa.daftar-step2');})->name('tambah-step2');
    Route::post('/siswa/daftar-step2', [SiswaController::class, 'jalur'])->name('siswa.daftar-step2');
    Route::get('/siswa/daftar-step3', [SiswaController::class, 'persyaratan'])->name('siswa.daftar-step3');
});
Route::middleware(['auth', 'verified', 'operator'])->group(function(){
    Route::get('/operator/dashboard', function () {return view('operator.dashboard');})->name('operator.dashboard');
    Route::get('/operator/persyaratan', function () {return view('operator.persyaratan');})->name('operator.persyaratan');
    Route::get('/operator/tambah-persyaratan', function () {return view('operator.tambah-persyaratan');})->name('operator.tambah-persyaratan');
    Route::post('/operator/tambah-persyaratan', [OperatorController::class, 'tambahpersyaratan'])->name('admin.tambah-persyaratan');
    Route::get('/operator/alur-pendaftaran', function () {return view('operator.alur-pendaftaran');})->name('operator.alur-pendaftaran');
    Route::get('/operator/data-siswa', function () {return view('operator.datasiswa');})->name('operator.datasiswa');
    Route::get('/operator/data-afirmasi-prestasi', function () {return view('operator.data-afirmasi-prestasi');})->name('operator.data-afirmasi-prestasi');
    Route::get('/operator/data-afirmasi-abk', function () {return view('operator.data-afirmasi-abk');})->name('operator.data-afirmasi-abk');
    Route::get('/operator/data-afirmasi-ketm', function () {return view('operator.data-afirmasi-ketm');})->name('operator.data-afirmasi-ketm');
    Route::get('/operator/data-reguler', function () {return view('operator.data-reguler');})->name('operator.data-reguler');
    Route::get('/operator/data-lulus', function () {return view('operator.data-lulus');})->name('operator.data-lulus');
    Route::get('/operator/data-tidaklulus', function () {return view('operator.data-tidaklulus');})->name('operator.data-tidaklulus');
});
Route::middleware(['auth', 'verified', 'admin'])->group(function(){
    Route::get('/admin/dashboard', function () {return view('admin.dashboard');})->name('admin.dashboard');
    Route::get('/admin/persyaratan', function () {return view('admin.persyaratan');})->name('admin.persyaratan');
    Route::get('/admin/alur-pendaftaran', function () {return view('admin.alur-pendaftaran');})->name('admin.alur-pendaftaran');
    Route::get('/admin/data-siswa', function () {return view('admin.datasiswa');})->name('admin.datasiswa');
    Route::get('/admin/data-afirmasi-prestasi', function () {return view('admin.data-afirmasi-prestasi');})->name('admin.data-afirmasi-prestasi');
    Route::get('/admin/data-afirmasi-abk', function () {return view('admin.data-afirmasi-abk');})->name('admin.data-afirmasi-abk');
    Route::get('/admin/data-afirmasi-ketm', function () {return view('admin.data-afirmasi-ketm');})->name('admin.data-afirmasi-ketm');
    Route::get('/admin/data-reguler', function () {return view('admin.data-reguler');})->name('admin.data-reguler');
    Route::get('/admin/data-lulus', function () {return view('admin.data-lulus');})->name('admin.data-lulus');
    Route::get('/admin/data-tidaklulus', function () {return view('admin.data-tidaklulus');})->name('admin.data-tidaklulus');
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

require __DIR__.'/auth.php';
