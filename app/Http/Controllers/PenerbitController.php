<?php

namespace App\Http\Controllers;

use App\Models\Penerbit;
use Illuminate\Http\Request;

class PenerbitController extends Controller
{
    // Menampilkan daftar penerbit
  public function index(Request $request)
{
    $query = Penerbit::query();

    // Tambahkan pencarian berdasarkan nama penulis
    if ($request->has('q') && $request->q !== null) {
        $query->where('PENERBIT_NAMA', 'like', '%' . $request->q . '%');
    }

    $penerbits = $query->orderBy('PENERBIT_ID')->get();

    return view('admin.penerbit.index', compact('penerbits'));
}
    // Menampilkan form untuk menambah penerbit
   public function create()
{
    // Ambil kode penerbit terakhir
    $lastPenerbit = \App\Models\Penerbit::orderBy('PENERBIT_ID', 'desc')->first();

    if ($lastPenerbit) {
        $lastId = (int) filter_var($lastPenerbit->PENERBIT_ID, FILTER_SANITIZE_NUMBER_INT);
        $newId = str_pad($lastId + 1, 3, '0', STR_PAD_LEFT); // Misal: P001, P002
    } else {
        $newId = '001';
    }

    return view('admin.penerbit.create', compact('newId'));
}

    // Menyimpan penerbit baru
   public function store(Request $request)
{
    $validated = $request->validate([
        'PENERBIT_ID' => 'required|unique:PENERBIT,PENERBIT_ID|max:10',
        'PENERBIT_NAMA' => 'required|max:50',
    ]);

    \App\Models\Penerbit::create($validated);

    return redirect()->route('admin.penerbit.index')->with('success', 'Penerbit berhasil ditambahkan!');
}

    // Menampilkan form untuk edit penerbit
    public function edit($id)
    {
        $penerbit = Penerbit::findOrFail($id);
        return view('admin.penerbit.edit', compact('penerbit'));
    }

    // Memperbarui penerbit
   public function update(Request $request, $id)
{
    $request->validate([
        'PENERBIT_NAMA' => 'required|max:50',
    ]);

    $penerbit = Penerbit::findOrFail($id);
    
    // Jangan update ID-nya!
    $penerbit->PENERBIT_NAMA = $request->PENERBIT_NAMA;
    $penerbit->save();
    return redirect()->route('admin.penerbit.index')->with('success', 'Penulis berhasil diperbarui');
   
}


    // Menghapus penerbit
    public function destroy($id)
    {
        $penerbit = Penerbit::findOrFail($id);
        $penerbit->delete();

        return redirect()->route('admin.penerbit.index')->with('success', 'Penerbit berhasil dihapus');
    }
}

