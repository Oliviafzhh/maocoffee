<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tabel_reservasi', function (Blueprint $table) {
            $table->increments('id_reservasi');
            $table->string('nama_reservasi');
            $table->string('no_hp', 20);
            $table->date('tgl_reservasi')->nullable();
            $table->string('jam_reservasi')->nullable();
            $table->integer('total')->default(0);
            $table->text('catatan')->nullable();
            $table->string('status');
            $table->string('bukti_pembayaran');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tabel_reservasi');
    }
};
