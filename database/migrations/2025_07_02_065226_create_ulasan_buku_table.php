<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUlasanBukuTable extends Migration
{
    public function up()
    {
        Schema::create('ulasan_buku', function (Blueprint $table) {
            $table->id();
            $table->string('BUKU_ISBN');
            $table->foreign('BUKU_ISBN')->references('BUKU_ISBN')->on('BUKU');

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('isi_ulasan');
            $table->tinyInteger('rating')->nullable(); // Bintang 1–5
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ulasan_buku');
    }
}
