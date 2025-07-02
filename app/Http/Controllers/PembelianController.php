<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembelian;
use App\Models\Buku;
use App\Notifications\StatusPesananNotification;
use Illuminate\Support\Facades\Storage;

class PembelianController extends Controller
{
    public function tampil()
    {
        $title = 'Checkout';
        return view('pembelian.Tampil', compact('title'));
    }

    public function addToCart(Request $request)
    {
        $buku = Buku::findOrFail($request->BUKU_ISBN);
        $cart = session()->get('cart', []);

        if (isset($cart[$buku->BUKU_ISBN])) {
            $cart[$buku->BUKU_ISBN]['jumlah'] += 1;
        } else {
            $cart[$buku->BUKU_ISBN] = [
                'judul' => $buku->BUKU_JUDUL,
                'harga' => $buku->BUKU_HARGA,
                'jumlah' => 1
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.show')->with('success', 'Buku ditambahkan ke keranjang!');
    }

    public function showCart()
    {
        $cart = session()->get('cart', []);
        $title = 'Keranjang Belanja';
        return view('pembelian.cart', compact('cart', 'title'));
    }

    public function removeFromCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $isbn = $request->isbn;

        if (isset($cart[$isbn])) {
            unset($cart[$isbn]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.show')->with('success', 'Buku dihapus dari keranjang.');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'nama_pembeli' => 'required|string|max:255',
            'alamat' => 'required|string',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $cart = session()->get('cart', []);

        if (!$cart || count($cart) == 0) {
            return redirect()->route('dashboard2')->with('error', 'Keranjang belanja kosong.');
        }

        $buktiPath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        foreach ($cart as $isbn => $item) {
            $buku = Buku::where('BUKU_ISBN', $isbn)->first();
            if (!$buku) continue;

            if ($buku->stok < $item['jumlah']) {
                return redirect()->route('cart.show')->with('error', "Stok untuk {$item['judul']} tidak mencukupi.");
            }

            $buku->stok -= $item['jumlah'];
            $buku->save();

            Pembelian::create([
                'ID_PENGGUNA' => auth()->id(),
                'NAMA_USER' => auth()->user()->name ?? 'Guest',
                'BUKU_JUDUL' => $item['judul'],
                'JUMLAH_ITEM' => $item['jumlah'],
                'BUKU_HARGA' => $item['harga'],
                'TOTAL_HARGA' => $item['harga'] * $item['jumlah'],
                'BUKU_ISBN' => $isbn,
                'BUKTI_PEMBAYARAN' => $buktiPath,
                'NAMA_PEMBELI' => $request->nama_pembeli,
                'ALAMAT' => $request->alamat,
                'status_pesanan' => 'diproses',
            ]);
        }

        session()->forget('cart');

        return redirect()->route('dashboard2')->with('success', 'Checkout berhasil! Pesanan sedang diproses.');
    }

    public function historyAdmin()
    {
        $pembelianList = Pembelian::orderBy('created_at', 'desc')->get();
        return view('pembelian.historyAdmin', compact('pembelianList'));
    }

    public function history()
    {
        $pembelianList = Pembelian::where('ID_PENGGUNA', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pembelian.history', compact('pembelianList'));
    }

    // ✅ Admin ubah status + kirim notifikasi
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status_pesanan' => 'required|in:diproses,dikirim,ditolak,selesai',
        ]);

        try {
            $pembelian = Pembelian::findOrFail($id);

            if ($pembelian->status_pesanan === $validated['status_pesanan']) {
                return back()->with('info', 'Status pesanan sudah sama.');
            }

            $pembelian->status_pesanan = $validated['status_pesanan'];
            $pembelian->save();

            // ✅ Kirim notifikasi ke user
            if ($pembelian->user) {
                $pembelian->user->notify(new StatusPesananNotification($pembelian, $validated['status_pesanan']));
            }

            return redirect()->route('pembelian.historyAdmin')->with('success', 'Status berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withErrors('Gagal update status: ' . $e->getMessage());
        }
    }

    // ✅ User update status jika sudah sampai
    public function updateStatusUser(Request $request, $id)
    {
        $validated = $request->validate([
            'status_pesanan' => 'required|in:sampai',
        ]);

        try {
            $pembelian = Pembelian::findOrFail($id);

            if ($pembelian->status_pesanan === $validated['status_pesanan']) {
                return back()->with('info', 'Status pesanan sudah sampai.');
            }

            $pembelian->status_pesanan = $validated['status_pesanan'];
            $pembelian->save();

            return redirect()->route('pembelian.history')->with('success', 'Status diperbarui.');
        } catch (\Exception $e) {
            return back()->withErrors('Gagal update status: ' . $e->getMessage());
        }
    }
}
