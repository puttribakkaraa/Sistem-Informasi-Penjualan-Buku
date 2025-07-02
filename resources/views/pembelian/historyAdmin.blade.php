@extends('layouts.layoutadmin')

@section('title', 'Hai Admin')

@section('content')
<div class="container mx-auto mt-10 px-4">
    <div class="mb-6">
        <h2 class="text-3xl font-semibold text-gray-800">Riwayat Pembelian Semua Pengguna</h2>
        <p class="text-gray-600 mt-2">Berikut adalah daftar pembelian yang telah dilakukan oleh semua pengguna.</p>
    </div>

    <h3 class="text-lg font-semibold text-gray-700 mb-2">Tabel Riwayat Pembelian</h3>
    <div class="overflow-x-auto mt-6 bg-white shadow-lg rounded-lg border border-gray-200">
        <table class="min-w-full table-auto">
            <thead class="bg-indigo-600 text-white">
                <tr>
                    <th class="py-3 px-6 text-sm font-medium text-left">No</th>
                    <th class="py-3 px-6 text-sm font-medium text-left">Nama Pembeli</th>
                    <th class="py-3 px-6 text-sm font-medium text-left">Judul Buku</th>
                    <th class="py-3 px-6 text-sm font-medium text-left">Jumlah Item</th>
                    <th class="py-3 px-6 text-sm font-medium text-left">Alamat</th>
                    <th class="py-3 px-6 text-sm font-medium text-left">Harga Satuan</th>
                    <th class="py-3 px-6 text-sm font-medium text-left">Total Harga</th>
                    <th class="py-3 px-6 text-sm font-medium text-left">Status Pesanan</th>
                    <th class="py-3 px-6 text-sm font-medium text-left">Aksi</th>
                    <th class="py-3 px-6 text-sm font-medium text-left">Bukti Pembayaran</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($pembelianList as $index => $pembelian)
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-6 text-sm text-gray-700">{{ $index + 1 }}</td>
                        <td class="py-3 px-6 text-sm text-gray-700">{{ $pembelian->NAMA_PEMBELI }}</td>
                        <td class="py-3 px-6 text-sm text-gray-700">{{ $pembelian->BUKU_JUDUL }}</td>
                        <td class="py-3 px-6 text-sm text-gray-700">{{ $pembelian->JUMLAH_ITEM }}</td>
                        <td class="py-3 px-6 text-sm text-gray-700">{{ $pembelian->ALAMAT }}</td>
                        <td class="py-3 px-6 text-sm text-gray-700">Rp {{ number_format($pembelian->BUKU_HARGA, 0, ',', '.') }}</td>
                        <td class="py-3 px-6 text-sm text-gray-700">Rp {{ number_format($pembelian->TOTAL_HARGA, 0, ',', '.') }}</td>
                        <td class="py-3 px-6 text-sm text-gray-700">
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold 
                                @if($pembelian->status_pesanan == 'diproses') bg-yellow-200 text-yellow-800 
                                @elseif($pembelian->status_pesanan == 'dikirim') bg-blue-600 text-white 
                                @elseif($pembelian->status_pesanan == 'ditolak') bg-red-600 text-white 
                                @elseif($pembelian->status_pesanan == 'selesai') bg-black-600 text-white 
                                @else bg-gray-200 text-gray-800 
                                @endif">
                                {{ $pembelian->status_pesanan }}
                            </span>
                        </td>
                        <td class="py-3 px-6 text-sm text-gray-700">
                            <form action="{{ route('pembelian.updateStatus', $pembelian->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status_pesanan" class="py-1 px-3 border border-gray-300 rounded-md text-sm">
                                    <option value="diproses" {{ $pembelian->status_pesanan == 'diproses' ? 'selected' : '' }}>Memproses Pesanan</option>
                                    <option value="dikirim" {{ $pembelian->status_pesanan == 'dikirim' ? 'selected' : '' }}>Pesanan Dikirim</option>
                                    <option value="ditolak" {{ $pembelian->status_pesanan == 'ditolak' ? 'selected' : '' }}>Pesanan Ditolak</option>
                                    <option value="selesai" {{ $pembelian->status_pesanan == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                                <button type="submit" class="mt-2 text-white bg-indigo-600 px-3 py-1 rounded-md">Update</button>
                            </form>
                        </td>
                        <td class="py-3 px-6 text-sm text-gray-700">
                        @if($pembelian->BUKTI_PEMBAYARAN)
                           <img src="{{ asset('storage/' . $pembelian->BUKTI_PEMBAYARAN) }}"
                            alt="Bukti Pembayaran"
                            class="h-16 w-auto rounded shadow cursor-pointer hover:scale-105 transition-transform duration-200"
                            onclick="openModal('{{ asset('storage/' . $pembelian->BUKTI_PEMBAYARAN) }}')">

                        @else
                            <span class="text-red-500">No image</span>
                        @endif
                    </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($pembelianList->isEmpty())
        <div class="mt-4 p-4 bg-gray-100 text-center text-gray-600 rounded-lg shadow-md">
            Tidak ada riwayat pembelian.
        </div>
    @endif
</div>

        <!-- Modal untuk Menampilkan Gambar Besar -->
        <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
            <div class="relative bg-white rounded-lg p-4 shadow-xl max-w-fit">
                <button class="absolute -top-3 -right-3 bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center" onclick="closeModal()">×</button>
                <img id="modalImage" src="" alt="Bukti Pembayaran" class="max-w-md max-h-[80vh] object-contain rounded">
            </div>
        </div>


<!-- Script untuk Modal -->
<script>
    function openModal(imageUrl) {
        document.getElementById('imageModal').classList.remove('hidden');
        document.getElementById('modalImage').src = imageUrl;
    }

    function closeModal() {
        document.getElementById('imageModal').classList.add('hidden');
    }
</script>
@endsection
