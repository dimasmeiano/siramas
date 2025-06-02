<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LpjDokumentasi extends Model
{
    protected $fillable = [
        'lpj_id',
        'file_path',
        'keterangan',
    ];

    // Relasi: dokumentasi ini milik satu LPJ
    public function lpj()
    {
        return $this->belongsTo(Lpj::class);
    }
}
