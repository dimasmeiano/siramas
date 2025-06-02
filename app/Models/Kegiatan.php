<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Absensi;

class Kegiatan extends Model
{
    protected $table = 'kegiatans';
     protected $fillable = ['nama', 'waktu_mulai', 'waktu_selesai'];

    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }

    public function notulen()
    {
        return $this->hasOne(Notulen::class);
    }
}
