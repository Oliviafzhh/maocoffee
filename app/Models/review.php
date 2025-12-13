<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    public $timestamps = false;

    // Nama tabel di database
    protected $table = 'review';

    // Primary key
    protected $primaryKey = 'id_review';

    // Field yang bisa diisi (mass assignable)
    protected $fillable = [
        'profil_review',
        'nama_review',
        'bintang',
        'deskripsi_review',
        'makanan_img',
    ];
}