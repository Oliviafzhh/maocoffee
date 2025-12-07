<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TabelPaketSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tabel_paket')->insert([
            [
                'id_paket' => 1,
                'nama_paket' => 'Paket 1',
                'deeskripsi_menu' => 'Nasi Goreng + Es Teh Manis',
                'harga_paket' => 35000,
                'image_paket' => 'image/paket/paket-1.jpg',
            ],
            [
                'id_paket' => 2,
                'nama_paket' => 'Paket 2',
                'deeskripsi_menu' => 'Spagehti + Manggo Smoothies',
                'harga_paket' => 37000,
                'image_paket' => 'image/paket/paket-2.jpg',
            ],
            [
                'id_paket' => 3,
                'nama_paket' => 'Paket 3',
                'deeskripsi_menu' => 'Ayam Bakar + Thai tea',
                'harga_paket' => 42000,
                'image_paket' => 'image/paket/paket-3.jpg',
            ],
        ]);
    }
}
