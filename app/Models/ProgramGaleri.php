<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramGaleri extends Model
{
    protected $table = 'program_galeris';

    protected $fillable = [
        'program_kerjas_id',
        'photo_path',
        'caption',
        'order',
    ];

    public function programKerja()
    {
        return $this->belongsTo(ProgramKerja::class, 'program_kerjas_id');
    }
}
