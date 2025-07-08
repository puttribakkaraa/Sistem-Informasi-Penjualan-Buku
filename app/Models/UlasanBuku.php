<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UlasanBuku extends Model
{
    protected $table = 'ulasan_buku';

    protected $fillable = ['BUKU_ISBN', 'user_id', 'isi_ulasan', 'rating'];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'BUKU_ISBN', 'BUKU_ISBN');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
