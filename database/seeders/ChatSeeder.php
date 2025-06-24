<?php

namespace Database\Seeders;

use App\Models\Chat;
use App\Models\ChatMember;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $users = User::take(3)->get(); // ambil 3 user

        // Chat Grup
        $groupChat = Chat::create([
            'is_group' => true,
            'group_name' => 'Remas Inti',
            'created_by' => $users[0]->id,
        ]);

        foreach ($users as $user) {
            ChatMember::create([
                'chat_id' => $groupChat->id,
                'user_id' => $user->id,
            ]);
        }

        ChatMessage::create([
            'chat_id' => $groupChat->id,
            'sender_id' => $users[0]->id,
            'message' => 'Assalamualaikum, siap-siap kerja bakti ya!',
            'type' => 'text',
        ]);

        // Chat Pribadi
        $privateChat = Chat::create([
            'is_group' => false,
            'created_by' => $users[1]->id,
        ]);

        ChatMember::insert([
            ['chat_id' => $privateChat->id, 'user_id' => $users[1]->id],
            ['chat_id' => $privateChat->id, 'user_id' => $users[2]->id],
        ]);

        ChatMessage::create([
            'chat_id' => $privateChat->id,
            'sender_id' => $users[2]->id,
            'message' => 'Ada waktu untuk bantu dokumentasi kajian?',
            'type' => 'text',
        ]);
    }
}
