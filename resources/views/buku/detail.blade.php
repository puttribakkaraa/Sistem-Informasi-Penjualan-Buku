<x-layout :title="$buku->BUKU_JUDUL">
    <div class="max-w-6xl mx-auto bg-white p-8 rounded-lg shadow mt-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Gambar Buku -->
            <div class="flex justify-center">
                <img src="{{ asset('images/' . $buku->BUKU_GAMBAR) }}"
                     alt="{{ $buku->BUKU_JUDUL }}"
                     class="w-full max-w-xs object-contain rounded shadow">
            </div>

            <!-- Informasi Buku -->
            <div class="flex flex-col justify-between">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800">{{ $buku->BUKU_JUDUL }}</h2>
                    <p class="text-xl text-gray-900 mt-2">Rp {{ number_format($buku->BUKU_HARGA, 0, ',', '.') }}</p>
                    <p class="text-sm text-gray-600 mt-2">Stok: Tersedia</p>
                    <p class="text-sm text-gray-600 mt-4"><strong>Penulis:</strong> {{ $buku->penerbit->PENERBIT_NAMA }}</p>
                    <p class="text-sm text-gray-600"><strong>ISBN:</strong> {{ $buku->BUKU_ISBN }}</p>
                    <p class="text-sm text-gray-600"><strong>Tanggal Terbit:</strong> {{ $buku->BUKU_TGLTERBIT }}</p>
                </div>

                <!-- Tombol Aksi -->
                <div class="mt-6">
                    <form action="{{ route('cart.add') }}" method="POST" class="flex items-center gap-4 mb-4">
                        @csrf
                        <input type="hidden" name="buku_isbn" value="{{ $buku->BUKU_ISBN }}">
                        <input type="hidden" name="jumlah" value="1">
                        <span class="text-base font-semibold">
                            Total: Rp {{ number_format($buku->BUKU_HARGA, 0, ',', '.') }}
                        </span>
                        <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-white font-semibold px-5 py-2 rounded-full">
                            Beli Sekarang
                        </button>
                    </form>
                    <a href="{{ url()->previous() }}" class="text-indigo-500 hover:underline text-sm">← Kembali</a>
                </div>
            </div>
        </div>

      <!-- Form Ulasan -->
<div class="mt-12 max-w-lg mx-auto bg-gray-50 p-6 rounded-xl shadow">
    <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">Tulis Ulasan</h3>
    <form action="{{ route('ulasan.store') }}" method="POST">
        @csrf
        <input type="hidden" name="BUKU_ISBN" value="{{ $buku->BUKU_ISBN }}">

        <textarea name="isi_ulasan" rows="4" class="w-full p-3 border rounded mb-4" placeholder="Tulis ulasan kamu di sini..." required></textarea>

        <!-- Rating Bintang -->
       <div x-data="{ rating: 0 }" class="flex items-center gap-3 mb-4">
    <span class="text-gray-700 font-medium">Kasih Bintang:</span>
    
    <div class="flex gap-1">
        @for ($i = 1; $i <= 5; $i++)
            <label>
                <input type="radio" name="rating" value="{{ $i }}" class="hidden" x-model="rating" required>
                <span 
                    :class="rating >= {{ $i }} ? 'text-yellow-400' : 'text-gray-300'" 
                    @click="rating = {{ $i }}" 
                    class="text-2xl cursor-pointer">★</span>
            </label>
        @endfor
    </div>
</div>


        <div class="flex justify-center">
            <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">
                Kirim Ulasan
            </button>
        </div>
    </form>
</div>

       <!-- Daftar Ulasan -->
<div class="mt-10">
    <h3 class="text-xl font-bold text-gray-800 mb-4">Ulasan Pembeli</h3>

    @if($buku->ulasan->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($buku->ulasan as $ulasan)
                <div class="bg-white border rounded-xl shadow p-4 flex flex-col justify-between h-52">
                    <div>
                        <p class="font-semibold text-gray-800 mb-1">{{ $ulasan->user->name }}</p>
                        
                        <!-- Bintang -->
                        <div class="flex items-center gap-1 text-yellow-400 text-lg mb-2">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $ulasan->rating)
                                    <span>★</span>
                                @else
                                    <span class="text-gray-300">★</span>
                                @endif
                            @endfor
                        </div>

                        <p class="text-gray-700 text-sm line-clamp-4">{{ $ulasan->isi_ulasan }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500">Belum ada ulasan.</p>
    @endif
</div>


        <!-- Rekomendasi Buku Sejenis -->
        @if($rekomendasi->count())
            <div class="mt-12">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Rekomendasi Buku Sejenis</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($rekomendasi as $item)
                        <div class="bg-white rounded-lg shadow hover:shadow-md transition overflow-hidden">
                            <img src="{{ asset('images/' . $item->BUKU_GAMBAR) }}" alt="{{ $item->BUKU_JUDUL }}" class="h-40 w-full object-contain p-2 bg-white">
                            <div class="p-4">
                                <h4 class="font-semibold text-sm text-gray-800 truncate">{{ $item->BUKU_JUDUL }}</h4>
                                <p class="text-sm text-gray-600 mt-1">Rp {{ number_format($item->BUKU_HARGA, 0, ',', '.') }}</p>
                                <a href="{{ route('buku.detail', $item->BUKU_ISBN) }}" class="inline-block mt-3 text-indigo-600 text-sm hover:underline">
                                    Lihat Detail →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-layout>
