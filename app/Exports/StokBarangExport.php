<?php

namespace App\Exports;

use App\Models\StokBarang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StokBarangExport implements FromCollection, WithHeadings
{
    protected $stokBarang;
    protected $startDate;
    protected $finishDate;

    public function __construct($stokBarang, $startDate, $finishDate)
    {
        $this->stokBarang = $stokBarang;
        $this->startDate = $startDate;
        $this->finishDate = $finishDate;
    }
    public function collection()
    {
        return $this->stokBarang->map(function($stokBarang, $key) {
            return [
                'No' => $key + 1,
                'Kode Barang' => $stokBarang->kode_barang,
                'Quantity' => $stokBarang->quantity,
                'Created At' => $stokBarang->created_at->format('d-m-Y H:i:s'),
                'Updated At' => $stokBarang->updated_at->format('d-m-Y H:i:s'),
            ];
        });
    }

    public function headings(): array
    {
        return ["No", "Kode Barang", "Quantity", "created_at", "updated_at"];
    }
}
