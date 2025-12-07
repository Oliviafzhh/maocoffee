<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\konfigurasi_web;

class KonfigurasiWebSeeder extends Seeder
{
    public function run()
    {
        konfigurasi_web::create([
            'logo_web' => 'image/konfigurasi_web/logo-mao.png',
            'img_card1' => 'image/konfigurasi_web/Bold-Baileys.png',
            'nama_card1' => 'Bold-Baileys',
            'img_card2' => 'image/konfigurasi_web/Kafo-Baileys.png',
            'nama_card2' => 'Kafo Baileys',
        ]);
    }
}
