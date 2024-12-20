<?php

namespace App\Http\Controllers;

use App\Exports\BarangKeluarExport;
use App\Models\BarangKeluar;
use App\Models\Notification;
use App\Models\StokBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangKeluar = BarangKeluar::orderBy('tanggal_keluar', 'desc')->get();
        $notifications = Notification::orderByRaw("CASE WHEN notification_status = 0 THEN 0 ELSE 1 END, updated_at DESC")->limit(10)->get();
        return view('barang_keluar.index', compact('barangKeluar', 'notifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $notifications = Notification::orderByRaw("CASE WHEN notification_status = 0 THEN 0 ELSE 1 END, updated_at DESC")->limit(10)->get();
        return view('barang_keluar.create', compact('notifications'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|string|max:50',
            'quantity' => 'required|integer|min:1',
            'destination' => 'required|string|max:100',
            'tanggal_keluar' => 'required|date',
        ]);

        try{
            // Cek stok barang
            $stok = StokBarang::where('kode_barang', $request['kode_barang'])->first();
            if (!$stok || $stok->quantity < $request['quantity']) {
                return redirect()->back()->with('error', 'Stok tidak mencukupi untuk barang keluar.');
            }

            $barangKeluar = BarangKeluar::create(
            [
                'kode_barang'=>$request->kode_barang,
                'quantity'=>$request->quantity,
                'destination'=>$request->destination,
                'tanggal_keluar'=>$request->tanggal_keluar,
            ]);

            $stok->quantity -= $request['quantity'];
            $stok->save();

            Notification::create([
                'notification_content' => Auth::user()->name . " " . "membuat data barang keluar dengan kode" . " " . $request->input('kode_barang'),
                'notification_status' => 0
            ]);

            Log::info('Data successfully created', ['barangKeluar' => $barangKeluar]);

            return response()->json([
                'message' => 'Data barang keluar berhasil ditambahkan!',
                'data' => $barangKeluar,
            ], 201);
        } catch (\Exception $e) {
            Log::error('Failed to save data', ['exception' => $e->getMessage()]);
            return response()->json(['error' => 'Gagal menyimpan data: ' . $e->getMessage()], 500);
        }
        // return redirect()->route('barang-keluar.index')->with('success', 'Barang keluar berhasil dicatat dan stok diperbarui.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $barangKeluar = BarangKeluar::findOrFail($id);
        $notifications = Notification::orderByRaw("CASE WHEN notification_status = 0 THEN 0 ELSE 1 END, updated_at DESC")->limit(10)->get();
        return view('barang_keluar.show', compact('barangKeluar', 'notifications'));
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
            $barangKeluar = BarangKeluar::findOrFail($id);

            $stok = StokBarang::where('kode_barang', $barangKeluar->kode_barang)->first();
            if ($stok) {
                $stok->quantity += $barangKeluar->quantity;
                $stok->save();
            }

            $barangKeluar->delete();

            Notification::create([
                'notification_content' => Auth::user()->name . " menghapus data barang keluar dengan kode " . $barangKeluar->kode_barang,
                'notification_status' => 0
            ]);

            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus data.'], 500);
        }
    }

    public function barangKeluarExcel(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('finish_date');

        $query = BarangKeluar::query();

        if ($startDate && $endDate) {
            $query->whereDate('tanggal_keluar', '>=', $startDate)
                ->whereDate('tanggal_keluar', '<=', $endDate);
        }

        $barangKeluar = $query->orderBy('tanggal_keluar', 'desc')->get();

        Notification::create([
            'notification_content' => Auth::user()->name . " export data barang keluar periode " . $startDate . " - " . $endDate,
            'notification_status' => 0
        ]);

        return Excel::download(new BarangKeluarExport($barangKeluar, $startDate, $endDate), 'barang_keluar_' . date('d-m-Y') . '.xlsx');
    }
}
