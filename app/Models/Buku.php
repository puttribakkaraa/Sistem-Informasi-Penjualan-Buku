<?php

// app/Models/Buku.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'BUKU';
    protected $primaryKey = 'BUKU_ISBN';
    public $timestamps = false;
    public $incrementing = false; 

   protected $fillable = [
        'BUKU_ISBN', 'BUKU_JUDUL', 'PENERBIT_ID', 'BUKU_TGLTERBIT',
        'BUKU_JMLHALAMAN', 'BUKU_DESKRIPSI', 'BUKU_HARGA'
    ];

    // Relasi dengan model Penerbit
    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class, 'PENERBIT_ID', 'PENERBIT_ID');
    }

      // Relasi ke tabel Kategori melalui LINK_BUKU_KATEGORI
    public function kategoris()
    {
        return $this->belongsToMany(Kategori::class, 'LINK_BUKU_KATEGORI', 'BUKU_ISBN', 'KATEGORI_ID');
    }
}
