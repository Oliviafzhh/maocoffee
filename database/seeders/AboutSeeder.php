<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutSeeder extends Seeder
{
    public function run()
    {
        DB::table('abouts')->truncate(); //
        DB::table('abouts')->insert([
        
            [
                'small_title' => 'Our Story',
                'title' => 'Handcrafted Coffee',
                'description' => 'Kami menyajikan kopi pilihan dengan cita rasa terbaik.',
                'image' => 'image/moment/moment1.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'small_title' => 'Our Space',
                'title' => 'Comfort Place',
                'description' => 'Tempat nyaman untuk bekerja dan bersantai.',
                'image' => 'image/moment/momoment2.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'small_title' => 'Our Beans',
                'title' => 'Selected Beans',
                'description' => 'Biji kopi terbaik dari petani lokal.',
                'image' => 'image/moment/moment3.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }}