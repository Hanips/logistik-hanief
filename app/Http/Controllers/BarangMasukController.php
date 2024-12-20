<?php

namespace App\Http\Controllers;

use App\Exports\BarangMasukExport;
use App\Imports\BarangMasukImport;
use App\Models\BarangMasuk;
use App\Models\Notification;
use App\Models\StokBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangMasuk = BarangMasuk::orderBy('tanggal_masuk', 'desc')->get();
        $notifications = Notification::orderByRaw("CASE WHEN notification_status = 0 THEN 0 ELSE 1 END, updated_at DESC")->limit(10)->get();
        return view('barang_masuk.index', compact('barangMasuk', 'notifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $notifications = Notification::orderByRaw("CASE WHEN notification_status = 0 THEN 0 ELSE 1 END, updated_at DESC")->limit(10)->get();
        return view('barang_masuk.create', compact('notifications'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|string|max:50',
            'quantity' => 'required|integer|min:1',
            'origin' => 'required|string|max:100',
            'tanggal_masuk' => 'required|date',
        ]);
        try{
            $barangMasuk = BarangMasuk::create(
            [
                'kode_barang'=>$request->kode_barang,
                'quantity'=>$request->quantity,
                'origin'=>$request->origin,
                'tanggal_masuk'=>$request->tanggal_masuk,
            ]);

            $stok = StokBarang::firstOrCreate(
                ['kode_barang' => $request['kode_barang']],
                ['quantity' => 0]
            );

            $stok->quantity += $request['quantity'];
            $stok->save();

            Notification::create([
                'notification_content' => Auth::user()->name . " " . "membuat data barang masuk dengan kode" . " " . $request->input('kode_barang'),
                'notification_status' => 0
            ]);

            Log::info('Data successfully created', ['barangMasuk' => $barangMasuk]);

            return response()->json([
                'message' => 'Data barang masuk berhasil ditambahkan!',
                'data' => $barangMasuk,
            ], 201);
        } catch (\Exception $e) {
            Log::error('Failed to save data', ['exception' => $e->getMessage()]);
            return response()->json(['error' => 'Gagal menyimpan data: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);
        $notifications = Notification::orderByRaw("CASE WHEN notification_status = 0 THEN 0 ELSE 1 END, updated_at DESC")->limit(10)->get();
        return view('barang_masuk.show', compact('barangMasuk', 'notifications'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $barangMasuk = BarangMasuk::findOrFail($id);

            $stok = StokBarang::where('kode_barang', $barangMasuk->kode_barang)->first();
            if ($stok) {
                $stok->quantity -= $barangMasuk->quantity;
                $stok->save();
            }

            $barangMasuk->delete();

            Notification::create([
                'notification_content' => Auth::user()->name . " menghapus data barang masuk dengan kode " . $barangMasuk->kode_barang,
                'notification_status' => 0
            ]);

            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus data.'], 500);
        }
    }

    public function barangMasukExcel(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('finish_date');

        $query = BarangMasuk::query();

        if ($startDate && $endDate) {
            $query->whereDate('tanggal_masuk', '>=', $startDate)
                ->whereDate('tanggal_masuk', '<=', $endDate);
        }

        $barangMasuk = $query->orderBy('tanggal_masuk', 'desc')->get();

        Notification::create([
            'notification_content' => Auth::user()->name . " export data barang masuk periode " . $startDate . " - " . $endDate,
            'notification_status' => 0
        ]);

        return Excel::download(new BarangMasukExport($barangMasuk, $startDate, $endDate), 'barang_masuk_' . date('d-m-Y') . '.xlsx');
    }

    public function barangMasukImport(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|mimes:xlsx,xls',
        ]);
    
        try {
            Excel::import(new BarangMasukImport, $request->file('file_excel'));
            
            return response()->json(['success' => true, 'message' => 'Data berhasil di import.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal meng-import data.'], 500);
        }
    }
}
