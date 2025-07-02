@extends('layouts.layoutadmin')

@section('content')
    <!-- Welcome Message -->
    <div class="bg-gradient-to-r from-blue-500 to-teal-500 text-white p-6 rounded-lg shadow-lg text-center mb-6">
        <h1 class="text-3xl font-semibold">
            Selamat Datang,<span class="font-extrabold">Admin</span>
        </h1>
        <p class="mt-2 text-lg">Tetap semangat menjalani hari ini!</p>
    </div>

    <!-- Statistik -->
    <div class="mb-10">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">Informasi Toko</h2>
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
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
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-xl font-semibold text-indigo-600">Total Pengarang</h3>
                <p class="text-4xl font-bold mt-2">{{ $totalPengarang }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-xl font-semibold text-teal-600">Total Pengguna</h3>
                <p class="text-4xl font-bold mt-2">{{ $totalUser }}</p>
            </div>
        </div>
    </div>
@endsection
