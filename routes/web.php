<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Auth;

// Halaman Depan (Publik)
Route::get('/', [PublicController::class, 'index'])->name('welcome');
Route::get('/berita', [PublicController::class, 'semuaBerita'])->name('berita.index');
Route::get('/berita/{slug}', [PublicController::class, 'showBerita'])->name('berita.show');
Route::get('/kabar-pesantren/{id}', [\App\Http\Controllers\PublicController::class, 'showBerita'])->name('berita.show');
Route::get('/program/{id}', [\App\Http\Controllers\PublicController::class, 'showProgram'])->name('program.show');
// Halaman Profil (Statis)
Route::get('/profil/sejarah', [PublicController::class, 'sejarah'])->name('profil.sejarah');
Route::view('/profil/visi-misi', 'pages.visimisi')->name('profil.visimisi');
// Auth Routes (Login, Register, Logout) - Bawaan Laravel UI
Auth::routes();

Route::get('/donasi', [\App\Http\Controllers\PublicController::class, 'donasi'])->name('donasi');

// Halaman Setelah Login (Dashboard)
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Group untuk User yang Login
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    // Route Pendaftaran
    Route::get('/pendaftaran', [RegistrationController::class, 'create'])->name('pendaftaran.create');
    Route::post('/pendaftaran', [RegistrationController::class, 'store'])->name('pendaftaran.store');
    // Route Profil (Bisa diakses Admin & Santri)
Route::middleware(['auth'])->group(function () {
    Route::get('/profil/akun', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profil/akun', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profil/password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.password');
});
    });
// ROUTE KHUSUS ADMIN
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    
    // Dashboard Admin
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    // Route Manajemen Berita
    Route::resource('posts', PostController::class);
    // Di dalam group middleware admin
    Route::resource('sliders', App\Http\Controllers\SliderController::class);
    // Manajemen Pendaftar
    Route::get('/pendaftar', [AdminController::class, 'pendaftar'])->name('admin.pendaftar');
    Route::get('/pendaftar/{id}', [AdminController::class, 'show'])->name('admin.show');
    Route::post('/pendaftar/{id}', [AdminController::class, 'verifikasi'])->name('admin.verifikasi');
    Route::resource('posts', PostController::class);
    // Kelola Konten Depan
    Route::get('/konten-depan', [SectionController::class, 'index'])->name('sections.index');
    Route::put('/konten-depan/{id}', [SectionController::class, 'update'])->name('sections.update');
    
    // Route Baru untuk Program & Jadwal
    Route::resource('programs', ProgramController::class);
    Route::resource('schedules', ScheduleController::class);
    
    // Pastikan Teacher juga sudah ada
    
});