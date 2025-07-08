<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UlasanBuku;

class UlasanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'BUKU_ISBN' => 'required|exists:BUKU,BUKU_ISBN',
            'isi_ulasan' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        UlasanBuku::create([
            'BUKU_ISBN' => $request->BUKU_ISBN,
            'user_id' => auth()->id(),
            'isi_ulasan' => $request->isi_ulasan,
            'rating' => $request->rating,
        ]);

        return redirect()->back()->with('success', 'Ulasan berhasil dikirim.');
    }
}
