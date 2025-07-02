@extends('layouts.layoutowner')

@section('title', 'Buku Terlaris')
@section('content')

    <div class="min-h-screen bg-gray-100 py-10 px-4">
        <div class="max-w-6xl mx-auto bg-white p-8 rounded-2xl shadow-xl">
            <h1 class="text-3xl font-bold text-gray-800 mb-8 flex items-center gap-2">
                <span>📚</span>
                Buku Terlaris
            </h1>

            <!-- Tabel Buku Terlaris -->
            <div class="overflow-x-auto rounded-xl shadow mb-10">
                <h2 class="text-xl font-semibold mb-4 text-gray-800">Daftar Buku Terlaris</h2>
                <table class="min-w-full table-auto border-collapse">
                    <thead class="bg-green-600 text-white text-sm">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left font-semibold uppercase tracking-wider">Judul Buku</th>
                            <th class="px-6 py-3 text-left font-semibold uppercase tracking-wider">Total Terjual</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm">
                        @forelse($bukuTerlaris as $item)
                            <tr class="{{ $loop->even ? 'bg-green-50' : 'bg-white' }} hover:bg-green-100 transition">
                                <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 font-medium">{{ $item->BUKU_JUDUL }}</td>
                                <td class="px-6 py-4">{{ $item->total_terjual }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada data penjualan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

                <!-- Grafik Penjualan -->
<div class="bg-white p-6 rounded-xl shadow">
    <h2 class="text-xl font-semibold mb-4 text-gray-800">Grafik Penjualan Buku</h2>
    <div class="flex justify-center">
        <div class="w-[300px] h-[300px]">
            <canvas id="bukuChart" class="w-full h-full"></canvas>
        </div>
       
    </div>
</div>
 <a href="{{ route('owner.dashboard') }}">
        <button type="button" class="mt-2 px-6 py-2 bg-green-500 text-white rounded hover:bg-gray-600 transition">
            Kembali
        </button>
    </a>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('bukuChart').getContext('2d');
        const chart = new Chart(ctx, {
    type: 'pie', // pie chart!
    data: {
        labels: {!! json_encode($bukuTerlaris->pluck('BUKU_JUDUL')) !!},
        datasets: [{
            label: 'Jumlah Terjual',
            data: {!! json_encode($bukuTerlaris->pluck('total_terjual')) !!},
            backgroundColor: [
                '#34D399', '#60A5FA', '#FBBF24', '#F87171', '#A78BFA', '#F472B6', '#38BDF8'
            ],
            borderWidth: 1,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
    }
});

    </script>


@endsection
