<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lpj extends Model
{
    protected $fillable = [
        'program_kerja_id',
        'nama_kegiatan',
        'tanggal_pelaksanaan',
        'ketua_pelaksana_id',
        'anggaran_dana',
        'dana_terealisasi',
        'ringkasan',
        // tambahkan field lain sesuai kebutuhan
    ];

    // Relasi: satu LPJ punya banyak dokumentasi
    public function dokumentasi()
    {
        return $this->hasMany(LpjDokumentasi::class, 'lpj_id', 'id');
    }

    public function penanggungJawab()
    {
        return $this->belongsTo(Member::class, 'ketua_pelaksana_id');
    }

     public function programKerja()
    {
        return $this->belongsTo(ProgramKerja::class, 'program_kerja_id');
    }
}
