<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['article_id', 'parent_id', 'name', 'email', 'content'];

    public function article()
    {
        return $this->belongsTo(ArtikelBerita::class);
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Comment::class, 'parent_id')->orderBy('created_at');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
