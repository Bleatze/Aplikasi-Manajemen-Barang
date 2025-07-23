<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Unit;
use App\Models\User;
use App\Models\Ware;
use App\Models\WareIn;
use App\Models\WareOut;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = Ware::count();

        $now = Carbon::now();
        $bulanIni = $now->month;
        $tahunIni = $now->year;

        $barangMasukBulanIni = WareIn::whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahunIni)
            ->sum('amount');

        $barangKeluarBulanIni = WareOut::whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahunIni)
            ->sum('amount');

        // === PIE CHART DATA ===
        $pieMasuk = WareIn::selectRaw('wares.ware_name, SUM(ware_ins.amount) as total')
            ->join('wares', 'ware_ins.ware_id', '=', 'wares.id')
            ->whereMonth('ware_ins.created_at', $bulanIni)
            ->whereYear('ware_ins.created_at', $tahunIni)
            ->groupBy('ware_name')
            ->get();

        $pieKeluar = WareOut::selectRaw('wares.ware_name, SUM(ware_outs.amount) as total')
            ->join('wares', 'ware_outs.ware_id', '=', 'wares.id')
            ->whereMonth('ware_outs.created_at', $bulanIni)
            ->whereYear('ware_outs.created_at', $tahunIni)
            ->groupBy('ware_name')
            ->get();

        $pieMasukData = [
            'labels' => $pieMasuk->pluck('ware_name'),
            'data' => $pieMasuk->pluck('total'),
        ];

        $pieKeluarData = [
            'labels' => $pieKeluar->pluck('ware_name'),
            'data' => $pieKeluar->pluck('total'),
        ];

        // === LINE CHART DATA PER TAHUN ===
        $availableYears = WareIn::selectRaw('YEAR(created_at) as year')
            ->union(WareOut::selectRaw('YEAR(created_at) as year'))
            ->orderBy('year')
            ->pluck('year')
            ->unique()
            ->values();

        $datasetByYear = [];

        foreach ($availableYears as $year) {
            $labels = [];
            $masuk = [];
            $keluar = [];

            for ($i = 1; $i <= 12; $i++) {
                $labels[] = Carbon::create()->month($i)->format('M');

                $masuk[] = WareIn::whereYear('created_at', $year)
                    ->whereMonth('created_at', $i)
                    ->sum('amount');

                $keluar[] = WareOut::whereYear('created_at', $year)
                    ->whereMonth('created_at', $i)
                    ->sum('amount');
            }

            $datasetByYear[$year] = [
                'labels' => $labels,
                'masuk' => $masuk,
                'keluar' => $keluar,
            ];
        }

        return view('dashboard', compact(
            'totalBarang',
            'barangMasukBulanIni',
            'barangKeluarBulanIni',
            'availableYears',
            'datasetByYear',
            'pieMasukData',
            'pieKeluarData'
        ));
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
        $query = Ware::with(['category', 'unit']);
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->search) {
            $query->where('ware_name', 'like', '%' . $request->search . '%');
        }
        $wares = $query->get();
        $units = Unit::all();
        $categories = Category::all();
        return view('master.barang', compact('wares', 'categories', 'units'));
    }

    public function barangMasuk(Request $request)
    {
        $query = WareIn::with(['ware']);
        if ($request->search) {
            $query->whereHas('ware', function ($q) use ($request) {
                $q->where('ware_name', 'like', '%' . $request->search . '%');
            });
        }
        $wareIns = $query->get();
        $wares = Ware::all();
        return view('transaksi.barang-masuk', compact('wareIns', 'wares'));
    }

    public function barangKeluar(Request $request)
    {
        $query = WareOut::with(['ware']);
        if ($request->search) {
            $query->whereHas('ware', function ($q) use ($request) {
                $q->where('ware_name', 'like', '%' . $request->search . '%');
            });
        }
        $wareOuts = $query->get();
        $wares = Ware::all();
        return view('transaksi.barang-keluar', compact('wareOuts', 'wares'));
    }

    public function laporan(Request $request)
    {

        $start = $request->start_date;
        $end = $request->end_date;

        $barangMasuk = WareIn::with('ware')
            ->when($start && $end, function ($query) use ($start, $end) {
                $query->whereBetween('created_at', [$start . ' 00:00:00', $end . ' 23:59:59']);
            })
            ->get()
            ->map(function ($item) {
                return [
                    'tanggal' => $item->created_at,
                    'jenis' => 'Masuk',
                    'barang' => $item->ware->ware_name,
                    'jumlah' => $item->amount,
                ];
            });

        $barangKeluar = WareOut::with('ware')
            ->when($start && $end, function ($query) use ($start, $end) {
                $query->whereBetween('created_at', [$start . ' 00:00:00', $end . ' 23:59:59']);
            })
            ->get()
            ->map(function ($item) {
                return [
                    'tanggal' => $item->created_at,
                    'jenis' => 'Keluar',
                    'barang' => $item->ware->ware_name,
                    'jumlah' => $item->amount,
                ];
            });

        $laporan = $barangMasuk->merge($barangKeluar)->sortByDesc('tanggal');

        return view('laporan', compact('laporan'));
    }

    public function users(Request $request)
    {
        $query = User::query();

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->get();

        return view('users', compact('users'));
    }
}
