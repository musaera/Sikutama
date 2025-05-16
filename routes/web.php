<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KunjunganController;

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Kunjungan routes (public)
Route::get('/kunjungan/create', [KunjunganController::class, 'create'])->name('kunjungan.create');
Route::post('/kunjungan', [KunjunganController::class, 'store'])->name('kunjungan.store');
Route::get('/kunjungan/success', [KunjunganController::class, 'success'])->name('kunjungan.success');
Route::get('welcome', [HomeController::class, 'welcome'])->name('welcome');

// Authentication routes
Auth::routes(['register' => false]);

// Dashboard routes (protected)
Route::middleware(['auth'])->group(function () {
    // Redirect to dashboard after login
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Dashboard routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/kunjungan', [DashboardController::class, 'kunjungan'])->name('dashboard.kunjungan');
    Route::get('/dashboard/export', [DashboardController::class, 'export'])->name('dashboard.export');

    // Kunjungan management
    Route::get('/kunjungan', [KunjunganController::class, 'index'])->name('kunjungan.index');
    Route::get('/kunjungan/{kunjungan}', [KunjunganController::class, 'show'])->name('kunjungan.show');
    Route::get('/kunjungan/{kunjungan}/edit', [KunjunganController::class, 'edit'])->name('kunjungan.edit');
    Route::put('/kunjungan/{kunjungan}', [KunjunganController::class, 'update'])->name('kunjungan.update');
    Route::delete('/kunjungan/{kunjungan}', [KunjunganController::class, 'destroy'])->name('kunjungan.destroy');
    Route::post('/kunjungan/{kunjungan}/keluar', [KunjunganController::class, 'recordKeluar'])->name('kunjungan.keluar');
});
