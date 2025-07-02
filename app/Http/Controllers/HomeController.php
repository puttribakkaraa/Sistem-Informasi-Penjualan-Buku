<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Pembelian;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Pastikan user login
    }

    public function index()
    {
        $user = Auth::user();

        $totalBuku = Buku::count();
        $totalKategori = Kategori::count();
        $totalPenerbit = Penerbit::count();
        $totalPembelian = Pembelian::where('ID_PENGGUNA', $user->id)->count();

        $books = Buku::with('penerbit')
            ->orderBy('BUKU_TGLTERBIT', 'desc')
            ->take(16)
            ->get();

        // Pastikan notifikasi dibaca dari user
        $notifikasiUnread = $user->unreadNotifications ?? collect(); // jaga-jaga null
        $notifikasi = $user->notifications ?? collect();

        return view('Home', [
            'totalBuku' => $totalBuku,
            'totalKategori' => $totalKategori,
            'totalPenerbit' => $totalPenerbit,
            'totalPembelian' => $totalPembelian,
            'books' => $books,
            'notifikasiUnread' => $notifikasiUnread,
            'notifikasi' => $notifikasi,
            'title' => 'Media Cendekia Muslim'
        ]);
    }
}
