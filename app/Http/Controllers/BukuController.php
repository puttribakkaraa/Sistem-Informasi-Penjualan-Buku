<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Support\Facades\DB;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Pembelian;
use Illuminate\Http\Request;

class BukuController extends Controller
{
  public function index()
{
    $bukuList = Buku::with('penerbit')->orderBy('BUKU_TGLTERBIT', 'desc')->get();
    $title = 'Media Cendekia Muslim';
    $totalBuku = Buku::count();
    $totalKategori = Kategori::count();
    $totalPenerbit = Penerbit::count();
    $totalPembelian = Pembelian::count();

    return view('buku.index', compact('bukuList', 'title', 'totalBuku', 'totalKategori', 'totalPenerbit', 'totalPembelian'));

}

public function searchByHarga(Request $request)
{
    $request->validate([
        'min_price' => 'required|numeric|min:0',
        'max_price' => 'required|numeric|gte:min_price',
    ]);

    $min = $request->min_price;
    $max = $request->max_price;

    $books = Buku::with('penerbit')
        ->whereBetween('BUKU_HARGA', [$min, $max])
        ->get();

    return view('search', compact('books'));
}

    public function index2()
    {
        $books = Buku::with('penerbit')->orderBy('BUKU_TGLTERBIT', 'desc')->take(5)->get();
        $title = 'Media Cendekia Muslim';
        $totalBuku = Buku::count();
        $totalKategori = Kategori::count();
        $totalPenerbit = Penerbit::count();
        $totalPembelian = Pembelian::count();

        return view('HomeBefore', compact('books', 'totalBuku', 'totalKategori', 'totalPenerbit', 'title', 'totalPembelian'));
    }

    public function filterBuku(Request $request)
    {
        $kategoris = Kategori::orderBy('KATEGORI_NAMA')->get();
        $kategoriId = $request->get('kat');

        if ($kategoriId) {
            $bukuByKategori = Buku::whereHas('kategoris', function($query) use ($kategoriId) {
                $query->where('LINK_BUKU_KATEGORI.KATEGORI_ID', $kategoriId);
            })->with(['penerbit', 'kategoris'])->get();

            $kategoriNama = Kategori::find($kategoriId)->KATEGORI_NAMA;
        } else {
            $bukuByKategori = Buku::with(['penerbit', 'kategoris'])->get();
            $kategoriNama = 'Semua Kategori';
        }

        $groupedBuku = $bukuByKategori->groupBy(function ($item) {
            return $item->kategoris->pluck('KATEGORI_NAMA')->first();
        });

        return view('CariKategori', compact('kategoris', 'groupedBuku', 'kategoriNama'));
    }
    
    public function filterBuku2(Request $request)
    {
        $kategoris = Kategori::orderBy('KATEGORI_NAMA')->get();
        $kategoriId = $request->get('kat');

        if ($kategoriId) {
            $bukuByKategori = Buku::whereHas('kategoris', function($query) use ($kategoriId) {
                $query->where('LINK_BUKU_KATEGORI.KATEGORI_ID', $kategoriId);
            })->with(['penerbit', 'kategoris'])->get();

            $kategoriNama = Kategori::find($kategoriId)->KATEGORI_NAMA;
        } else {
            $bukuByKategori = Buku::with(['penerbit', 'kategoris'])->get();
            $kategoriNama = 'Semua Kategori';
        }

        $groupedBuku = $bukuByKategori->groupBy(function ($item) {
            return $item->kategoris->pluck('KATEGORI_NAMA')->first();
        });

        return view('CariKategoriBefore', compact('kategoris', 'groupedBuku', 'kategoriNama'));
    }
    public function showAllBuku()
{
    $bukuList = Buku::with('penerbit')->get();
    $title = 'Daftar Buku';

    return view('Buku', compact('bukuList', 'title'));
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'BUKU_ISBN' => 'required|max:20',
            'BUKU_JUDUL' => 'required|max:75',
            'stok' => 'required|integer|min:0',
            'PENERBIT_ID' => 'required',
            'BUKU_TGLTERBIT' => 'required|date',
            'BUKU_JMLHALAMAN' => 'required|integer',
            'BUKU_DESKRIPSI' => 'required',
            'BUKU_HARGA' => 'required|numeric',
            'BUKU_GAMBAR' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('BUKU_GAMBAR')) {
            $file = $request->file('BUKU_GAMBAR');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $validated['BUKU_GAMBAR'] = $filename;
        }

