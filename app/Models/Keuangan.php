<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\ProgramKerja;

class Keuangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_kerja_id', 'tanggal', 'jenis', 'nominal', 'keterangan'
    ];

    public function programKerja()
    {
        return $this->belongsTo(ProgramKerja::class);
    }

    protected $dates = ['tanggal'];
}
