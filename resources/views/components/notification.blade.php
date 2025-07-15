@props(['notification'])

@php
    $status = $notification->data['status'] ?? 'diproses';
    $pesanan = $notification->data['pesanan'] ?? null;
    $alasan = null;

    if ($status === 'ditolak' && isset($notification->data['pesan'])) {
        // Cari dan ambil alasan dari pesan, jika ada
        preg_match('/Alasan penolakan: (.+)$/', $notification->data['pesan'], $matches);
        $alasan = $matches[1] ?? null;
    }

    $warna = match($status) {
        'diproses' => 'bg-yellow-100 border-yellow-400 text-yellow-800',
        'dikirim' => 'bg-blue-100 border-blue-400 text-blue-800',
        'ditolak' => 'bg-red-100 border-red-400 text-red-800',
        'selesai' => 'bg-black-100 border-green-400 text-green-800',
        default => 'bg-gray-100 border-gray-400 text-gray-800',
    };

    $icon = match($status) {
        'diproses' => '⏳',
        'dikirim' => '🚚',
        'ditolak' => '❌',
        'selesai' => '✅',
        default => 'ℹ️',
    };
@endphp

<div 
    x-data="{ show: true }" 
    x-init="setTimeout(() => show = false, 5000)" 
    x-show="show" 
    x-transition
    class="p-4 mb-4 rounded-lg border shadow {{ $warna }}"
>
    <div class="flex items-start justify-between gap-3">
        <div>
            <h4 class="font-bold text-lg flex items-center gap-2">
                <span class="text-xl">{{ $icon }}</span>
                Status Pesanan: {{ ucfirst($status) }}
            </h4>
            <p class="text-sm mt-1">
                Pesanan atas nama <strong>{{ $pesanan['nama_pembeli'] ?? 'Tidak diketahui' }}</strong> 
                untuk buku <strong>{{ $pesanan['buku_judul'] ?? '—' }}</strong>.
            </p>

            @if($alasan)
               <p class="text-sm text-red-800 mt-1">
    <strong>Alasan Penolakan:</strong> 
    {{ $alasan !== '-' ? $alasan : 'Tidak ada alasan yang ditulis oleh admin.' }}
</p>

            @endif

            <p class="text-xs text-gray-600 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
        </div>
        <button @click="show = false" class="text-xl font-bold hover:text-red-600 transition">&times;</button>
    </div>
</div>
