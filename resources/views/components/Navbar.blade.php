<nav class="bg-white shadow-md border-b" x-data="{ isOpen: false, showDropdown: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
        
        <!-- Kiri: Logo & Menu Navigasi -->
        <div class="flex items-center space-x-8">
            <!-- Logo -->
            <div class="flex flex-col items-center">
                <img src="/images/logomcm.jpg" alt="Logo MCM" class="h-10 w-auto">
                <span class="text-[10px] text-blue-500 -mt-1">publishing</span>
            </div>

            <!-- Menu Navigasi -->
            <div class="hidden md:flex space-x-5 text-sm font-semibold text-black">
                <x-Nav-Link href="/Home" :active="request()->is('Home')">Beranda</x-Nav-Link>
                <x-Nav-Link href="/Buku" :active="request()->is('Buku')">Katalog Buku</x-Nav-Link>
                <x-Nav-Link href="/kirim-naskah" :active="request()->is('kirim-naskah')">Kirim Naskah</x-Nav-Link>
                <x-Nav-Link href="/akademi" :active="request()->is('akademi')">Akademi MCM</x-Nav-Link>
                <x-Nav-Link href="/pembelian/history" :active="request()->is('akademi')">Riwayat Pembelian</x-Nav-Link>
            </div>
        </div>

        <!-- Kanan: Ikon & Profil -->
        <div class="flex items-center space-x-6">
            
            <!-- Notifikasi -->
            <a href="/notifikasi" class="relative hover:scale-105 transition-transform">
                <img src="/images/bel.png" alt="Notifikasi" class="h-6 w-6">
                <!-- Indikator notifikasi -->
                <span class="absolute top-0 right-0 inline-block w-2 h-2 bg-red-500 rounded-full"></span>
            </a>

            <!-- Keranjang -->
            <a href="/cart" class="relative hover:scale-105 transition-transform">
                <img src="/images/iya.png" alt="Keranjang" class="h-4 w-4">
                <!-- Indikator jumlah item keranjang, opsional -->
                {{-- <span class="absolute top-0 right-0 bg-red-600 text-white text-xs rounded-full px-1">3</span> --}}
            </a>

            <!-- Profil Dropdown -->
            <div class="relative" x-data="{ isOpen: false }">
                <button @click="isOpen = !isOpen"
                        class="flex items-center rounded-full p-1 hover:bg-gray-100 focus:outline-none">
                    <img class="h-8 w-8 rounded-full" src="/images/hamburger.png" alt="User">
                </button>

                <!-- Menu Dropdown -->
                <div x-show="isOpen" @click.away="isOpen = false" x-transition
                     class="absolute right-0 mt-2 w-48 bg-white border rounded-md shadow-lg z-50">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="block w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-gray-100">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
