<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('review', function (Blueprint $table) {
            $table->increments('id_review');
            $table->string('makanan_img');
            $table->string('profil_review');
            $table->string('nama_review');
            $table->tinyInteger('bintang');
            $table->string('deskripsi_review');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('review');
    }
};
