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
  public function index(Request $request)
{
    $query = Buku::with('penerbit')->orderBy('BUKU_ISBN', 'asc');

    // Cek jika ada pencarian
    if ($request->has('q') && $request->q !== null) {
        $search = $request->q;
        $query->where(function ($q) use ($search) {
            $q->where('BUKU_JUDUL', 'like', '%' . $search . '%')
              ->orWhere('BUKU_ISBN', 'like', '%' . $search . '%');
        });
    }

    $bukuList = $query->get();

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
public function show($isbn)
{
    $buku = Buku::with(['penerbit', 'kategoris'])->where('BUKU_ISBN', $isbn)->firstOrFail();

    // Ambil kategori pertama yang dimiliki buku
    $kategori = $buku->kategoris->first(); // Jika ada lebih dari satu, kita ambil satu dulu

    $rekomendasi = collect(); // Default, koleksi kosong

    if ($kategori) {
        $rekomendasi = Buku::whereHas('kategoris', function ($query) use ($kategori) {
            $query->where('kategori.KATEGORI_ID', $kategori->KATEGORI_ID);
        })
        ->where('BUKU_ISBN', '!=', $buku->BUKU_ISBN)
        ->inRandomOrder()
        ->take(4)
        ->get();
    }

    return view('buku.detail', compact('buku', 'rekomendasi'));
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
    $keyword = $request->get('q'); // Tidak diubah ke lowercase

    $books = Buku::with('penerbit')->orderBy('BUKU_JUDUL')->get();
    $booksArray = $books->toArray();

    $left = 0;
    $right = count($booksArray) - 1;
    $foundBooks = [];

    while ($left <= $right) {
        $mid = (int)(($left + $right) / 2);
        $judulMid = $booksArray[$mid]['BUKU_JUDUL'];

        if (stripos($judulMid, $keyword) !== false) {
            $foundBooks[] = $booksArray[$mid];

            // Cari kiri
            $i = $mid - 1;
            while ($i >= 0 && stripos($booksArray[$i]['BUKU_JUDUL'], $keyword) !== false) {
                $foundBooks[] = $booksArray[$i];
                $i--;
            }

            // Cari kanan
            $i = $mid + 1;
            while ($i < count($booksArray) && stripos($booksArray[$i]['BUKU_JUDUL'], $keyword) !== false) {
                $foundBooks[] = $booksArray[$i];
                $i++;
            }

            break;
        } elseif (strcasecmp($keyword, $judulMid) < 0) {
            $right = $mid - 1;
        } else {
            $left = $mid + 1;
        }
    }

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
public function edit($isbn)
{
    $buku = Buku::with(['penerbit', 'kategoris'])->where('BUKU_ISBN', $isbn)->firstOrFail();
    $penerbits = Penerbit::all(); // Untuk dropdown penerbit, jika diperlukan
    return view('buku.edit', compact('buku', 'penerbits'));
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
