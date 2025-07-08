<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Daftar Buku</h2>

        <!-- Tombol pencarian harga dan kategori -->
        <div class="flex flex-wrap gap-6 border border-gray-300 p-6 rounded-lg shadow-md mb-8 bg-white">
            <div class="flex-1 min-w-[200px]">
                <p class="text-indigo-600 font-semibold mb-2">Cari berdasarkan harga:</p>
                <a href="{{ route('form.search') }}"
                   class="w-full inline-block bg-indigo-600 text-white py-2 px-4 rounded-lg text-center hover:bg-indigo-700 transition-all">
                    Cari
                </a>
            </div>
            <div class="flex-1 min-w-[200px]">
                <p class="text-indigo-600 font-semibold mb-2">Cari berdasarkan kategori:</p>
                <a href="/CariKategori"
                   class="w-full inline-block bg-indigo-600 text-white py-2 px-4 rounded-lg text-center hover:bg-indigo-700 transition-all">
                    Cari
                </a>
            </div>
        </div>

        <!-- Search judul -->
        <form action="{{ route('buku.searchBinaryCustomer') }}" method="GET" class="mb-8">
            <div class="flex flex-wrap gap-4 items-center">
                <input type="text" name="q" placeholder="Cari judul buku..." required
                    class="flex-1 min-w-[200px] px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-md text-sm font-medium transition-all">
                    Cari
                </button>
            </div>
        </form>

        <!-- Daftar Buku -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($bukuList as $buku)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                    <div class="w-full h-48 bg-white flex items-center justify-center overflow-hidden">
                        <img src="{{ asset('images/' . $buku->BUKU_GAMBAR) }}"
                             alt="{{ $buku->BUKU_JUDUL }}"
                             class="h-full object-contain p-2">
                    </div>
                       
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-gray-800 truncate">{{ $buku->BUKU_JUDUL }}</h3>
                        <p class="text-sm text-gray-600 mt-1">Penulis: {{ $buku->penerbit->PENERBIT_NAMA ?? 'Tidak Ada' }}</p>
                        <p class="text-sm text-gray-500">Halaman: {{ $buku->BUKU_JMLHALAMAN }}</p>
                        <p class="text-sm text-gray-500">Stok: {{ $buku->stok }}</p>
                        <p class="text-indigo-600 text-lg font-bold mt-1">Rp {{ number_format($buku->BUKU_HARGA, 0, ',', '.') }}</p>
                         <a href="{{ route('buku.detail', $buku->BUKU_ISBN) }}" class="mt-3 block text-center bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm px-3 py-2 rounded">
        Lihat Detail
    </a>
                        <div class="mt-3 flex justify-between">
                            <a href="{{ route('pembelian.tampil', [
                                'judul_buku' => urlencode($buku->BUKU_JUDUL),
                                'isbn' => $buku->BUKU_ISBN,
                                'harga' => $buku->BUKU_HARGA,
                                'GAMBAR' => $buku->BUKU_GAMBAR
                            ]) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-3 py-2 rounded">
                                Beli
                            </a>

                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="buku_isbn" value="{{ $buku->BUKU_ISBN }}">
                                <input type="hidden" name="jumlah" value="1">
                                <button type="submit"
                                    class="bg-green-600 hover:bg-green-700 text-white text-sm px-3 py-2 rounded">
                                    + Keranjang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 col-span-full text-center">Buku tidak ditemukan.</p>
            @endforelse
        </div>
    </div>
</x-layout>
