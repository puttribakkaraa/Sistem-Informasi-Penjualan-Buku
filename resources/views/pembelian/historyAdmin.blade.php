@extends('layouts.layoutadmin')

@section('title', 'Hai Admin')

@section('content')
<div class="container mx-auto mt-10 px-4">
    <div class="mb-6">
        <h2 class="text-3xl font-semibold text-gray-800">Riwayat Pembelian Semua Pengguna</h2>
        <p class="text-gray-600 mt-2">Berikut adalah daftar pembelian yang telah dilakukan oleh semua pengguna.</p>
    </div>

  
<form method="GET" class="flex flex-wrap gap-2 items-center">
    <label for="perPage" class="text-sm text-gray-700">Tampilkan</label>
    <select name="perPage" id="perPage" onchange="this.form.submit()" class="text-sm border-gray-300 rounded px-2 py-1">
        <option value="5" {{ request('perPage') == 5 ? 'selected' : '' }}>5</option>
        <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
        <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
        <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
        <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100</option>
    </select>
    <span class="text-sm text-gray-700">data / halaman</span>

    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama/judul..." class="border rounded px-2 py-1 text-sm">

    <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded text-sm">Cari</button>

    <a href="{{ route('pembelian.historyAdmin') }}" class="text-sm text-blue-600 hover:underline ml-2">Reset</a>
</form>

    <!-- Table -->
    <div class="overflow-x-auto bg-white shadow-lg rounded-lg border border-gray-200">
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
                @forelse($pembelianList as $index => $pembelian)
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-6 text-sm text-gray-700">
                            {{ ($pembelianList->currentPage() - 1) * $pembelianList->perPage() + $index + 1 }}
                        </td>
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
                                @elseif($pembelian->status_pesanan == 'selesai') bg-green-600 text-white
                                @else bg-gray-200 text-gray-800 @endif">
                                {{ ucfirst($pembelian->status_pesanan) }}
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
                                <input type="hidden" name="alasan_penolakan" id="catatanInput-{{ $pembelian->id }}">

<button type="button" onclick="handleStatusUpdate({{ $pembelian->id }})" class="mt-2 text-white bg-indigo-600 px-3 py-1 rounded-md">Update</button>

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
                @empty
                    <tr>
                        <td colspan="10" class="py-4 px-6 text-center text-gray-600">Tidak ada riwayat pembelian.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $pembelianList->appends(['perPage' => request('perPage')])->links('vendor.pagination.tailwind') }}
        </div>
    </div>
</div>

<!-- Modal untuk Menampilkan Gambar Besar -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
    <div class="relative bg-white rounded-lg p-4 shadow-xl max-w-fit">
        <button class="absolute -top-3 -right-3 bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center" onclick="closeModal()">×</button>
        <img id="modalImage" src="" alt="Bukti Pembayaran" class="max-w-md max-h-[80vh] object-contain rounded">
    </div>
</div>

<!-- Script Modal -->
<script>
    function openModal(imageUrl) {
        document.getElementById('imageModal').classList.remove('hidden');
        document.getElementById('modalImage').src = imageUrl;
    }

    function closeModal() {
        document.getElementById('imageModal').classList.add('hidden');
    }
</script>
<script>
    function handleStatusUpdate(pembelianId) {
        const form = document.querySelector(`form[action*="${pembelianId}"]`);
        const selectedStatus = form.querySelector('select[name="status_pesanan"]').value;

        if (selectedStatus === 'ditolak') {
            Swal.fire({
                title: 'Alasan Penolakan',
                input: 'textarea',
                inputLabel: 'Tulis alasan penolakan pesanan:',
                inputPlaceholder: 'Contoh: Alamat tidak lengkap atau stok habis...',
                showCancelButton: true,
                confirmButtonText: 'Kirim',
                cancelButtonText: 'Batal',
                inputValidator: (value) => {
                    if (!value) {
                        return 'Alasan wajib diisi!';
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`catatanInput-${pembelianId}`).value = result.value;
                    form.submit();
                }
            });
        } else {
            form.submit();
        }
    }
</script>

@endsection
