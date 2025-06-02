<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplateProgramKerja extends Model
{
    protected $table = 'template_program_kerjas';

    protected $fillable = [
        'nama',
        'deskripsi',
        'interval',
        'auto_generate',
    ];

    protected $casts = [
        'auto_generate' => 'boolean',
    ];

    public function programKerjas()
{
    return $this->hasMany(ProgramKerja::class, 'template_id');
}
}
