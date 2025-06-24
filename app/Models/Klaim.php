<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Klaim extends Model
{
    protected $table = 'klaim';

    protected $fillable = [
        'user_id',
        'keterangan',
        'jumlah',
        'bukti_file',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
