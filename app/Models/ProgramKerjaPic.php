<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProgramKerjaPic extends Pivot
{
    protected $table = 'program_kerja_pic';

    public $timestamps = true;

    public function programKerja()
    {
        return $this->belongsTo(ProgramKerja::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
