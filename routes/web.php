<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return "Hello World dari Laravel!";
});

Route::get('/nama', function () {
    return "Hello, nama saya anas fajar !";
});

Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
Route::post('/mahasiswa', [MahasiswaController::class, 'store']);