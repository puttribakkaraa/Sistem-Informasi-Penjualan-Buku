<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <!-- Header Selamat Datang -->
    <div class="bg-gradient-to-r from-blue-500 to-teal-500 text-white p-6 rounded-lg shadow-lg text-center mb-6">
        <h1 class="text-3xl font-semibold">
            Hai <span class="font-extrabold">{{ auth()->check() ? auth()->user()->name : 'Pengunjung' }}</span>,
        </h1>
        <p class="mt-2 text-lg">Selamat datang di Media Cendekia Muslim, tempat belanja buku terbaik!</p>
    </div>

    <!-- Image Slider -->
    <div id="default-carousel" class="relative w-full mb-6" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
            @for ($i = 1; $i <= 6; $i++)
                <div class="{{ $i === 1 ? 'block' : 'hidden' }} duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('images/kegiatan' . $i . '.jpg') }}"
                         class="absolute block w-full h-full object-cover"
                         alt="Slide {{ $i }}">
                </div>
            @endfor
        </div>

        <!-- Slider controls -->
        <button type="button"
                class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-prev>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 6 10">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                </svg>
            </span>
        </button>
        <button type="button"
                class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-next>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 6 10">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 9l4-4-4-4"/>
                </svg>
            </span>
        </button>
    </div>

    <!-- PENTING! Tambahkan Script Flowbite -->
    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    @endpush

    <!-- Buku Terbitan Terbaru -->
    <div class="mt-10">
        <h3 class="text-2xl font-semibold mb-4">Buku Terbitan Terbaru</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($books as $book)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
              <div class="w-full h-48 bg-white flex items-center justify-center overflow-hidden">
    <img src="{{ asset('images/' . $book->BUKU_GAMBAR) }}" alt="{{ $book->BUKU_JUDUL }}" class="h-full object-contain p-2">
</div>


                <div class="p-4">
    <h4 class="text-lg font-bold text-gray-800 truncate">{{ $book->BUKU_JUDUL }}</h4>
    <p class="text-sm text-gray-600 mt-1">Penerbit: {{ $book->penerbit->PENERBIT_NAMA }}</p>
    <p class="text-sm text-green-600">Stok Tersedia</p>

    <p class="text-indigo-600 text-lg font-bold">Rp {{ number_format($book->BUKU_HARGA, 0, ',', '.') }}</p>

    <!-- Lihat Detail dipisahkan dan diletakkan di bawah harga -->
    <a href="{{ route('buku.detail', $book->BUKU_ISBN) }}" class="mt-3 block text-center bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm px-3 py-2 rounded">
        Lihat Detail
    </a>

    <!-- Tombol Beli dan Keranjang dikelompokkan di bawahnya -->
    <div class="mt-3 flex justify-between">
        <a href="{{ route('pembelian.tampil', [
            'judul_buku' => urlencode($book->BUKU_JUDUL),
            'isbn' => $book->BUKU_ISBN,
            'harga' => $book->BUKU_HARGA,
            'GAMBAR' => $book->BUKU_GAMBAR
        ]) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-3 py-2 rounded">
            Beli
        </a>

        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="buku_isbn" value="{{ $book->BUKU_ISBN }}">
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
</x-layout>

