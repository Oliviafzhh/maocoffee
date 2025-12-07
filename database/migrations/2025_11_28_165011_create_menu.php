<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->increments('id_menu');
            $table->string('nama_menu');
            $table->string('deskripsi_menu');
            $table->integer('harga');
            $table->integer('stok');
            $table->enum('kategori', ['Food', 'Drink', 'Snack', '']);
            $table->string('img_menu');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};
