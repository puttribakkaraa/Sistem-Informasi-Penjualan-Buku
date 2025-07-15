<x-layoutBefore>
    <x-slot:title>Media Cendekia Muslim</x-slot:title>

    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-500 to-teal-500 text-white p-6 rounded-lg shadow-lg text-center mb-6">
        <h1 class="text-3xl font-semibold">
           Selamat Datang! <span class="font-extrabold">Pengunjung</span>, 
        </h1>
        <p class="mt-2 text-lg">Selamat datang di Media Cendekia Muslim!!</p>
    </div>

    <!-- Image Slider -->
    <div id="gallery" class="relative w-full mb-6" data-carousel="slide">
    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
        @for ($i = 1; $i <= 6; $i++)
            <div class="absolute top-0 {{ $i === 1 ? 'left-0' : 'left-full' }} w-full h-full duration-700 ease-in-out" data-carousel-item>
                <img src="{{ asset("images/kegiatan{$i}.jpg") }}" alt="Kegiatan {{ $i }}" class="w-full h-full object-cover rounded">
            </div>
        @endfor
    </div>
</div>


        <!-- Controls -->
        <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white">
                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 6 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/></svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white">
                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 6 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/></svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>

    <!-- Carousel JS -->
    <script>
        const prev = document.querySelector('[data-carousel-prev]');
        const next = document.querySelector('[data-carousel-next]');
        const items = document.querySelectorAll('[data-carousel-item]');
        let currentIndex = 0;

        function showNextItem() {
            items[currentIndex].classList.remove('left-0');
            items[currentIndex].classList.add('left-full');
            currentIndex = (currentIndex + 1) % items.length;
            items[currentIndex].classList.remove('left-full');
            items[currentIndex].classList.add('left-0');
        }

        function showPrevItem() {
            items[currentIndex].classList.remove('left-0');
            items[currentIndex].classList.add('left-full');
            currentIndex = (currentIndex - 1 + items.length) % items.length;
            items[currentIndex].classList.remove('left-full');
            items[currentIndex].classList.add('left-0');
        }

        prev.addEventListener('click', showPrevItem);
        next.addEventListener('click', showNextItem);
        setInterval(showNextItem, 3000);
    </script>

    <!-- Dashboard Cards -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 mb-10">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-semibold text-blue-600">Total Buku</h3>
            <p class="text-4xl font-bold mt-2">{{ $totalBuku }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-semibold text-purple-600">Total Kategori</h3>
            <p class="text-4xl font-bold mt-2">{{ $totalKategori }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-semibold text-green-600">Total Penulis</h3>
            <p class="text-4xl font-bold mt-2">{{ $totalPenerbit }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-semibold text-red-600">Total Penjualan</h3>
            <p class="text-4xl font-bold mt-2">{{ $totalPembelian }}</p>
        </div>
    </div>

    <!-- Tabel Buku Terbaru -->
    <div class="mt-10 bg-white shadow rounded-lg overflow-hidden">
        <h3 class="text-2xl font-semibold p-6">Buku Terbitan Terbaru</h3>
        <table class="w-full">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="py-3 px-4 text-left">Judul Buku</th>
                    <th class="py-3 px-4 text-left">Penerbit</th>
                    <th class="py-3 px-4 text-left">Tanggal Terbit</th>
                    <th class="py-3 px-4 text-left">Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="py-3 px-4">{{ $book->BUKU_JUDUL }}</td>
                        <td class="py-3 px-4">{{ $book->penerbit->PENERBIT_NAMA }}</td>
                        <td class="py-3 px-4">{{ $book->BUKU_TGLTERBIT }}</td>
                        <td class="py-3 px-4">Rp {{ number_format($book->BUKU_HARGA, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('popup'))
<script>
    Swal.fire({
        title: 'Halo!',
        text: "{{ session('popup') }}",
        icon: 'info',
        confirmButtonText: 'Oke'
    });
</script>
@endif

</x-layoutBefore>

<x-footer />
