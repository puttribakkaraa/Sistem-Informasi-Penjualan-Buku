@extends('layouts.layoutowner')

@section('title', 'Laporan Penjualan')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-100 via-white to-green-100 py-12 px-6">
    <div class="max-w-6xl mx-auto space-y-8">

        <!-- Judul -->
        <div class="text-center">
            <h1 class="text-4xl font-bold text-gray-800 mb-2 tracking-tight">📈 Laporan Penjualan Buku</h1>
            <p class="text-gray-600 text-sm">Pantau performa penjualan dari waktu ke waktu</p>
        </div>

        <!-- Filter Tanggal -->
        <div class="bg-white shadow-md rounded-xl p-6">
            <form method="GET" action="{{ route('owner.detail_penjualan') }}" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">📅 Dari Tanggal</label>
                        <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring focus:ring-blue-200 focus:border-blue-500 shadow-sm">
                    </div>
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">📅 Sampai Tanggal</label>
                        <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring focus:ring-blue-200 focus:border-blue-500 shadow-sm">
                    </div>
                </div>

                <div class="flex flex-col md:flex-row justify-end items-center gap-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md shadow">
                        🔍 Tampilkan Data
                    </button>
                    <a href="{{ route('owner.dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-md shadow">
                        ⬅ Kembali ke Dashboard
                    </a>
                </div>
            </form>
        </div>

        <!-- Ringkasan Penjualan -->
        <div class="bg-white rounded-xl shadow-md p-6 text-center space-y-4">
            <div>
                <p class="text-lg text-gray-600">📦 Total Transaksi</p>
                <h2 class="text-2xl font-bold text-indigo-700">{{ $totalTransaksi }}</h2>
            </div>
            <div>
                <p class="text-lg text-gray-600">💰 Total Pendapatan</p>
                <h2 class="text-2xl font-bold text-green-700">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h2>
            </div>
        </div>

    </div>
</div>
@endsection
