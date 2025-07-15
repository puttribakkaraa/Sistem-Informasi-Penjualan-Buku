<?php

// app/Http/Controllers/HistoryController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(Request $request)
{
    $query = \App\Models\Pembelian::query();

    // Filter pencarian
    if ($request->has('q') && $request->q !== null) {
        $search = $request->q;
        $query->where('NAMA_PEMBELI', 'like', '%' . $search . '%')
              ->orWhere('BUKU_JUDUL', 'like', '%' . $search . '%');
    }

    // Pagination per halaman
    $perPage = $request->get('perPage', 10); // default 10
    $pembelianList = $query->orderBy('created_at', 'desc')->paginate($perPage);

    return view('pembelian.historyAdmin', compact('pembelianList'));
}
}

