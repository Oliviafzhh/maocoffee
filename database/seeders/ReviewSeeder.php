<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        DB::table('review')->truncate();

        DB::table('review')->insert([
            [
                'id_review' => 1,
                'makanan_img' => 'image/review/food.png',
                'profil_review' => 'image/review/profile.png',
                'nama_review' => 'Ahmad Rizki',
                'bintang' => 5,
                'deskripsi_review' => 'Kopi di Mao Coffee benar-benar istimewa! Rasanya rich dan aroma yang menggugah selera.',
            ],
            [
                'id_review' => 2,
                'makanan_img' => 'image/review/food.png',
                'profil_review' => 'image/review/profile.png',
                'nama_review' => 'Sari Dewi',
                'bintang' => 4,
                'deskripsi_review' => 'Tempat cozy dan kopinya enak.',
            ],
            [
                'id_review' => 3,
                'makanan_img' => 'image/review/food.png',
                'profil_review' => 'image/review/profile.png',
                'nama_review' => 'Budi Santoso',
                'bintang' => 5,
                'deskripsi_review' => 'Spot favorit buat meeting client!',
            ],
            [
                'id_review' => 4,
                'makanan_img' => 'image/review/food.png',
                'profil_review' => 'image/review/profile.png',
                'nama_review' => 'Maya Sari',
                'bintang' => 3,
                'deskripsi_review' => 'Kopinya oke, tapi tempatnya agak sempit.',
            ],
            [
                'id_review' => 5,
                'makanan_img' => 'image/review/food.png',
                'profil_review' => 'image/review/profile.png',
                'nama_review' => 'Rizky Pratama',
                'bintang' => 5,
                'deskripsi_review' => 'Baristanya profesional banget!',
            ],
            [
                'id_review' => 6,
                'makanan_img' => 'image/review/food.png',
                'profil_review' => 'image/review/profile.png',
                'nama_review' => 'Diana Putri',
                'bintang' => 4,
                'deskripsi_review' => 'Dessert dan kopi kombinasi yang sempurna.',
            ],
        ]);
    }
}
