<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BiodataController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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
