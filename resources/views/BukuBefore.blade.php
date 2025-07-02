<x-layoutBefore>
    <x-slot:title> Media Cendekia Muslim</x-slot:title>

<div class="container mx-auto py-10">
        <!-- Header -->
    <!-- pencarian buku -->
        <div class="inline-flex space-x-4 items-center border border-gray-300 p-4 rounded-lg shadow-md mb-6">
            <div class="mb-2">
                <p class="text-indigo-600 mt-1">Cari buku berdasarkan harga:</p>
                <a href="/SearchBefore" class="mt-4 mb-6 w-auto bg-indigo-600 text-white py-3 px-6 rounded-lg hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all text-center block">
                    <h2>Cari</h2>
                </a>
            </div>

            <div class="mb-2">
                <p class="text-indigo-600 mt-1">Cari buku berdasarkan kategori:</p>
                <a href="/CariKategoriBefore" class="mt-4 mb-6 w-auto bg-indigo-600 text-white py-3 px-6 rounded-lg hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all text-center block">
                    <h2>Cari</h2>
                </a>
            </div>
        </div>

    <!-- pencarian buku akhir -->
        <div class="mb-6 mr-10">
            <h2 class="text-3xl font-bold text-gray-800">Daftar Buku Yang Tersedia</h2>
            <p class="text-gray-600 mt-1">Pilih buku yang ingin Anda beli.</p>
           
        </div>

    


      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @foreach($bukuList as $buku)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
            <div class="w-full h-48 bg-white flex items-center justify-center overflow-hidden">
                <img src="{{ asset('images/' . $buku->BUKU_GAMBAR) }}" alt="{{ $buku->BUKU_JUDUL }}" class="h-full object-contain p-2">
            </div>

            <div class="p-4">
                <h4 class="text-lg font-bold text-gray-800 truncate">{{ $buku->BUKU_JUDUL }}</h4>
                <p class="text-sm text-gray-600 mt-1">Penerbit: {{ $buku->penerbit->PENERBIT_NAMA ?? 'Tidak Ada' }}</p>
                <p class="text-sm text-green-600">Stok Buku: {{ $buku->stok }}</p>
                <p class="text-indigo-600 text-lg font-bold mt-2">Rp {{ number_format($buku->BUKU_HARGA, 0, ',', '.') }}</p>

                <div class="mt-3 flex justify-between items-center">
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
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white text-sm px-3 py-2 rounded">
                            + Keranjang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>

    </div>

    </x-layoutBefore>

<x-footer></x-footer>