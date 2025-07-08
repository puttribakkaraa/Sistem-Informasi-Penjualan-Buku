<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';
    protected $primaryKey = 'BUKU_ISBN';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'BUKU_ISBN',
        'BUKU_JUDUL',
        'stok',
        'PENERBIT_ID',
        'BUKU_TGLTERBIT',
        'BUKU_JMLHALAMAN',
        'BUKU_DESKRIPSI',
        'BUKU_HARGA',
        'BUKU_GAMBAR',
    ];
    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class, 'PENERBIT_ID', 'PENERBIT_ID');
    }
public function ulasan()
{
    return $this->hasMany(UlasanBuku::class, 'BUKU_ISBN', 'BUKU_ISBN');
}

    public function kategoris()
    {
        return $this->belongsToMany(Kategori::class, 'LINK_BUKU_KATEGORI', 'BUKU_ISBN', 'KATEGORI_ID');
    }
}

