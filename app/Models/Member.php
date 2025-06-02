<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';
     protected $fillable = [
        'nia',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'no_hp',
        'email',
        'pendidikan_terakhir',
        'is_active',
        'foto',
        'departement_id',
        'qr_code',
    ];

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function pengurus()
    {
        return $this->hasOne(Pengurus::class);
    }

    public function programs()
    {
        return $this->belongsToMany(ProgramKerja::class, 'program_kerja_pic', 'member_id', 'program_kerja_id');
    }

    public function lpjDibuat()
    {
        return $this->hasMany(Lpj::class, 'ketua_pelaksana_id');
    }
}
