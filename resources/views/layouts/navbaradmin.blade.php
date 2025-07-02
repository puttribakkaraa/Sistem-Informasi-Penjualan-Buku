<div id="sidebar" class="fixed top-0 left-0 w-64 h-full bg-green-800 text-white z-50 transition-transform">
    <div class="p-4 text-2xl font-bold border-b border-white">
        <i class="fas fa-book"></i> Media Cendekia Muslim
    </div>
    <ul class="mt-4 space-y-2">
        <li><a href="{{ url('/HomeAdmin') }}" class="block px-4 py-2 hover:bg-green-700 {{ request()->is('HomeAdmin') ? 'bg-green-900' : '' }}">Dashboard</a></li>
        <li><a href="{{ url('/buku') }}" class="block px-4 py-2 hover:bg-green-700">Data Buku</a></li>
        <li><a href="{{ url('/kategori') }}" class="block px-4 py-2 hover:bg-green-700">Kategori</a></li>
        <li><a href="{{ url('/admin/penerbit') }}" class="block px-4 py-2 hover:bg-green-700">Penulis</a></li>
        <li><a href="{{ url('/pengarang') }}" class="block px-4 py-2 hover:bg-green-700">Pengarang</a></li>
        <li><a href="{{ url('/pembelian/historyAdmin') }}" class="block px-4 py-2 hover:bg-green-700">Riwayat Pembelian</a></li>
    </ul>
</div>

