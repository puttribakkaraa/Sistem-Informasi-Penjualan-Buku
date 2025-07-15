<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\LaporanPenjualanExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Buku;


class OwnerController extends Controller
{
    public function index()
    {
        return view('dashboardowner');
    }
    public function laporanIndex()
{
    return view('owner.laporan.index'); // pastikan file ini ada di resources/views/owner/laporan/index.blade.php
}
public function logout(Request $request)
{
    Auth::logout(); // atau Auth::guard('owner')->logout(); jika pakai guard khusus
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
}

public function stokBuku(Request $request)
{
    $perPage = $request->get('perPage', 10); // Default 20, bisa pilih 10/50
    $bukus = Buku::paginate($perPage);

    return view('owner.stok_buku', compact('bukus', 'perPage'));
}

public function exportExcel(Request $request)
{
    $startDate = $request->start_date ?? now()->startOfMonth()->toDateString();
    $endDate = $request->end_date ?? now()->toDateString();

    $fileName = 'laporan_penjualan_' . date('Ymd_His') . '.xlsx';

    return Excel::download(new LaporanPenjualanExport($startDate, $endDate), $fileName);
}

    public function bukuTerlaris()
    {
        $bukuTerlaris = Pembelian::select('BUKU_JUDUL', DB::raw('SUM(JUMLAH_ITEM) as total_terjual'))
            ->groupBy('BUKU_JUDUL')
            ->orderByDesc('total_terjual')
            ->take(10)
            ->get();

        return view('owner.buku_terlaris', compact('bukuTerlaris'));
    }

public function detailPenjualan(Request $request)
{
    $startDate = $request->start_date ?? now()->startOfMonth()->toDateString();
    $endDate = $request->end_date ?? now()->toDateString();

    $data = Pembelian::whereBetween('created_at', [$startDate, $endDate]);

    $totalTransaksi = $data->count();
    $totalPendapatan = $data->sum('total_harga');

    return view('owner.detail_penjualan', compact(
        'totalTransaksi', 'totalPendapatan'
    ));
}


}

