<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\Auth\StudentRegisterController;
use App\Http\Controllers\EkycController;
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
    
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
    Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
    Route::get('/mahasiswa/{id}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
    Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
    Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
    
    Route::get('/ruangan', [RuanganController::class, 'index'])->name('ruangan.index');
    Route::post('/ruangan', [RuanganController::class, 'store'])->name('ruangan.store');
    Route::get('/matkul', [MatkulController::class, 'index'])->name('matkul.index');
    Route::post('/matkul', [MatkulController::class, 'store'])->name('matkul.store');
    Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.index');
    Route::post('/dosen', [DosenController::class, 'store'])->name('dosen.store');
});

    Route::get('/register-mahasiswa', [StudentRegisterController::class, 'showRegistrationForm'])->name('register.mahasiswa');
    Route::post('/register-mahasiswa', [StudentRegisterController::class, 'register']);
    
Route::middleware(['auth'])->prefix('ekyc')->group(function () {
    Route::get('step1', [EkycController::class, 'step1'])->name('ekcy.step1');
    Route::post('step1',[EkycController::class, 'storeStep1'])->name('ekyc.storeStep1');

    // Sementara redirect kosong untuk step2
    Route::get('step2', function () {
        return "Step2: Upload Dokumen (belum dibuat)";
    })->name('ekyc.step2');
});
require __DIR__.'/auth.php';
