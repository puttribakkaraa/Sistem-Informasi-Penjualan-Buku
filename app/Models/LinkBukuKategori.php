<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkBukuKategori extends Model
{
    protected $table = 'link_buku_kategori';
    public $timestamps = false;

    protected $fillable = ['buku_isbn', 'KATEGORI_ID'];

    protected $primaryKey = null;
    public $incrementing = false;
}


