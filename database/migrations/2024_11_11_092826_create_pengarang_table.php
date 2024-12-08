<?php

// database/migrations/2024_11_15_000002_create_pengarang_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengarangTable extends Migration
{
    public function up()
    {
        Schema::create('PENGARANG', function (Blueprint $table) {
            $table->char('PENGARANG_ID', 3)->primary();
            $table->string('PENGARANG_NAMA', 30);
        });
    }

    public function down()
    {
        Schema::dropIfExists('PENGARANG');
    }
}

