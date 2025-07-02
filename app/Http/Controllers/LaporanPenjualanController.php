<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanPenjualanController extends Controller
{
    public function index()
    {
        $data = Pembelian::orderBy('created_at', 'desc')->get();
        return view('laporan.index', compact('data'));
    }


public function exportPdf()
{
    $data = \App\Models\Pembelian::orderBy('created_at', 'desc')->get();

    $pdf = Pdf::loadView('owner.laporan.pdf', compact('data'));
    return $pdf->download('laporan-penjualan.pdf');
}


    public function cetakPDF()
    {
        $data = Pembelian::orderBy('created_at', 'desc')->get();
        $pdf = PDF::loadView('laporan.pdf', compact('data'));

        return $pdf->download('laporan-penjualan.pdf');
    }
}
