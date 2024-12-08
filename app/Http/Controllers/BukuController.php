<?php

// app/Http/Controllers/BukuController.php
namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Pembelian;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        // Mengambil 5 buku terakhir berdasarkan BUKU_TGLTERBIT dalam urutan menurun
        $books = Buku::with('Penerbit')->orderBy('BUKU_TGLTERBIT', 'desc')->take(5)->get();


        $title = 'Pustaka Bit';

        // Menghitung statistik
        $totalBuku = Buku::count();
        $totalKategori = Kategori::count();
        $totalPenerbit = Penerbit::count();
        $totalPembelian = Pembelian::count();

        return view('Home', compact('books', 'totalBuku', 'totalKategori', 'totalPenerbit', 'title', 'totalPembelian'));
         $bukus = Buku::all();
        
    }

    public function index2()
    {
        // Mengambil 5 buku terakhir berdasarkan BUKU_TGLTERBIT dalam urutan menurun
        $books = Buku::with('Penerbit')->orderBy('BUKU_TGLTERBIT', 'desc')->take(5)->get();


        $title = 'Pustaka Bit';

        // Menghitung statistik
        $totalBuku = Buku::count();
        $totalKategori = Kategori::count();
        $totalPenerbit = Penerbit::count();
        $totalPembelian = Pembelian::count();

        return view('HomeBefore', compact('books', 'totalBuku', 'totalKategori', 'totalPenerbit', 'title', 'totalPembelian'));
         $bukus = Buku::all();
        
    }

     public function filterBuku(Request $request)
    {
        // Mendapatkan kategori untuk dropdown
        $kategoris = Kategori::orderBy('KATEGORI_NAMA')->get();

        // Mendapatkan kategori_id dari request
        $kategoriId = $request->get('kat');

        // Jika kategori_id ada, ambil buku yang sesuai
        if ($kategoriId) {
           $bukuByKategori = Buku::whereHas('kategoris', function($query) use ($kategoriId) {
                $query->where('LINK_BUKU_KATEGORI.KATEGORI_ID', $kategoriId); // Menambahkan alias untuk menghindari ambiguitas
            })
            ->with(['penerbit', 'kategoris'])
            ->get();

            $kategoriNama = Kategori::find($kategoriId)->KATEGORI_NAMA;
        } else {
            // Jika kategori_id tidak ada, ambil semua buku
            $bukuByKategori = Buku::with(['penerbit', 'kategoris'])->get();
            $kategoriNama = 'Semua Kategori';
        }

        // Menggunakan HashMap (Collection) untuk mengelompokkan buku berdasarkan kategori
        $groupedBuku = $bukuByKategori->groupBy(function ($item) {
            return $item->kategoris->pluck('KATEGORI_NAMA')->first(); // Mengambil nama kategori pertama
        });

        return view('CariKategori', compact('kategoris', 'groupedBuku', 'kategoriNama'));
    }

     public function filterBuku2(Request $request)
    {
        // Mendapatkan kategori untuk dropdown
        $kategoris = Kategori::orderBy('KATEGORI_NAMA')->get();

        // Mendapatkan kategori_id dari request
        $kategoriId = $request->get('kat');

        // Jika kategori_id ada, ambil buku yang sesuai
        if ($kategoriId) {
           $bukuByKategori = Buku::whereHas('kategoris', function($query) use ($kategoriId) {
                $query->where('LINK_BUKU_KATEGORI.KATEGORI_ID', $kategoriId); // Menambahkan alias untuk menghindari ambiguitas
            })
            ->with(['penerbit', 'kategoris'])
            ->get();

            $kategoriNama = Kategori::find($kategoriId)->KATEGORI_NAMA;
        } else {
            // Jika kategori_id tidak ada, ambil semua buku
            $bukuByKategori = Buku::with(['penerbit', 'kategoris'])->get();
            $kategoriNama = 'Semua Kategori';
        }

        // Menggunakan HashMap (Collection) untuk mengelompokkan buku berdasarkan kategori
        $groupedBuku = $bukuByKategori->groupBy(function ($item) {
            return $item->kategoris->pluck('KATEGORI_NAMA')->first(); // Mengambil nama kategori pertama
        });

        return view('CariKategoriBefore', compact('kategoris', 'groupedBuku', 'kategoriNama'));
    }

}


