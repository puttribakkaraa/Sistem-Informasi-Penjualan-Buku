<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
class DaftarBukuController extends Controller
{
    public function index()
    {
        // Data buku dari database dan variabel tambahan untuk title
        $bukuList = Buku::all();
        $title = 'Pustaka Bit';

        // Mengirim data buku dan title ke view
        return view('Buku', compact('bukuList', 'title'));
    }

    public function index2()
    {
        // Data buku dari database dan variabel tambahan untuk title
        $bukuList = Buku::all();
        $title = 'Pustaka Bit';

        // Mengirim data buku dan title ke view
        return view('BukuBefore', compact('bukuList', 'title'));
    }

    // Fungsi untuk pencarian dan pengurutan berdasarkan harga
    public function searchByPrice(Request $request)
    {
        // Ambil nilai harga minimum dan maksimum dari request
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        // Query untuk mendapatkan buku berdasarkan harga dalam rentang tertentu
        $books = Buku::whereBetween('BUKU_HARGA', [$minPrice, $maxPrice])->get();

        // Mengurutkan buku dengan QuickSort
        $books = $this->quickSort($books);

        // Konversi kembali array menjadi koleksi Laravel
        $books = collect($books);

        // Kembalikan hasil pencarian
        return view('Search', compact('books'));
    }

    public function searchByPrice2(Request $request)
    {
        // Ambil nilai harga minimum dan maksimum dari request
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        // Query untuk mendapatkan buku berdasarkan harga dalam rentang tertentu
        $books = Buku::whereBetween('BUKU_HARGA', [$minPrice, $maxPrice])->get();

        // Mengurutkan buku dengan QuickSort
        $books = $this->quickSort($books);

        // Konversi kembali array menjadi koleksi Laravel
        $books = collect($books);

        // Kembalikan hasil pencarian
        return view('SearchBefore', compact('books'));
    }

    // Implementasi algoritma QuickSort
    private function quickSort($arr)
    {
        if (count($arr) < 2) {
            return $arr;
        }

        $left = $right = [];
        $pivot = $arr[0]; // Pilih pivot

        // Pisahkan elemen yang lebih kecil dan lebih besar dari pivot
        foreach ($arr as $book) {
            if ($book->BUKU_HARGA < $pivot->BUKU_HARGA) {
                $left[] = $book;
            } elseif ($book->BUKU_HARGA > $pivot->BUKU_HARGA) {
                $right[] = $book;
            }
        }

        // Rekursi untuk mengurutkan kiri dan kanan
        return array_merge($this->quickSort($left), [$pivot], $this->quickSort($right));
    }


}

