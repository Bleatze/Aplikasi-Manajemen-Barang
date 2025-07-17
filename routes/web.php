<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WareController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Halaman login
Route::get('/login', [AuthController::class, 'showLogin'])->name('show_login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Root: jika sudah login redirect ke dashboard, kalau belum ke login
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('show_login');
});

// Protected routes (hanya bisa diakses kalau sudah login)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/kategori', [DashboardController::class, 'kategori'])->name('kategori.index');
    Route::post('/kategori/add', [CategoryController::class, 'add'])->name('kategori.add');
    Route::put('/kategori/{id}', [CategoryController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{id}', [CategoryController::class, 'destroy'])->name('kategori.destroy');

    Route::get('/satuan', [DashboardController::class, 'satuan'])->name('satuan.index');
    Route::post('/satuan/add', [UnitController::class, 'add'])->name('satuan.add');
    Route::put('/satuan/{id}', [UnitController::class, 'update'])->name('satuan.update');
    Route::delete('/satuan/{id}', [UnitController::class, 'destroy'])->name('satuan.destroy');

    Route::get('/barang', [DashboardController::class, 'barang'])->name('barang.index');
    Route::post('/barang/add', [WareController::class, 'add'])->name('barang.add');
    Route::put('/barang/{id}', [WareController::class, 'update'])->name('barang.update');
    Route::delete('/barang/{id}', [WareController::class, 'destroy'])->name('barang.destroy');
    
    Route::get('/barang-masuk', [DashboardController::class, 'barangMasuk'])->name('barang-masuk.index');
    Route::get('/barang-keluar', [DashboardController::class, 'barangKeluar'])->name('barang-keluar.index');
    Route::get('/laporan', [DashboardController::class, 'laporan'])->name('laporan.index');
    Route::get('/users', [DashboardController::class, 'users'])->name('users.index');
    Route::post('/user/add', [UserController::class, 'add'])->name('users.add');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});
