<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'KATEGORI_ID'; // ⬅️ WAJIB, biar Laravel pakai ini
    public $timestamps = false;

    protected $fillable = [
        'KATEGORI_ID',
        'KATEGORI_NAMA',
    ];

    public function linkBukuKategori()
    {
        return $this->hasMany(LinkBukuKategori::class, 'KATEGORI_ID', 'KATEGORI_ID');
    }
}

