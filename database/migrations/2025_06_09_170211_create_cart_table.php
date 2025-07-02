<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('cart', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Menyimpan ID pengguna (user)
        $table->string('book_title'); // Menyimpan judul buku
        $table->string('book_isbn'); // Menyimpan ISBN buku
        $table->integer('quantity'); // Jumlah buku dalam keranjang
        $table->decimal('price', 10, 2); // Harga buku
        $table->decimal('total_price', 10, 2); // Harga total per item (quantity * price)
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart');
    }
};
