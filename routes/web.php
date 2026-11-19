<?php

use App\Http\Controllers\PenelitianController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PenulisController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/akses', function ()
    {
        return view('akses.index');
    });

Route::get('/info', function ()
    {
        return view('info.index');
    });

Route::get('/depanp' , [PenelitianController::class, 'depanp'])->name('penelitian.depanp');
Route::get('/depanb', [BeritaController::class, 'depanb'])->name('berita.depanb');
Route::get('/adepan' , [AnggotaController::class, 'adepan'])->name('anggota.adepan');

Route::resource('penelitian', PenelitianController::class);
Route::resource('anggota', AnggotaController::class);
Route::resource('berita', BeritaController::class);

Route::get('/login', [PenulisController::class, 'index'])
    ->name('login');

Route::post('/login', [PenulisController::class, 'login'])
    ->name('login.proses');

Route::post('/logout', [PenulisController::class, 'logout'])
    ->name('logout');
