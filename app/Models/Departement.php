<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    protected $fillable = ['name'];

    public function members()
    {
        return $this->hasMany(Member::class);
    }

    public function pengurus()
    {
        return $this->hasMany(Pengurus::class);
    }
}
