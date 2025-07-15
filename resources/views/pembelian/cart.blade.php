<x-layout :title="'Akademi MCM'">
 <a href="{{ url('/Buku') }}" class="inline-block mb-6 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded">
                    ⬅️ Kembali ke Daftar Buku
                </a>
<div class="max-w-5xl mx-auto mt-10 px-4">
    <h1 class="text-3xl font-bold mb-6 text-gray-800 flex items-center gap-2">
        🛒 Keranjang Belanja
    </h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 p-4 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif


    @if($cart && count($cart) > 0)
        <div class="overflow-x-auto rounded shadow">
            <table class="min-w-full bg-white border border-gray-200 text-sm">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3 text-left">📖 Judul</th>
                        <th class="px-4 py-3 text-left">🔖 ISBN</th>
                        <th class="px-4 py-3 text-left">💸 Harga</th>
                        <th class="px-4 py-3 text-left">🔢 Jumlah</th>
                        <th class="px-4 py-3 text-left">🧾 Total</th>
                        <th class="px-4 py-3 text-left">🗑️ Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @php $grandTotal = 0; @endphp
                    @foreach($cart as $item)
                        @php $total = $item['harga'] * $item['jumlah']; $grandTotal += $total; @endphp
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $item['judul'] }}</td>
                            <td class="px-4 py-3">{{ $item['isbn'] }}</td>
                            <td class="px-4 py-3">Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                            <td class="px-4 py-3">{{ $item['jumlah'] }}</td>
                            <td class="px-4 py-3">Rp {{ number_format($total, 0, ',', '.') }}</td>
                            <td class="px-4 py-3">
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="isbn" value="{{ $item['isbn'] }}">
                                    <button class="text-red-500 hover:text-red-700 flex items-center gap-1">
                                        🗑️ <span>Hapus</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    <tr class="bg-gray-100 font-semibold border-t">
                        <td colspan="4" class="px-4 py-3 text-right">💰 Total Bayar:</td>
                        <td class="px-4 py-3">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Form Checkout -->
        <div class="bg-white p-6 mt-8 rounded-lg shadow">
           <form action="{{ route('pembelian.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">

    @csrf

    @foreach($cart as $isbn => $item)
        <input type="hidden" name="buku_isbn[]" value="{{ $isbn }}">
        <input type="hidden" name="jumlah[]" value="{{ $item['jumlah'] }}">
    @endforeach

    <!-- input lainnya tetap -->

               <div class="mb-6">
                    <label for="nama_user" class="block text-sm font-medium text-indigo-600">Nama User</label>
                    <input type="text" name="nama_pembeli"  value="{{ auth()->user()->name }}" 
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm text-gray-500 py-3 px-6">
                </div>

                <div>
                    <label class="block font-semibold mb-1">📍 Alamat</label>
                    <textarea name="alamat" class="w-full p-2 border rounded focus:ring focus:ring-blue-200" required></textarea>
                </div>

                <div class="bg-blue-50 p-4 rounded text-blue-800 font-medium">
                    💳 Transfer ke: <strong>1122-3344-5566-65 (BRI)</strong>
                </div>

                <div class="bg-teal-50 p-4 rounded text-teal-800 font-medium">
                    📱 Bayar dengan: <a href="/qrCode" class="text-teal-600 underline">QR Code</a>
                </div>

                <div>
                    <label class="block font-semibold mb-1">🧾 Upload Bukti Pembayaran</label>
                    <input type="file" name="bukti_pembayaran" class="w-full border p-2 rounded" required>
                </div>

                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                    ✅ Checkout Sekarang
                </button>
                   
            </form>
        </div>
    @else
        <p class="text-gray-600 mt-4">Keranjang kamu kosong 😢</p>
    @endif
</div>
</x-layout>
