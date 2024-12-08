<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Penerbit;  // Model untuk Penerbit
use Illuminate\Http\Request;

class TambahBukuController extends Controller
{
    // Menampilkan daftar buku
    public function index()
    {
        $bukus = Buku::all();
        return view('buku.index', compact('bukus'));
    }

    // Menampilkan form untuk menambah buku
    public function create()
    {
        $penerbits = Penerbit::all();  // Ambil semua penerbit untuk dropdown
        return view('buku.create', compact('penerbits'));
    }

    // Menyimpan buku baru
    public function store(Request $request)
    {
        $request->validate([
            'BUKU_ISBN' => 'required|max:13',
            'BUKU_JUDUL' => 'required|max:75',
            'PENERBIT_ID' => 'required|exists:PENERBIT,PENERBIT_ID',
            'BUKU_TGLTERBIT' => 'nullable|date',
            'BUKU_JMLHALAMAN' => 'nullable|integer',
            'BUKU_DESKRIPSI' => 'nullable|string',
            'BUKU_HARGA' => 'nullable|numeric',
        ]);

        Buku::create($request->all());

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan');
    }

    // Menampilkan form untuk edit buku
    public function edit($isbn)
    {
        $buku = Buku::findOrFail($isbn);
        $penerbits = Penerbit::all();  // Ambil semua penerbit untuk dropdown
        return view('buku.edit', compact('buku', 'penerbits'));
    }

    // Memperbarui buku
    public function update(Request $request, $isbn)
    {
        $request->validate([
            'BUKU_ISBN' => 'required|max:13',
            'BUKU_JUDUL' => 'required|max:75',
            'PENERBIT_ID' => 'required|exists:PENERBIT,PENERBIT_ID',
            'BUKU_TGLTERBIT' => 'nullable|date',
            'BUKU_JMLHALAMAN' => 'nullable|integer',
            'BUKU_DESKRIPSI' => 'nullable|string',
            'BUKU_HARGA' => 'nullable|numeric',
        ]);

        $buku = Buku::findOrFail($isbn);
        $buku->update($request->all());

        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui');
    }

    // Menghapus buku
    public function destroy($isbn)
    {
        $buku = Buku::findOrFail($isbn);
        $buku->delete();

        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus');
    }
}