        Buku::create($validated);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan!');
    }
    public function searchBinary(Request $request)
{
    $keyword = strtolower($request->get('q'));

    // Ambil semua buku, urutkan berdasarkan judul
    $books = Buku::with('penerbit')->orderBy('BUKU_JUDUL')->get();
    $booksArray = $books->toArray();

    // Binary search manual
    $left = 0;
    $right = count($booksArray) - 1;
    $foundBooks = [];

    while ($left <= $right) {
        $mid = (int)(($left + $right) / 2);
        $judulMid = strtolower($booksArray[$mid]['BUKU_JUDUL']);

        if (str_contains($judulMid, $keyword)) {
            $foundBooks[] = $booksArray[$mid];

            // Cari kiri
            $i = $mid - 1;
            while ($i >= 0 && str_contains(strtolower($booksArray[$i]['BUKU_JUDUL']), $keyword)) {
                $foundBooks[] = $booksArray[$i];
                $i--;
            }

            // Cari kanan
            $i = $mid + 1;
            while ($i < count($booksArray) && str_contains(strtolower($booksArray[$i]['BUKU_JUDUL']), $keyword)) {
                $foundBooks[] = $booksArray[$i];
                $i++;
            }

            break;
        } elseif ($keyword < $judulMid) {
            $right = $mid - 1;
        } else {
            $left = $mid + 1;
        }
    }

    // Konversi hasil ke koleksi dan relasi
    $bukuList = collect($foundBooks)->map(function ($item) {
        $buku = new \App\Models\Buku($item);
        $buku->exists = true;
        $buku->penerbit = \App\Models\Penerbit::find($item['PENERBIT_ID']);
        return $buku;
    });

    return view('Buku', [
        'title' => 'Hasil Pencarian Buku',
        'bukuList' => $bukuList ?? collect()
    ]);
}
public function bukuBefore()
{
    $bukuList = Buku::with('penerbit')->get();
    return view('bukuBefore', compact('bukuList'));
}

    public function update(Request $request, $isbn)
    {
        $validated = $request->validate([
            'BUKU_ISBN' => 'required|max:20',
            'BUKU_JUDUL' => 'required|max:75',
            'stok' => 'required|integer|min:0',
            'PENERBIT_ID' => 'required',
            'BUKU_TGLTERBIT' => 'required|date',
            'BUKU_JMLHALAMAN' => 'required|integer',
            'BUKU_DESKRIPSI' => 'required|string',
            'BUKU_HARGA' => 'required|numeric',
            'BUKU_GAMBAR' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $buku = Buku::findOrFail($isbn);

        if ($request->hasFile('BUKU_GAMBAR')) {
            if ($buku->BUKU_GAMBAR && file_exists(public_path('images/' . $buku->BUKU_GAMBAR))) {
                unlink(public_path('images/' . $buku->BUKU_GAMBAR));
            }

            $file = $request->file('BUKU_GAMBAR');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $validated['BUKU_GAMBAR'] = $filename;
        }

        $buku->update($validated);

        return redirect()->route('buku.index')->with('success', 'Data buku berhasil diperbarui!');
    }

public function create()
{
    $penerbits = \App\Models\Penerbit::all(); // Ambil semua penerbit untuk dropdown
    return view('buku.create', compact('penerbits'));
}

public function destroy($id)
{
    $buku = Buku::findOrFail($id);

    // Hapus gambar jika ada
    if ($buku->BUKU_GAMBAR && file_exists(public_path('images/' . $buku->BUKU_GAMBAR))) {
        unlink(public_path('images/' . $buku->BUKU_GAMBAR));
    }

    $buku->delete();

    return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus!');
}






}
