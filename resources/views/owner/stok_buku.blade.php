@extends('layouts.layoutowner')

@section('title', 'Stok Buku')
@section('content')

<div class="container mx-auto px-4 mt-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">📚 Stok Buku</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-4 py-3 text-sm font-semibold text-left">No</th>
                    <th class="px-4 py-3 text-sm font-semibold text-left">ISBN</th>
                    <th class="px-4 py-3 text-sm font-semibold text-left">Judul</th>
                    <th class="px-4 py-3 text-sm font-semibold text-left">Tanggal Terbit</th>
                    <th class="px-4 py-3 text-sm font-semibold text-left">Jumlah Halaman</th>
                    <th class="px-4 py-3 text-sm font-semibold text-left">Harga</th>
                    <th class="px-4 py-3 text-sm font-semibold text-left">Stok</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse ($bukus as $buku)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{{ $buku->BUKU_ISBN }}</td>
                        <td class="px-4 py-3">{{ $buku->BUKU_JUDUL }}</td>
                        <td class="px-4 py-3">{{ $buku->BUKU_TGLTERBIT }}</td>
                        <td class="px-4 py-3">{{ $buku->BUKU_JMLHALAMAN }}</td>
                        <td class="px-4 py-3">Rp{{ number_format($buku->BUKU_HARGA, 0, ',', '.') }}</td>
                        <td class="px-4 py-3">{{ $buku->stok }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-gray-500 italic">Tidak ada data buku.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        <a href="{{ route('owner.dashboard') }}">
            <button type="button" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded shadow">
                ⬅ Kembali ke Dashboard
            </button>
        </a>
    </div>
</div>

@endsection
