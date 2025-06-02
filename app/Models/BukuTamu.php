<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BukuTamu extends Model
{
    protected $table = 'buku_tamu';
    
    protected $fillable = [
        'nama',
        'kontak',
        'keperluan',
        'waktu_kunjungan',
    ];

    protected $dates = ['waktu_kunjungan'];
}
