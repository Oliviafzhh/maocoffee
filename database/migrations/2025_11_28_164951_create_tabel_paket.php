<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tabel_paket', function (Blueprint $table) {
            $table->increments('id_paket');
            $table->string('nama_paket');
            $table->text('deeskripsi_menu')->nullable();
            $table->integer('harga_paket');
            $table->string('image_paket');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tabel_paket');
    }
};
