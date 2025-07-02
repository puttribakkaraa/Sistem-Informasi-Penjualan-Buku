<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateIsbnForeignKey extends Migration
{
    public function up()
    {
        // 1. Ubah kolom BUKU_ISBN di tabel buku
        Schema::table('buku', function (Blueprint $table) {
            $table->string('BUKU_ISBN', 20)->change(); // Sesuaikan panjang
           
        });

        // 2. Ubah kolom buku_isbn di link_buku_kategori dan tambahkan FK
        Schema::table('link_buku_kategori', function (Blueprint $table) {
            $table->string('buku_isbn', 20)->change(); // Sesuaikan panjang

            $table->foreign('buku_isbn')
                ->references('BUKU_ISBN')->on('buku')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::table('link_buku_kategori', function (Blueprint $table) {
            $table->dropForeign(['buku_isbn']);
            $table->string('buku_isbn', 10)->change();
        });

        Schema::table('buku', function (Blueprint $table) {
            $table->dropUnique(['BUKU_ISBN']);
            $table->string('BUKU_ISBN', 10)->change();
        });
    }
}
