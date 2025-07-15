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
public function detailPenjualan(Request $request)
{
    $start = $request->input('start_date');
    $end = $request->input('end_date');

    $query = Pembelian::query();

    if ($start && $end) {
        $query->whereBetween('created_at', [$start, $end]);
    }

    $data = $query->orderBy('created_at', 'desc')->get();

    $totalTransaksi = $data->count();
    $totalPendapatan = $data->sum('total_harga'); // ganti 'total_harga' dengan nama kolom yang sesuai jika berbeda

    return view('owner.detail_penjualan', compact('totalTransaksi', 'totalPendapatan'));
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
