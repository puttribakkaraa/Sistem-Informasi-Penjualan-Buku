<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\LinkBukuKategori;
use Illuminate\Http\Request;

class LinkBukuKategoriController extends Controller
{
    public function index()
    {
        $linkBukuKategoris = LinkBukuKategori::all();
        return view('admin.link_buku_kategori.index', compact('linkBukuKategoris'));
    }

    public function create()
    {
        return view('admin.link_buku_kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'buku_isbn' => 'required',
            'KATEGORI_ID' => 'required|exists:kategori,KATEGORI_ID',
        ]);

        LinkBukuKategori::create([
            'buku_isbn' => $request->buku_isbn,
            'KATEGORI_ID' => $request->KATEGORI_ID,
        ]);

        return redirect()->route('admin.link_buku_kategori.index')->with('success', 'Link Buku Kategori berhasil ditambahkan');
    }

    public function edit($buku_isbn, $kategori_id)
    {
        $linkBukuKategori = LinkBukuKategori::where('buku_isbn', $buku_isbn)
            ->where('kategori_id', $kategori_id)
            ->firstOrFail();

        return view('admin.link_buku_kategori.edit', compact('linkBukuKategori'));
    }

        public function update(Request $request, $buku_isbn, $kategori_id)
            {
                $link = LinkBukuKategori::where('buku_isbn', $buku_isbn)
                    ->where('kategori_id', $kategori_id)
                    ->firstOrFail();

                $link->buku_isbn = $request->buku_isbn;
                $link->kategori_id = $request->kategori_id;
                $link->save();

                return redirect()->route('admin.link_buku_kategori.index')->with('success', 'Data berhasil diupdate!');
            }



   public function destroy($buku_isbn, $kategori_id)
{
    LinkBukuKategori::where('buku_isbn', $buku_isbn)
        ->where('KATEGORI_ID', $kategori_id)
        ->delete();

    return redirect()->route('admin.link_buku_kategori.index')->with('success', 'Data berhasil dihapus.');
}

}
