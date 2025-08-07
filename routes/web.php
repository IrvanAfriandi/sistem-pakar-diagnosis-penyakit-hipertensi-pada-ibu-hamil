<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

# Halaman Landing Page
Route::view('/', 'index');
# Halaman Tentang
Route::view('/tentang', 'tentang');
# Halaman Blog
Route::view('/blog', 'blog');
# Halaman Pasien
Route::resource('pasien', PasienController::class);
# Halaman Diagnosis
Route::resource('diagnosis', DiagnosisController::class);
Route::post('/diagnosis/save-result', [DiagnosisController::class, 'saveDiagnosisResult'])
    ->name('diagnosis.save-result');


# Halaman Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    # Halaman Admin
    Route::get('/admin_dashboard', [AdminController::class, 'admin_dashboard'])->name('admin_dashboard');
    # Halaman Admin
    Route::resource('admin', AdminController::class);
    # Halaman Data Pasien
    Route::resource('data-pasien', DataPasienController::class);
    # Halaman Data Penyakit
    Route::resource('penyakit', PenyakitController::class);
    # Halaman Data Gejala
    Route::resource('gejala', GejalaController::class);
    # Halaman Basis Pengetahuan
    Route::resource('basis-pengetahuan', PengetahuanController::class);
    # Halaman Riwayat Konsultasi
    Route::resource('riwayat-konsultasi', RiwayatKonsultasiController::class);
    Route::get('riwayat-konsultasi/{id}/gejala', [RiwayatKonsultasiController::class, 'getGejalaByKonsultasi'])
    ->name('admin.riwayat-konsultasi.gejala');
});






