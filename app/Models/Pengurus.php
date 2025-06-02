<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
     protected $table = 'pengurus';

    protected $fillable = [
        'member_id', 'departement_id', 'tanggal_mulai', 'tanggal_akhir'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
    public function departement()
{
    return $this->belongsTo(Departement::class, 'departement_id');
}
}
