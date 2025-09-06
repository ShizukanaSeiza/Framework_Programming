<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return "Hello World dari Laravel!";
});

Route::get('/nama', function () {
    return "Hello, nama saya anas fajar !";
});