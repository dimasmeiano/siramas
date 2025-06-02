<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class KategoriBerita extends Model
{
    protected $fillable = ['nama', 'slug', 'deskripsi'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($kategori) {
            $kategori->slug = Str::slug($kategori->nama);
        });
    }

    public function artikel()
    {
        return $this->hasMany(ArtikelBerita::class, 'kategori_id');
    }
}
