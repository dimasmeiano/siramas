<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensis';
     protected $fillable = ['anggota_id', 'kegiatan_id', 'waktu_absen'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }

    public function anggota()
    {
        return $this->belongsTo(Member::class, 'anggota_id');
    }
}
