<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Pembelian;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Penting!
    }

    public function index()
    {
        $cart = Session::get('cart', []);
        return view('pembelian.cart', compact('cart'));
    }
    public function update(Request $request)
{
    $isbn = $request->isbn;
    $jumlah = max(1, (int) $request->jumlah); // Pastikan jumlah minimal 1

    $cart = session()->get('cart', []);

    if (isset($cart[$isbn])) {
        $cart[$isbn]['jumlah'] = $jumlah;
        session()->put('cart', $cart);
    }

    return back()->with('success', 'Jumlah berhasil diperbarui.');
}


    public function add(Request $request)
    {
        $request->validate([
            'buku_isbn' => 'required|exists:BUKU,BUKU_ISBN',
            'jumlah' => 'required|integer|min:1',
        ]);

        $buku = Buku::where('BUKU_ISBN', $request->buku_isbn)->firstOrFail();

        $cart = Session::get('cart', []);

        if (isset($cart[$buku->BUKU_ISBN])) {
            $cart[$buku->BUKU_ISBN]['jumlah'] += $request->jumlah;
        } else {
            $cart[$buku->BUKU_ISBN] = [
                'judul' => $buku->BUKU_JUDUL,
                'isbn' => $buku->BUKU_ISBN,
                'harga' => $buku->BUKU_HARGA,
                'jumlah' => $request->jumlah,
            ];
        }

        Session::put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Buku ditambahkan ke keranjang!');
    }

    public function remove(Request $request)
    {
        $isbn = $request->isbn;
        $cart = Session::get('cart', []);

        if (isset($cart[$isbn])) {
            unset($cart[$isbn]);
            Session::put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Buku dihapus dari keranjang.');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'nama_pembeli' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return back()->withErrors('Keranjang masih kosong.');
        }

        $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        foreach ($cart as $item) {
            Pembelian::create([
                'ID_PENGGUNA' => Auth::id(),
                'NAMA_USER' => Auth::user()->name,
                'BUKU_JUDUL' => $item['judul'],
                'BUKU_ISBN' => $item['isbn'],
                'BUKU_HARGA' => $item['harga'],
                'JUMLAH_ITEM' => $item['jumlah'],
                'TOTAL_HARGA' => $item['harga'] * $item['jumlah'],
                'BUKTI_PEMBAYARAN' => $path,
                'NAMA_PEMBELI' => $request->nama_pembeli,
                'ALAMAT' => $request->alamat,
            ]);
        }

        Session::forget('cart');

        return redirect()->route('dashboard2')->with('success', 'Pembelian berhasil disimpan!');
    }
}
