<?php

namespace App\Http\Controllers;

use App\Models\Pengarang;
use Illuminate\Http\Request;

class PengarangController extends Controller
{
    // Menampilkan daftar pengarang
    public function index()
    {
        $pengarangs = Pengarang::all();
        return view('pengarang.index', compact('pengarangs'));
    }

    // Menampilkan form untuk menambah pengarang
    public function create()
{
    $lastPengarang = \App\Models\Pengarang::orderBy('PENGARANG_ID', 'desc')->first();

    if ($lastPengarang) {
        $lastId = (int) filter_var($lastPengarang->PENGARANG_ID, FILTER_SANITIZE_NUMBER_INT);
        $newId = str_pad($lastId + 1, 3, '0', STR_PAD_LEFT); // contoh: P001, P002, ...
    } else {
        $newId = '001';
    }

    return view('pengarang.create', compact('newId'));
}


    // Menyimpan pengarang baru
   public function store(Request $request)
{
    $validated = $request->validate([
        'PENGARANG_ID' => 'required|unique:PENGARANG,PENGARANG_ID|max:10',
        'PENGARANG_NAMA' => 'required|max:50',
    ]);

    \App\Models\Pengarang::create($validated);

    return redirect()->route('pengarang.index')->with('success', 'Pengarang berhasil ditambahkan!');
}

    // Menampilkan form untuk edit pengarang
    public function edit($id)
    {
        $pengarang = Pengarang::findOrFail($id);
        return view('pengarang.edit', compact('pengarang'));
    }

    // Memperbarui pengarang
    public function update(Request $request, $id)
    {
        $request->validate([
            'PENGARANG_ID' => 'required|max:3',
            'PENGARANG_NAMA' => 'required|max:30',
        ]);

        $pengarang = Pengarang::findOrFail($id);
        $pengarang->update($request->all());

        return redirect()->route('pengarang.index')->with('success', 'Pengarang berhasil diperbarui');
    }

    // Menghapus pengarang
    public function destroy($id)
    {
        $pengarang = Pengarang::findOrFail($id);
        $pengarang->delete();

        return redirect()->route('pengarang.index')->with('success', 'Pengarang berhasil dihapus');
    }
}
