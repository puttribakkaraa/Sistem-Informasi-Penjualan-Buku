<x-layoutBefore>
    <x-slot:title>Pustaka Bit</x-slot:title>

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
            <h2 class="text-3xl font-bold text-gray-800">Daftar Buku IT</h2>
            <p class="text-gray-600 mt-1">Pilih buku yang ingin Anda beli.</p>
           
        </div>

    


        <!-- Daftar Buku -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($bukuList as $buku)
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <img class="w-full h-48 object-cover" src="/images/buku.jpeg" alt="Cover Buku">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $buku->BUKU_JUDUL }}</h3>
                        <p class="text-gray-600 mt-1">Penerbit: {{ $buku->penerbit->PENERBIT_NAMA ?? 'Tidak Ada' }}</p>
                        <p class="text-gray-900 font-bold mt-2">Rp {{ number_format($buku->BUKU_HARGA, 0, ',', '.') }}</p>
                        <p class="text-gray-500 text-sm">Jumlah Halaman: {{ $buku->BUKU_JMLHALAMAN }}</p>
                        <a href="{{ route('pembelian.tampil', [
                            'judul_buku' => urlencode($buku->BUKU_JUDUL),
                            'isbn' => $buku->BUKU_ISBN,
                            'harga' => $buku->BUKU_HARGA
                        ]) }}" 
                           class="mt-4 w-full bg-indigo-600 text-white py-3 px-6 rounded-lg hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all text-center block">
                            Beli
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    </x-layoutBefore>

<x-footer></x-footer>