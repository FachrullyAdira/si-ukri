<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\TentangKamiController;
use App\Http\Controllers\AkademikController;
use App\Http\Controllers\KemahasiswaanController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\KontakController;

/*
|--------------------------------------------------------------------------
| Web Routes - Sistem Informasi UKRI (SI-UKRI)
|--------------------------------------------------------------------------
*/

// GET / -> beranda
Route::get('/', BerandaController::class)->name('beranda');

// GET /tentang-kami/{sejarah|visi-misi|akreditasi|dosen-staf|kerja-sama}
Route::prefix('tentang-kami')->group(function () {
    Route::get('sejarah', [TentangKamiController::class, 'sejarah'])->name('tentang.sejarah');
    Route::get('visi-misi', [TentangKamiController::class, 'visiMisi'])->name('tentang.visi-misi');
    Route::get('akreditasi', [TentangKamiController::class, 'akreditasi'])->name('tentang.akreditasi');
    Route::get('dosen-staf', [TentangKamiController::class, 'dosenStaf'])->name('tentang.dosen-staf');
    Route::get('kerja-sama', [TentangKamiController::class, 'kerjaSama'])->name('tentang.kerja-sama');
});

// GET /akademik/{struktur-kurikulum|kelompok-keahlian|mata-kuliah|kalender}
Route::prefix('akademik')->group(function () {
    Route::get('struktur-kurikulum', [AkademikController::class, 'strukturKurikulum'])->name('akademik.kurikulum');
    Route::get('kelompok-keahlian', [AkademikController::class, 'kelompokKeahlian'])->name('akademik.kbk');
    Route::get('mata-kuliah', [AkademikController::class, 'mataKuliah'])->name('akademik.matakuliah');
    Route::get('kalender', [AkademikController::class, 'kalender'])->name('akademik.kalender');
});

// GET /kemahasiswaan/{prestasi|hima|alumni}
Route::prefix('kemahasiswaan')->group(function () {
    Route::get('prestasi', [KemahasiswaanController::class, 'prestasi'])->name('kemahasiswaan.prestasi');
    Route::get('hima', [KemahasiswaanController::class, 'hima'])->name('kemahasiswaan.hima');
    Route::get('alumni', [KemahasiswaanController::class, 'alumni'])->name('kemahasiswaan.alumni');
});

// GET /berita dan GET /berita/{slug}
Route::prefix('berita')->group(function () {
    Route::get('/', [BeritaController::class, 'index'])->name('berita.index');
    Route::get('{slug}', [BeritaController::class, 'show'])->name('berita.show');
});

// GET /kontak & POST /kontak (dengan throttle 5 request / menit)
Route::get('kontak', [KontakController::class, 'index'])->name('kontak');
Route::post('kontak', [KontakController::class, 'store'])->middleware('throttle:5,1')->name('kontak.store');

// Redirect Pendaftaran PMB ke portal resmi https://pmb.ukri.ac.id/
Route::get('pendaftaran', function () {
    return redirect()->away('https://pmb.ukri.ac.id/');
})->name('pendaftaran');
