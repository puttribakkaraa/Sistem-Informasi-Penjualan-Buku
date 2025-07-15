<div id="sidebar" class="fixed top-0 left-0 w-64 h-full bg-gradient-to-b from-blue-500 via-teal-500 to-blue-700 text-white z-50 shadow-lg transition-transform">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-500 to-teal-500 text-white p-6 text-center shadow-md">
        <i class="fas fa-book text-2xl mb-2"></i>
        <h1 class="text-lg font-bold mt-2">Media Cendekia Muslim</h1>
    </div>

    <!-- Navigation -->
    <nav class="mt-6 px-4 text-sm font-medium space-y-6">
        
        <!-- Layanan Utama -->
        <div>
            <h2 class="text-xs uppercase text-gray-200 mb-2 tracking-wider">Layanan Utama</h2>
            <ul class="space-y-1">
                <li>
                    <a href="{{ url('/HomeAdmin') }}"
                       class="flex items-center px-4 py-2 rounded-md transition hover:bg-blue-800 {{ request()->is('HomeAdmin') ? 'bg-blue-900' : '' }}">
                        <i class="fas fa-tachometer-alt mr-3 w-5"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ url('/buku') }}"
                       class="flex items-center px-4 py-2 rounded-md transition hover:bg-blue-800 {{ request()->is('buku') ? 'bg-blue-900' : '' }}">
                        <i class="fas fa-book-open mr-3 w-5"></i> Data Buku
                    </a>
                </li>
            </ul>
        </div>

        <!-- Manajemen Konten -->
        <div>
            <h2 class="text-xs uppercase text-gray-200 mb-2 tracking-wider">Manajemen Konten</h2>
            <ul class="space-y-1">
                <li>
                    <a href="{{ url('/kategori') }}"
                       class="flex items-center px-4 py-2 rounded-md transition hover:bg-blue-800 {{ request()->is('kategori') ? 'bg-blue-900' : '' }}">
                        <i class="fas fa-tags mr-3 w-5"></i> Kategori
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin/penerbit') }}"
                       class="flex items-center px-4 py-2 rounded-md transition hover:bg-blue-800 {{ request()->is('admin/penerbit') ? 'bg-blue-900' : '' }}">
                        <i class="fas fa-user-edit mr-3 w-5"></i> Penulis
                    </a>
                </li>
                <li>
                    <a href="{{ url('/pengarang') }}"
                       class="flex items-center px-4 py-2 rounded-md transition hover:bg-blue-800 {{ request()->is('pengarang') ? 'bg-blue-900' : '' }}">
                        <i class="fas fa-users mr-3 w-5"></i> Pengarang
                    </a>
                </li>
            </ul>
        </div>

        <!-- Transaksi -->
        <div>
            <h2 class="text-xs uppercase text-gray-200 mb-2 tracking-wider">Transaksi</h2>
            <ul class="space-y-1">
                <li>
                    <a href="{{ url('/pembelian/historyAdmin') }}"
                       class="flex items-center px-4 py-2 rounded-md transition hover:bg-blue-800 {{ request()->is('pembelian/historyAdmin') ? 'bg-blue-900' : '' }}">
                        <i class="fas fa-history mr-3 w-5"></i> Riwayat Pembelian
                    </a>
                </li>
            </ul>
        </div>

    </nav>
</div>
