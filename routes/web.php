<?php

use Illuminate\Support\Facades\Route;

// === Halaman Otentikasi ===
Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');

// === Halaman Utama & Manajemen (tanpa middleware auth)
Route::view('/', 'dashboard')->name('dashboard');

// Master Data
Route::view('/kategori', 'master.kategori')->name('kategori.index');
Route::view('/satuan', 'master.satuan')->name('satuan.index');
Route::view('/barang', 'master.barang')->name('barang.index');

// Transaksi
Route::view('/barang-masuk', 'transaksi.barang-masuk')->name('barang-masuk.index');
Route::view('/barang-keluar', 'transaksi.barang-keluar')->name('barang-keluar.index');

// Laporan
Route::view('/laporan', 'laporan')->name('laporan.index');

// Manajemen User
Route::view('/users', 'users')->name('users.index');

// Logout (simulasi saja)
Route::post('/logout', function () {
    // Simulasi logout: redirect ke login
    return redirect('/login');
})->name('logout');
