<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMember extends Model
{
    protected $table = 'chat_members';
     protected $fillable = [
        'chat_id',
        'user_id',
    ];

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sender() 
    {
        return $this->belongsTo(User::class, 'sender_id')->with('member');
    }
}
