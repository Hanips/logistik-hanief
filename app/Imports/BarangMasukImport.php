<?php

namespace App\Imports;

use App\Models\BarangMasuk;
use App\Models\StokBarang;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BarangMasukImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $barangMasuk = BarangMasuk::create([
            'kode_barang' => $row['kode_barang'],
            'quantity' => $row['quantity'],
            'origin' => $row['origin'],
            'tanggal_masuk' => $row['tanggal_masuk'],
        ]);

        $stok = StokBarang::firstOrCreate(
            ['kode_barang' => $row['kode_barang']],
            ['quantity' => 0]
        );

        $stok->quantity += $row['quantity'];
        $stok->save();

        return $barangMasuk;
    }
}
