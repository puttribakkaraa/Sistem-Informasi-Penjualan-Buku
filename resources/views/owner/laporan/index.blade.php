@extends('layouts.layoutowner')

@section('title', 'Laporan Penjualan')
<div class="max-w-7xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Laporan Penjualan</h2>

    <a href="{{ route('laporan.cetak') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md mb-4 inline-block">
        Download PDF
    </a>

    <table class="w-full table-auto border">
        <thead class="bg-gray-200">
            <tr>
                <th class="border px-4 py-2">Tanggal</th>
                <th class="border px-4 py-2">Judul Buku</th>
                <th class="border px-4 py-2">Jumlah</th>
                <th class="border px-4 py-2">Total Harga</th>
                <th class="border px-4 py-2">Pembeli</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $p)
            <tr>
                <td class="border px-4 py-2">{{ $p->created_at->format('d M Y') }}</td>
                <td class="border px-4 py-2">{{ $p->BUKU_JUDUL }}</td>
                <td class="border px-4 py-2">{{ $p->JUMLAH_ITEM }}</td>
                <td class="border px-4 py-2">Rp{{ number_format($p->TOTAL_HARGA, 0, ',', '.') }}</td>
                <td class="border px-4 py-2">{{ $p->NAMA_PEMBELI }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
