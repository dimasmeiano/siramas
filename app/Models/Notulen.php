<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notulen extends Model
{
    protected $table = 'notulens';
    protected $fillable = ['kegiatan_id', 'isi_notulen', 'pemimpin_id'];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }

    public function pemimpin()
    {
        return $this->belongsTo(Member::class, 'pemimpin_id');
    }
}
