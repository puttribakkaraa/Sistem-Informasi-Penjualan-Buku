<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Pembelian;

class HomeBeforeController extends Controller
{
    public function index()
    {
        $totalBuku = Buku::count();
        $totalKategori = Kategori::count();
        $totalPenerbit = Penerbit::count();
        $totalPembelian = Pembelian::count();
        $books = Buku::latest()->take(5)->get();

        // Flash message
        session()->flash('popup', 'Selamat datang di sistem informasi penjualan buku Media Cendekia Muslim!');

        return view('HomeBefore', compact('totalBuku', 'totalKategori', 'totalPenerbit', 'totalPembelian', 'books'));
    }
}
