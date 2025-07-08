<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chats';

    protected $fillable = [
        'is_group',
        'group_name',
        'created_by',
    ];

   public function members() {
    return $this->belongsToMany(User::class, 'chat_members', 'chat_id', 'user_id');
}

    public function messages()
    {
        return $this->hasMany(ChatMessage::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function lastMessage() {
    return $this->hasOne(ChatMessage::class)->latestOfMany();
}
}
