<x-layout>
    <x-slot:title></x-slot:title>

    <div class="bg-gray-100 min-h-screen py-10">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-semibold text-center mb-8">
                Daftar Buku {{ $kategoriNama }}
            </h2>

            <!-- Form Filter Kategori -->
            <form method="GET" action="{{ route('CariKategori') }}" class="mb-8 flex justify-center">
                <div class="flex items-center space-x-4">
                    <label for="kategori_id" class="text-lg font-medium">Pilih Kategori:</label>
                    <select name="kat" id="kategori_id" class="border border-gray-300 rounded-md p-2">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->KATEGORI_ID }}"
                                {{ request('kat') == $kategori->KATEGORI_ID ? 'selected' : '' }}>
                                {{ $kategori->KATEGORI_NAMA }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                        Filter
                    </button>
                </div>
            </form>

            <!-- Daftar Buku -->
            @foreach($groupedBuku as $kategoriNama => $bukus)
                <h3 class="text-2xl font-semibold mt-10 mb-4">{{ $kategoriNama }}</h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($bukus as $buku)
                        <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition flex flex-col items-center text-center">
                            <!-- Gambar Buku -->
                            <div class="w-32 h-48 bg-gray-200 rounded-lg overflow-hidden mb-4">
                                <img src="{{ asset('images/' . $buku->BUKU_GAMBAR) }}"
                                     alt="Cover Buku"
                                     class="w-full h-full object-cover">
                            </div>

                            <!-- Detail Buku -->
                            <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $buku->BUKU_JUDUL }}</h3>
                            <p class="text-sm text-gray-600">ISBN: {{ $buku->BUKU_ISBN }}</p>
                            <p class="text-sm text-gray-600">Penerbit: {{ $buku->penerbit->PENERBIT_NAMA ?? 'Tidak diketahui' }}</p>
                            <p class="text-md text-gray-700 font-semibold mb-3">
                                Harga: Rp {{ number_format($buku->BUKU_HARGA, 0, "", ".") }},-
                            </p>

                            <!-- Tombol Beli -->
                            <a href="{{ route('pembelian.tampil', [
                                'judul_buku' => urlencode($buku->BUKU_JUDUL),
                                'isbn' => $buku->BUKU_ISBN,
                                'harga' => $buku->BUKU_HARGA
                            ]) }}"
                               class="bg-indigo-600 text-white text-center py-2 px-4 rounded hover:bg-indigo-700 w-full mb-2">
                                Beli
                            </a>

                            <!-- Form Keranjang -->
                            <form action="{{ route('cart.add') }}" method="POST" class="w-full">
                                @csrf
                                <input type="hidden" name="buku_isbn" value="{{ $buku->BUKU_ISBN }}">

                                <div class="flex flex-col items-center mb-2">
                                    <label for="jumlah_{{ $buku->BUKU_ISBN }}" class="text-sm font-medium mb-1">Jumlah:</label>
                                    <input type="number" name="jumlah" id="jumlah_{{ $buku->BUKU_ISBN }}" value="1" min="1"
                                           class="w-20 border border-gray-300 rounded px-2 py-1 text-center focus:ring focus:ring-green-400">
                                </div>

                                <button type="submit"
                                    class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded shadow-md">
                                    Tambah ke Keranjang
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</x-layout>
