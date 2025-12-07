<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TabelDetailReservasiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tabel_detail_reservasi')->insert([
            [
                'id_detail' => 1,
                'id_reservasi' => 1,
                'id_paket' => 1,
                'jumlah' => 2,
            ],
            [
                'id_detail' => 2,
                'id_reservasi' => 1,
                'id_paket' => 2,
                'jumlah' => 3,
            ],
        ]);
    }
}
