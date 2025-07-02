<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Pembelian;
use App\Models\Pengarang;
use App\Models\User;

class HomeAdminController extends Controller
{
    public function index()
    {
        return view('HomeAdmin', [
            'totalBuku' => Buku::count(),
            'totalKategori' => Kategori::count(),
            'totalPenerbit' => Penerbit::count(),
            'totalPembelian' => Pembelian::count(),
            'totalPengarang' => Pengarang::count(),
            'totalUser' => User::count()
        ]);
    }
}
