<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class StatusPesananNotification extends Notification
{
    use Queueable;

    protected $pesanan;
    protected $status;

    public function __construct($pesanan, $status)
    {
        $this->pesanan = $pesanan;
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'judul' => 'Status Pesanan Diperbarui',
            'pesan' => $this->generatePesan(),
            'url' => url('/riwayat-pembelian/' . $this->pesanan->id),
            'waktu' => now()->format('d-m-Y H:i'),
            'status' => $this->status,
            'pesanan' => [
                'nama_pembeli' => $this->pesanan->NAMA_PEMBELI ?? 'Tidak diketahui',
                'buku_judul' => $this->pesanan->BUKU_JUDUL ?? '—',
            ],
        ];
    }

    protected function generatePesan()
    {
        $base = 'Pesanan atas nama ' . ($this->pesanan->NAMA_PEMBELI ?? '-') .
                ' untuk buku ' . ($this->pesanan->BUKU_JUDUL ?? '-') .
                ' sekarang berstatus: ' . ucfirst($this->status) . '.';

        if ($this->status === 'ditolak') {
            $alasan = $this->pesanan->alasan_penolakan ?? 'Tanpa alasan';
            $base .= ' Alasan penolakan: ' . $alasan;
        }

        return $base;
    }
}
