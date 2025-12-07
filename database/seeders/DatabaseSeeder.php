<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            KonfigurasiWebSeeder::class,
            MenuSeeder::class,
            ReviewSeeder::class,
            TabelPaketSeeder::class,
            TabelReservasiSeeder::class,
            TabelDetailReservasiSeeder::class,
            AdminSeeder::class,
            AboutSeeder::class,
        ]);
    }
}
