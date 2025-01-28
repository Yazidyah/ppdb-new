<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/sementara', function () {
    return view('sementara');
});
Route::get('/home', function () {
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
