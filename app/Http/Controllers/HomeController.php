<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\StokBarang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Exports\DashboardExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Barang masuk hari ini
        $barangMasuk = BarangMasuk::whereDate('tanggal_masuk', Carbon::today())
                                    ->sum('quantity');

        // Barang keluar hari ini
        $barangKeluar = BarangKeluar::whereDate('tanggal_keluar', Carbon::today())
                                    ->sum('quantity');

        // Stok di bawah batas minimum (<100)
        $stokRendah = StokBarang::where('quantity', '<', 100)
                                    ->count();

        $dates = collect();
        for ($i = 0; $i <= 6; $i++) {
            $dates->push(Carbon::now()->subDays($i)->format('Y-m-d'));
        }
        $dates = $dates->reverse();

        // Grafik barang masuk 7 hari terakhir
        $rawMasuk = BarangMasuk::selectRaw('DATE(tanggal_masuk) as tanggal, SUM(quantity) as total')
                                    ->whereBetween(DB::raw('DATE(tanggal_masuk)'), [Carbon::now()->subDays(6)->format('Y-m-d'), Carbon::now()->format('Y-m-d')])
                                    ->groupBy('tanggal')
                                    ->orderBy('tanggal', 'ASC')
                                    ->get()
                                    ->keyBy('tanggal');
             

        $masukHarian = $dates->map(function ($date) use ($rawMasuk) {
            return [
                'tanggal' => $date,
                'total' => $rawMasuk->get($date)->total ?? 0,
            ];
        });

        // Grafik barang keluar 7 hari terakhir
        $rawKeluar = BarangKeluar::selectRaw('DATE(tanggal_keluar) as tanggal, SUM(quantity) as total')
                                    ->whereBetween(DB::raw('DATE(tanggal_keluar)'), [Carbon::now()->subDays(6)->format('Y-m-d'), Carbon::now()->format('Y-m-d')])
                                    ->groupBy('tanggal')
                                    ->orderBy('tanggal', 'ASC')
                                    ->get()
                                    ->keyBy('tanggal');

        $keluarHarian = $dates->map(function ($date) use ($rawKeluar) {
            return [
                'tanggal' => $date,
                'total' => $rawKeluar->get($date)->total ?? 0,
            ];
        });

        $notifications = Notification::orderByRaw("CASE WHEN notification_status = 0 THEN 0 ELSE 1 END, updated_at DESC")->get();

        return view('layouts.home', [
            'barangMasuk' => $barangMasuk,
            'barangKeluar' => $barangKeluar,
            'stokRendah' => $stokRendah,
            'masukHarian' => $masukHarian,
            'keluarHarian' => $keluarHarian,
            'notifications' => $notifications,
        ]);
    }
}
