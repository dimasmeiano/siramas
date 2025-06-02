<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $table = 'visitors';

    protected $fillable = ['ip', 'url', 'visited_at'];
    
    public $timestamps = false; // <--- tambahkan ini
}
