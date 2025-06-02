<?php

namespace App\Models;
use App\Models\Member;
use App\Models\ProgramKerjaFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class ProgramKerja extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'deskripsi',
        'status',
        'tanggal_mulai',
        'tanggal_selesai',
        'created_by',
    ];

    public function pics()
{
    return $this->belongsToMany(Member::class, 'program_kerja_pic', 'program_kerja_id', 'member_id')
                ->using(ProgramKerjaPic::class)
                ->withTimestamps();
}

    public function files()
    {
        return $this->hasMany(ProgramKerjaFile::class);
    }

    public function lpj()
    {
        return $this->hasOne(Lpj::class, 'program_kerja_id');
    }

    public function galerifoto()
    {
        return $this->hasMany(ProgramGaleri::class, 'program_kerjas_id');
    }
}
