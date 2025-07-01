<?php

namespace App\Livewire\Anggota;

use App\Models\Chat;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatSidebar extends Component
{
    public $chats;
    public $user;

    public function mount()
    {
        $this->user = Auth::user();
        $this->loadChats();
    }

    public function loadChats()
{
    $this->chats = Chat::with('members')
        ->whereHas('members', fn($q) => $q->where('user_id', $this->user->id))
        ->get()
        ->map(function($chat) {
            // count *all* unread from others in *this* chat
            $chat->unread_count = ChatMessage::where('chat_id', $chat->id)
                ->where('is_read', false)
                ->where('sender_id', '!=', $this->user->id)
                ->count();
            return $chat;
        });
}

    public function selectChat($chatId)
    {
        $this->dispatch('openChat', $chatId)->to(ChatContainer::class);
    }

    public function render()
    {
        $user = Auth::user();

    $chats = Chat::with(['members.member', 'messages' => fn($q) => $q->latest()->limit(1)])
        ->whereHas('members', fn($q) => $q->where('user_id', $user->id))
        ->get();

    return view('livewire.anggota.chat-sidebar', [
        'chats' => $chats,
    ]);
    }
}
