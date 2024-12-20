<?php

namespace App\Exports;

use App\Models\BarangKeluar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BarangKeluarExport implements FromCollection, WithHeadings
{
    protected $barangKeluar;
    protected $startDate;
    protected $finishDate;

    public function __construct($barangKeluar, $startDate, $finishDate)
    {
        $this->barangKeluar = $barangKeluar;
        $this->startDate = $startDate;
        $this->finishDate = $finishDate;
    }
    public function collection()
    {
        return $this->barangKeluar->map(function($barangKeluar, $key) {
            return [
                'No' => $key + 1,
                'Kode Barang' => $barangKeluar->kode_barang,
                'Quantity' => $barangKeluar->quantity,
                'Destination' => $barangKeluar->destination,
                'Tanggal Keluar' => $barangKeluar->tanggal_keluar,
                'Created At' => $barangKeluar->created_at->format('d-m-Y H:i:s'),
                'Updated At' => $barangKeluar->updated_at->format('d-m-Y H:i:s'),
            ];
        });
    }

    public function headings(): array
    {
        return ["No", "Kode Barang", "Quantity", "Destination", "Tanggal Keluar", "created_at", "updated_at"];
    }
}
