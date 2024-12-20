<?php

namespace App\Exports;

use App\Models\BarangMasuk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BarangMasukExport implements FromCollection, WithHeadings
{
    protected $barangMasuk;
    protected $startDate;
    protected $finishDate;

    public function __construct($barangMasuk, $startDate, $finishDate)
    {
        $this->barangMasuk = $barangMasuk;
        $this->startDate = $startDate;
        $this->finishDate = $finishDate;
    }
    public function collection()
    {
        return $this->barangMasuk->map(function($barangMasuk, $key) {
            return [
                'No' => $key + 1,
                'Kode Barang' => $barangMasuk->kode_barang,
                'Quantity' => $barangMasuk->quantity,
                'Origin' => $barangMasuk->origin,
                'Tanggal Masuk' => $barangMasuk->tanggal_masuk,
                'Created At' => $barangMasuk->created_at->format('d-m-Y H:i:s'),
                'Updated At' => $barangMasuk->updated_at->format('d-m-Y H:i:s'),
            ];
        });
    }

    public function headings(): array
    {
        return ["No", "Kode Barang", "Quantity", "Origin", "Tanggal Masuk", "created_at", "updated_at"];
    }
}
