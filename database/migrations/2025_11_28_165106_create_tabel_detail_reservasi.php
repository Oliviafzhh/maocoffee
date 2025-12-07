<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tabel_detail_reservasi', function (Blueprint $table) {
            $table->increments('id_detail');

            $table->unsignedInteger('id_reservasi');
            $table->unsignedInteger('id_paket');

            $table->integer('jumlah');

            $table->foreign('id_reservasi')
                ->references('id_reservasi')->on('tabel_reservasi')
                ->onDelete('cascade');

            $table->foreign('id_paket')
                ->references('id_paket')->on('tabel_paket')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tabel_detail_reservasi');
    }
};
