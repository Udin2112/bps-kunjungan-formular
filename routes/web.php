<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TotalController;

/*
|--------------------------------------------------------------------------
| Public Routes (Tanpa Login)
|--------------------------------------------------------------------------
*/
// ðŸ”¹ Form publik (isi buku tamu)
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return (new FeedbackController)->create();
})->name('feedback.create');

Route::post('/', [FeedbackController::class, 'store'])->name('feedback.store');

/*
|--------------------------------------------------------------------------
| Admin Routes (Harus Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // ðŸ”¹ Dashboard & Grafik
    Route::get('/dashboard', [FeedbackController::class, 'dashboard'])->name('dashboard');
    Route::get('/total', [TotalController::class, 'index'])->name('total.index');
    Route::get('/grafik', [DashboardController::class, 'grafik'])->name('grafik.index');
    Route::get('/grafik/instansi-per-tahun', [DashboardController::class, 'getInstansiByYear']);

    // ðŸ”¹ Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    // 🔹 Export Laporan ke Excel
Route::get('/laporan/export', [LaporanController::class, 'export'])->name('laporan.export');


    // ðŸ”¹ Feedback Management (edit/update/delete)
    Route::get('/feedback/{feedback}/edit', [FeedbackController::class, 'edit'])->name('feedback.edit');
    Route::put('/feedback/{feedback}', [FeedbackController::class, 'update'])->name('feedback.update');
    Route::delete('/feedback/{feedback}', [FeedbackController::class, 'destroy'])->name('feedback.destroy');

    // ðŸ”¹ Register Admin
    Route::get('/admin/register', [AdminController::class, 'create'])->name('admin.register');
    Route::post('/admin/register', [AdminController::class, 'store'])->name('admin.register.store');

    // ðŸ”¹ Daftar Admin
    Route::get('/admin/list', [AdminController::class, 'index'])->name('admin.index');
    Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

    // ðŸ”¹ Profil User
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Auth Routes (Login & Logout Saja)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';