@extends('layouts.layoutowner')

@section('title', 'Laporan Penjualan')
@section('content')

<!-- Tambahkan gradasi ke background utama -->
<div class="min-h-screen bg-gradient-to-br from-blue-100 via-white to-green-100 py-10 px-4">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">📊 Detail Penjualan</h1>

        <!-- Filter Form -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <form method="GET" action="{{ route('owner.detail_penjualan') }}">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Dari Tanggal</label>
                        <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">Sampai Tanggal</label>
                        <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    </div>
                </div>

                <div class="flex flex-col md:flex-row justify-end items-center gap-4 mt-6">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition duration-200">
                        🔍 Filter
                    </button>
                    <a href="{{ route('owner.dashboard') }}" class="px-6 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition duration-200">
                        ⬅ Kembali
                    </a>
                </div>
            </form>
        </div>

        <!-- Ringkasan Penjualan -->
        <div class="bg-white p-6 rounded-lg shadow text-center">
            <p class="text-xl text-gray-700 mb-2">Total Transaksi:
                <span class="text-indigo-700 font-bold">{{ $totalTransaksi }}</span>
            </p>
            <p class="text-xl text-gray-700">Total Pendapatan:
                <span class="text-green-700 font-bold">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</span>
            </p>
        </div>
    </div>
</div>

@endsection
