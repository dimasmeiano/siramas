<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\KategoriBerita;

class ArtikelBerita extends Model
{
    protected $fillable = ['judul', 'slug', 'isi', 'thumbnail', 'penulis', 'status', 'kategori_id', 'is_unggulan'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($artikel) {
            $artikel->slug = Str::slug($artikel->judul);
        });
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriBerita::class, 'kategori_id');
    }

   public function comments()
{
    return $this->hasMany(Comment::class, 'article_id')->with('replies');
}
}
