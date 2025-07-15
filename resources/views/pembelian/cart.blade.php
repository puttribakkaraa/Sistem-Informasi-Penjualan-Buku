<x-layout :title="'Akademi MCM'">

<a href="{{ url('/Buku') }}" class="inline-block mb-6 bg-indigo-100 hover:bg-indigo-200 text-indigo-700 font-medium py-2 px-4 rounded transition">
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
        <div class="overflow-x-auto rounded shadow border border-gray-200 bg-white">
            <table class="min-w-full text-sm">
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
                            <td class="px-4 py-3">
                                <form action="{{ route('cart.update') }}" method="POST" class="flex items-center gap-2">
                                    @csrf
                                    <input type="hidden" name="isbn" value="{{ $item['isbn'] }}">
                                    <input type="number" 
                                        class="w-16 border rounded text-center py-1 px-2 qty-input" 
                                        value="{{ $item['jumlah'] }}" 
                                        min="1" 
                                        data-harga="{{ $item['harga'] }}">
                                    <button type="submit" class="text-blue-600 hover:text-blue-800 text-sm">🔄</button>
                                </form>
                            </td>
                            <td class="px-4 py-3 item-total">Rp {{ number_format($total, 0, ',', '.') }}</td>
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
                        <td class="px-4 py-3" id="grandTotal">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- ✨ FORM CHECKOUT -->
        <div class="bg-white p-6 mt-10 rounded-lg shadow border space-y-6">
            <h2 class="text-lg font-bold text-gray-700 mb-2">📦 Informasi Pembeli</h2>
            <form action="{{ route('pembelian.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                @foreach($cart as $isbn => $item)
                    <input type="hidden" name="buku_isbn[]" value="{{ $isbn }}">
                    <input type="hidden" name="jumlah[]" value="{{ $item['jumlah'] }}">
                @endforeach

                 <div class="mb-6">
                    <label for="nama_user" class="block text-sm font-medium text-indigo-600">👤Nama User</label>
                    <input type="text" name="nama_pembeli"  value="{{ auth()->user()->name }}" readonly 
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm text-gray-500 py-3 px-6">
                </div>

                <div>
                    <label class="block text-sm font-medium text-indigo-700">🏠 Alamat</label>
                    <textarea name="alamat" class="w-full border-gray-300 rounded-lg py-2 px-4 text-gray-600 bg-gray-50" required></textarea>
                </div>

                <div class="bg-blue-50 p-4 rounded-lg border-l-4 border-blue-400 text-sm">
                    <p class="font-semibold mb-2">💳 Pilih Metode Pembayaran:</p>
                    <ul class="space-y-1 text-gray-700">
                        <li>🔹 <strong>BCA</strong> - 1234 5678 9012 a.n Toko Buku MCM</li>
                        <li>🔹 <strong>Mandiri</strong> - 4321 8765 1098 a.n Toko Buku MCM</li>
                        <li>🔹 <strong>BNI</strong> - 5678 4321 1234 a.n Toko Buku MCM</li>
                        <li>🔹 <strong>BRI</strong> - 1122-3344-5566-65 a.n Toko Buku MCM</li>
                    </ul>
                </div>

                <div class="bg-green-50 p-4 rounded-lg border-l-4 border-green-400 text-sm">
                    📱 Bayar dengan: <a href="/qrCode" class="text-green-700 underline font-semibold">QR Code</a>
                </div>

                <div>
                    <label class="block text-sm font-medium text-indigo-700">🧾 Upload Bukti Pembayaran</label>
                    <input type="file" name="bukti_pembayaran" class="w-full border border-gray-300 p-2 rounded-lg bg-gray-50" required>
                </div>

                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded shadow transition">
                    ✅ Checkout Sekarang
                </button>
            </form>
        </div>
    @else
        <p class="text-gray-600 mt-4">Keranjang kamu kosong</p>
    @endif
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.qty-input').on('input', function () {
            var qty = parseInt($(this).val());
            var harga = parseInt($(this).data('harga'));
            if (isNaN(qty) || qty < 1) qty = 1;

            var subtotal = qty * harga;
            var formattedSubtotal = 'Rp ' + subtotal.toLocaleString('id-ID');
            $(this).closest('tr').find('.item-total').text(formattedSubtotal);

            updateGrandTotal();
        });

        function updateGrandTotal() {
            var total = 0;
            $('.qty-input').each(function () {
                var qty = parseInt($(this).val());
                var harga = parseInt($(this).data('harga'));
                if (!isNaN(qty) && !isNaN(harga)) {
                    total += qty * harga;
                }
            });
            $('#grandTotal').text('Rp ' + total.toLocaleString('id-ID'));
        }
    });
</script>

</x-layout>
