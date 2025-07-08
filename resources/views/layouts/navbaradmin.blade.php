<div id="sidebar" class="fixed top-0 left-0 w-64 h-full bg-gradient-to-b from-blue-500 via-teal-500 to-blue-700 text-white z-50 transition-transform shadow-lg">
    <!-- Judul Sidebar -->
    <div class="bg-gradient-to-r from-blue-500 to-teal-500 text-white p-6 rounded-b-lg shadow-md text-center">
        <i class="fas fa-book"></i> <span class="font-bold">Media Cendekia Muslim</span>
    </div>

    <!-- Navigasi -->
    <ul class="mt-4 space-y-2 px-4">
        <li>
            <a href="{{ url('/HomeAdmin') }}" class="block px-4 py-2 rounded hover:bg-blue-800 {{ request()->is('HomeAdmin') ? 'bg-blue-900' : '' }}">
                <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="{{ url('/buku') }}" class="block px-4 py-2 rounded hover:bg-blue-800">
                <i class="fas fa-book-open mr-2"></i> Data Buku
            </a>
        </li>
        <li>
            <a href="{{ url('/kategori') }}" class="block px-4 py-2 rounded hover:bg-blue-800">
                <i class="fas fa-tags mr-2"></i> Kategori
            </a>
        </li>
        <li>
            <a href="{{ url('/admin/penerbit') }}" class="block px-4 py-2 rounded hover:bg-blue-800">
                <i class="fas fa-user-edit mr-2"></i> Penulis
            </a>
        </li>
        <li>
            <a href="{{ url('/pengarang') }}" class="block px-4 py-2 rounded hover:bg-blue-800">
                <i class="fas fa-users mr-2"></i> Pengarang
            </a>
        </li>
        <li>
            <a href="{{ url('/pembelian/historyAdmin') }}" class="block px-4 py-2 rounded hover:bg-blue-800">
                <i class="fas fa-history mr-2"></i> Riwayat Pembelian
            </a>
        </li>
    </ul>
</div>
