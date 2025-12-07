<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->increments('id_user');
            $table->string('username');
            $table->string('email');
            $table->string('password');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
