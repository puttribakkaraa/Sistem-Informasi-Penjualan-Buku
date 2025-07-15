<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

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
        'pesan' => 'Pesanan #' . $this->pesanan->id . ' sekarang berstatus: ' . $this->status,
        'url' => url('/riwayat-pembelian/' . $this->pesanan->id),
        'waktu' => now()->format('d-m-Y H:i'),
        'status' => $this->status,
        'pesanan' => [
            'nama_pembeli' => $this->pesanan->NAMA_PEMBELI ?? 'Tidak diketahui',
            'buku_judul' => $this->pesanan->BUKU_JUDUL ?? '—',
        ],
    ];
}

}
