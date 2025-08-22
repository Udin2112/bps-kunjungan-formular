<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Public Routes (Tanpa Login)
|--------------------------------------------------------------------------
*/
// 🔹 Form publik (isi buku tamu)
Route::get('/', [FeedbackController::class, 'create'])->name('feedback.create');
Route::post('/', [FeedbackController::class, 'store'])->name('feedback.store');

/*
|--------------------------------------------------------------------------
| Admin Routes (Harus Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // 🔹 Dashboard & Grafik
    Route::get('/dashboard', [FeedbackController::class, 'dashboard'])->name('dashboard');
    Route::get('/grafik', [DashboardController::class, 'grafik'])->name('grafik.index');

    // 🔹 Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');

    // 🔹 Feedback Management (edit/update/delete)
    Route::get('/feedback/{feedback}/edit', [FeedbackController::class, 'edit'])->name('feedback.edit');
    Route::put('/feedback/{feedback}', [FeedbackController::class, 'update'])->name('feedback.update');
    Route::delete('/feedback/{feedback}', [FeedbackController::class, 'destroy'])->name('feedback.destroy');

    // 🔹 Register Admin (khusus user yang sudah login)
    Route::get('/admin/register', [AdminController::class, 'create'])->name('admin.register');
    Route::post('/admin/register', [AdminController::class, 'store'])->name('admin.register.store');

    // 🔹 Daftar Admin
    Route::get('/admin/list', [AdminController::class, 'index'])->name('admin.index');

    // 🔹 Profil User
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Auth Routes (Login & Logout Saja)
|--------------------------------------------------------------------------
|
| Karena register publik kita nonaktifkan, hanya login & logout dari 
| Breeze/Fortify/Jetstream yang dipakai.
|
*/
require __DIR__.'/auth.php';
