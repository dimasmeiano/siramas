<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class ProgramKerjaFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_kerja_id',
        'nama_file',
        'path',
    ];

    public function programKerja()
    {
        return $this->belongsTo(ProgramKerja::class);
    }
}
