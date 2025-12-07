<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('konfigurasi_web', function (Blueprint $table) {
            $table->increments('id_konfigurasi');
            $table->string('logo_web');
            $table->string('img_card1');
            $table->string('nama_card1');
            $table->string('img_card2');
            $table->string('nama_card2');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('konfigurasi_web');
    }
};
