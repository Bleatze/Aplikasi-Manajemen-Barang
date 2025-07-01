<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function kategori()
    {
        return view('master.kategori');
    }

    public function satuan()
    {
        return view('master.satuan');
    }

    public function barang()
    {
        return view('master.barang');
    }

    public function barangMasuk()
    {
        return view('transaksi.barang-masuk');
    }

    public function barangKeluar()
    {
        return view('transaksi.barang-keluar');
    }

    public function laporan()
    {
        return view('laporan');
    }

    public function users()
    {
        return view('users');
    }
}
