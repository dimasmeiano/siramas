<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationProfile extends Model
{
     protected $fillable = [
        'nama_organisasi', 'visi', 'misi', 'alamat_sekretariat', 'no_hp', 'logo', 'foto_masjid','link_youtube','link_facebook','link_instagram'
    ];
}
