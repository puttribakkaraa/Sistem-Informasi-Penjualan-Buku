<?php

namespace App\Exports;

use App\Models\Pembelian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanPenjualanExport implements FromCollection, WithHeadings
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        return Pembelian::whereBetween('created_at', [$this->startDate, $this->endDate])
            ->select('id', 'BUKU_JUDUL', 'JUMLAH_ITEM', 'total_harga', 'created_at')
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Judul Buku',
            'Jumlah Item',
            'Total Harga',
            'Tanggal Pembelian',
        ];
    }
}

