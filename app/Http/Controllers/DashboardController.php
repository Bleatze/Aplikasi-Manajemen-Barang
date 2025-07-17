<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Unit;
use App\Models\User;
use App\Models\Ware;
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

    public function kategori(Request $request)
    {
        $query = Category::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('category_name', 'like', "%{$search}%");
        }

        $kategoris = $query->get();

        return view('master.kategori', compact('kategoris'));
    }

    public function satuan(Request $request)
    {
        $query = Unit::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('unit_name', 'like', "%{$search}%");
        }

        $units = $query->get();

        return view('master.satuan', compact('units'));
    }

    public function barang(Request $request)
    {
        $query = Ware::with(['category','unit']);
        if($request->category_id){
            $query->where('category_id',$request->category_id);
        }
        if($request->search){
            $query->where('ware_name','like','%' . $request->search . '%');
        }
        $wares = $query->get();
        $units = Unit::all();
        $categories = Category::all();
        return view('master.barang',compact('wares','categories','units'));
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

    public function users(Request $request)
    {
        $query = User::query();

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->get();

        return view('users', compact('users'));

    }
}
