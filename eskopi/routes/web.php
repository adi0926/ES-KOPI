<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/panduanpengguna', [App\Http\Controllers\HomeController::class, 'panduanpengguna'])->name('panduanpengguna');
Route::get('/hubungikami', [App\Http\Controllers\HomeController::class, 'hubungikami'])->name('hubungikami');

// Auth
Route::middleware('guest')->group(function () {
    Route::get('/daftar', [App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('daftar');
    Route::get('/pendaftaran', [App\Http\Controllers\Auth\RegisterController::class, 'formpendaftaran'])->name('pendaftaran');
    Route::post('/pendaftaran/post', [App\Http\Controllers\Auth\RegisterController::class, 'postpendaftaran'])->name('postpendaftaran');
    Route::get('/masuk', [App\Http\Controllers\Auth\LoginController::class, 'index'])->name('masuk');
    Route::get('/masukasn', [App\Http\Controllers\Auth\LoginController::class, 'loginasn'])->name('masukasn');
    Route::get('/masuknon', [App\Http\Controllers\Auth\LoginController::class, 'loginnon'])->name('masuknon');
    Route::post('/masukasn/post', [App\Http\Controllers\Auth\LoginController::class, 'postmasukasn'])->name('postmasukasn');
    
    Route::get('/auth/sso', [App\Http\Controllers\Auth\LoginController::class, 'redirectToSso'])->name('authsso');
    Route::get('/auth/sso/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleSsoCallback'])->name('calbacksso');
});

Route::get('/kota/{id}', [App\Http\Controllers\Auth\RegisterController::class, 'getKota'])->name('getKota');
    
// Diklat
Route::get('/diklat', [App\Http\Controllers\DiklatController::class, 'diklat'])->name('diklat');
Route::get('/diklat/{id_diklat}', [App\Http\Controllers\DiklatController::class, 'showdiklat'])->name('diklatdetail');
Route::get('/filter-diklat', [App\Http\Controllers\DiklatController::class, 'filterDiklatByCategory'])->name('filterDiklatByCategory');

// Peserta
Route::prefix('peserta')->middleware('auth')->group(function () {
    Route::get('/download-certificate', [App\Http\Controllers\Peserta\PesertaController::class, 'downloadCertificate'])->name('peserta.download-certificate');
    Route::get('/dasbor', [App\Http\Controllers\Peserta\PesertaController::class, 'dasbor'])->name('peserta.dasbor');
    Route::get('/diklatsaya', [App\Http\Controllers\Peserta\PesertaController::class, 'diklatsaya'])->name('peserta.diklatsaya');
    Route::get('/sertifikat', [App\Http\Controllers\Peserta\PesertaController::class, 'sertifikat'])->name('peserta.sertifikat');
    Route::get('/{id_diklat}/daftardiklat', [App\Http\Controllers\Peserta\PesertaController::class, 'daftardiklat'])->name('peserta.daftardiklat');
    Route::post('/daftardiklat/post', [App\Http\Controllers\Peserta\PesertaController::class, 'postdaftardiklat'])->name('peserta.postdaftardiklat');
    Route::post('/keluar', [App\Http\Controllers\Auth\LoginController::class, 'keluar'])->name('keluar');
    
    Route::get('/mulaidiklat/{id_diklat}', [App\Http\Controllers\Peserta\PesertaController::class, 'mulaidiklat'])->name('peserta.mulaidiklat');
    Route::get('/getsoal/{id_konten}', [App\Http\Controllers\Peserta\PesertaController::class, 'getSoal'])->name('peserta.getSoal');
    Route::get('/geteval/{evaltipe}/{id_konten}', [App\Http\Controllers\Peserta\PesertaController::class, 'getEval'])->name('peserta.getEval');
    Route::post('/saveJawaban', [App\Http\Controllers\Peserta\PesertaController::class, 'saveJawaban'])->name('peserta.saveJawaban');
    
    Route::post('/saveJawabanEvalPenyelenggara', [App\Http\Controllers\Peserta\PesertaController::class, 'saveJawabanEvalPenyelenggara'])->name('peserta.saveJawabanEvalPenyelenggara');
    Route::post('/saveJawabanEvalPengajar', [App\Http\Controllers\Peserta\PesertaController::class, 'saveJawabanEvalPengajar'])->name('peserta.saveJawabanEvalPengajar');

    Route::get('/getNilai/{id_konten}', [App\Http\Controllers\Peserta\PesertaController::class, 'getNilai'])->name('peserta.getNilai');
    Route::post('/start', [App\Http\Controllers\Peserta\PesertaController::class, 'start'])->name('peserta.start');
    Route::post('/next', [App\Http\Controllers\Peserta\PesertaController::class, 'next'])->name('peserta.next');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';