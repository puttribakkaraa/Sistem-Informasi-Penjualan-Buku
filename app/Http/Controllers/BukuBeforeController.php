<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuBeforeController extends Controller
{
    public function index()
    {
        $bukuList = Buku::with('penerbit')->get();
        return view('Buku', compact('bukuList')+ ['title' => 'Katalog Buku']);
        
    }
    public function searchBefore(Request $request)
{
    $min = $request->get('min');
    $max = $request->get('max');

    $bukuList = Buku::whereBetween('BUKU_HARGA', [$min, $max])->get();

    return view('bukubefore', compact('bukuList'));
}

}
