<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('buku', function (Blueprint $table) {
            $table->string('BUKU_GAMBAR')->nullable()->after('BUKU_HARGA');
        });
    }

    public function down(): void
    {
        Schema::table('buku', function (Blueprint $table) {
            $table->dropColumn('BUKU_GAMBAR');
        });
    }
};

