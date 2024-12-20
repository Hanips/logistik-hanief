<?php

namespace App\Http\Controllers;

use App\Exports\StokBarangExport;
use App\Models\Notification;
use App\Models\StokBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class StokBarangController extends Controller
{
    public function index()
    {
        $stokBarang = StokBarang::orderBy('updated_at', 'desc')->get();
        $notifications = Notification::orderByRaw("CASE WHEN notification_status = 0 THEN 0 ELSE 1 END, updated_at DESC")->limit(10)->get();
        return view('stok_barang.index', compact('stokBarang', 'notifications'));
    }

    public function show(string $id)
    {
        $stokBarang = StokBarang::findOrFail($id);
        $notifications = Notification::orderByRaw("CASE WHEN notification_status = 0 THEN 0 ELSE 1 END, updated_at DESC")->limit(10)->get();
        
        $barangMasuk = $stokBarang->barangMasuk()
        ->orderBy('tanggal_masuk', 'desc')
        ->limit(5)
        ->get();

        $barangKeluar = $stokBarang->barangKeluar()
            ->orderBy('tanggal_keluar', 'desc')
            ->limit(5)
            ->get();

        $transaksiTerakhir = $barangMasuk
            ->map(function ($item) {
                $item->jenis = 'Masuk';
                $item->tanggal = $item->tanggal_masuk;
                return $item;
            })
            ->concat(
                $barangKeluar->map(function ($item) {
                    $item->jenis = 'Keluar';
                    $item->tanggal = $item->tanggal_keluar;
                    return $item;
                })
            )
            ->sortByDesc('tanggal')
            ->take(5);

        return view('stok_barang.detail', compact('stokBarang', 'notifications', 'transaksiTerakhir'));
    }

    public function stokBarangExcel(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('finish_date');

        $query = StokBarang::query();

        if ($startDate && $endDate) {
            $query->whereDate('created_at', '>=', $startDate)
                ->whereDate('created_at', '<=', $endDate);
        }

        $stokBarang = $query->orderBy('created_at', 'desc')->get();

        Notification::create([
            'notification_content' => Auth::user()->name . " export data stok barang periode " . $startDate . " - " . $endDate,
            'notification_status' => 0
        ]);

        return Excel::download(new StokBarangExport($stokBarang, $startDate, $endDate), 'stok_barang_' . date('d-m-Y') . '.xlsx');
    }
}
