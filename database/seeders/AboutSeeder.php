<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutSeeder extends Seeder
{
    public function run()
    {
        DB::table('about')->truncate(); //
        DB::table('about')->insert([
            [
                'img_about' => 'image/about/moment1.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'img_about' => 'image/about/moment2.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'img_about' => 'image/about/moment3.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
