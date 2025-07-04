<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $labels = [
            '2025' => ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September'],
            '2024' => ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli'],
            '2023' => ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober','November','Desember']
        ];

        $barangMasuk = [
            '2025' => [10, 20, 15, 25, 30, 40, 35, 50, 60],
            '2024' => [8, 18, 12, 22, 28, 38, 45],
            '2023' => [5, 15, 20, 25, 30, 30, 20, 30, 60, 50, 55, 60]
        ];

        $barangKeluar = [
            '2025' => [5, 15, 10, 20, 25, 35, 30, 45, 55],
            '2024' => [4, 14, 9, 19, 24, 34, 40],
            '2023' => [3, 10, 15, 20, 25, 25, 30, 35, 19, 40, 20, 24]
        ];

        return view('dashboard', compact('labels', 'barangMasuk', 'barangKeluar'));
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
