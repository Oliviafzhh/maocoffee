<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TabelReservasiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tabel_reservasi')->insert([
            [
                'id_reservasi' => 1,
                'nama_reservasi' => 'Olivia Fauziah',
                'no_hp' => '085893954054',
                'tgl_reservasi' => '2025-12-03',
                'jam_reservasi' => '13:00 - 14:00',
                'total' => 181000,
                'catatan' => 'tidak ada',
                'status' => 'terverifikasi',
                'bukti_pembayaran' => 'image/reservasi/bukti.png',
            ],
        ]);
    }
}
