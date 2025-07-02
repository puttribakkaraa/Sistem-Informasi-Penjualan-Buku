<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Penerbit;
use Illuminate\Http\Request;

class TambahBukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::all();
        return view('buku.index', compact('bukus'));
    }

    public function create()
    {
        $penerbits = Penerbit::all();
        return view('buku.create', compact('penerbits'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'BUKU_ISBN' => 'required|max:20',
            'BUKU_JUDUL' => 'required|max:75',
            'stok' => 'required|integer|min:0',
            'PENERBIT_ID' => 'required|exists:PENERBIT,PENERBIT_ID',
            'BUKU_TGLTERBIT' => 'nullable|date',
            'BUKU_JMLHALAMAN' => 'nullable|integer',
            'BUKU_DESKRIPSI' => 'nullable|string',
            'BUKU_HARGA' => 'nullable|numeric',
            'BUKU_GAMBAR' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('BUKU_GAMBAR')) {
            $file = $request->file('BUKU_GAMBAR');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $validated['BUKU_GAMBAR'] = $filename;
        }

        Buku::create($validated);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }
    public function destroy($isbn)
{
    $buku = \App\Models\Buku::findOrFail($isbn);
    
    // Jika ada gambar, hapus file dari folder
    if ($buku->BUKU_GAMBAR && file_exists(public_path('images/' . $buku->BUKU_GAMBAR))) {
        unlink(public_path('images/' . $buku->BUKU_GAMBAR));
    }

    $buku->delete();

    return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus.');
}
public function edit($isbn)
{
    $buku = \App\Models\Buku::findOrFail($isbn);
    $penerbits = \App\Models\Penerbit::all(); // untuk dropdown penerbit

    return view('buku.edit', compact('buku', 'penerbits'));
}
public function show($id)
{
    $buku = Buku::findOrFail($id);
    return view('buku.show', compact('buku'));
}

public function update(Request $request, $isbn)
{
    $request->validate([
        'BUKU_ISBN' => 'required|max:13',
        'BUKU_JUDUL' => 'required|max:75',
        'stok' => 'required|integer|min:0',
        'PENERBIT_ID' => 'required|exists:PENERBIT,PENERBIT_ID',
        'BUKU_TGLTERBIT' => 'nullable|date',
        'BUKU_JMLHALAMAN' => 'nullable|integer',
        'BUKU_DESKRIPSI' => 'nullable|string',
        'BUKU_HARGA' => 'nullable|numeric',
        'BUKU_GAMBAR' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
    ]);

    $buku = \App\Models\Buku::findOrFail($isbn);
    $data = $request->except('BUKU_GAMBAR');

    // Jika ada file gambar baru di-upload
    if ($request->hasFile('BUKU_GAMBAR')) {
        $file = $request->file('BUKU_GAMBAR');
        $namaFile = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images'), $namaFile);

        // Hapus gambar lama jika ada
        if ($buku->BUKU_GAMBAR && file_exists(public_path('images/' . $buku->BUKU_GAMBAR))) {
            unlink(public_path('images/' . $buku->BUKU_GAMBAR));
        }

        $data['BUKU_GAMBAR'] = $namaFile;
    }

    $buku->update($data);

    return redirect()->route('buku.index')->with('success', 'Data buku berhasil diperbarui');
}


}
