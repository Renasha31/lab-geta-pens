
<?php

use App\Http\Controllers\PenelitianController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PenulisController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// GANTI BAHASA
Route::get('/language/{locale}', function ($locale) {
    if (!in_array($locale, ['id', 'en'])) {
        abort(404);
    }

    session(['locale' => $locale]);

    return redirect()->back();
})->name('language');

// HALAMAN AKSES
Route::get('/akses', function () {
    return view('akses.index');
});

// HALAMAN INFORMASI LAB
Route::get('/info', function () {
    return view('info.index');
});

// HALAMAN DEPAN
Route::get('/depanp', [PenelitianController::class, 'depanp'])
    ->name('penelitian.depanp');

Route::get('/depanb', [BeritaController::class, 'depanb'])
    ->name('berita.depanb');

Route::get('/adepan', [AnggotaController::class, 'adepan'])
    ->name('anggota.adepan');

// RESOURCE
Route::resource('penelitian', PenelitianController::class);
Route::resource('anggota', AnggotaController::class);
Route::resource('berita', BeritaController::class);

// LOGIN
Route::get('/login', [PenulisController::class, 'index'])
    ->name('login');

Route::post('/login', [PenulisController::class, 'login'])
    ->name('login.proses');

// LOGOUT
Route::post('/logout', [PenulisController::class, 'logout'])
    ->name('logout');
