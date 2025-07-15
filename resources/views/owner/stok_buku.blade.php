@extends('layouts.layoutowner')

@section('title', 'Stok Buku')

@section('content')
<div class="container mx-auto px-4 mt-10">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">📚 Stok Buku</h2>

        <!-- Tabel Stok Buku -->
        <div class="overflow-x-auto rounded-xl shadow mb-6">
            <table class="min-w-full table-auto border-collapse">
                <thead class="bg-green-600 text-white text-sm uppercase">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold tracking-wider">No</th>
                        <th class="px-6 py-3 text-left font-semibold tracking-wider">ISBN</th>
                        <th class="px-6 py-3 text-left font-semibold tracking-wider">Judul</th>
                        <th class="px-6 py-3 text-left font-semibold tracking-wider">Tanggal Terbit</th>
                        <th class="px-6 py-3 text-left font-semibold tracking-wider">Halaman</th>
                        <th class="px-6 py-3 text-left font-semibold tracking-wider">Harga</th>
                        <th class="px-6 py-3 text-left font-semibold tracking-wider">Stok</th>
                    </tr>
                </thead>
                <tbody class="text-gray-800 text-sm">
                    @forelse ($bukus as $buku)
                        <tr class="{{ $loop->even ? 'bg-green-50' : 'bg-white' }} hover:bg-green-100 transition">
                            <td class="px-6 py-4">{{ $loop->iteration + ($bukus->currentPage() - 1) * $bukus->perPage() }}</td>
                            <td class="px-6 py-4">{{ $buku->BUKU_ISBN }}</td>
                            <td class="px-6 py-4 font-medium">{{ $buku->BUKU_JUDUL }}</td>
                            <td class="px-6 py-4">{{ $buku->BUKU_TGLTERBIT }}</td>
                            <td class="px-6 py-4">{{ $buku->BUKU_JMLHALAMAN }}</td>
                            <td class="px-6 py-4">Rp{{ number_format($buku->BUKU_HARGA, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">{{ $buku->stok }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada data buku.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination + Jumlah Per Halaman -->
        <div class="flex items-center justify-between mt-6">
            <div>
                <label class="text-sm text-gray-600">Tampilkan:</label>
                <select onchange="location.href='?perPage='+this.value" class="border rounded px-2 py-1 text-sm">
                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20</option>
                    <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                     <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>100</option>
                      <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>200</option>
                </select>
                <span class="ml-2 text-sm text-gray-500">data per halaman</span>
            </div>

            <div>
                {{ $bukus->appends(['perPage' => request('perPage')])->links() }}
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="mt-6 text-right">
            <a href="{{ route('owner.dashboard') }}">
                <button type="button" class="inline-flex items-center px-5 py-2 bg-green-600 text-white text-sm font-medium rounded-md hover:bg-green-700 shadow">
                    ⬅ Kembali ke Dashboard
                </button>
            </a>
        </div>
    </div>
</div>
@endsection
