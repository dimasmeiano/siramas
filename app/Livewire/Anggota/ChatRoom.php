<?php

namespace App\Livewire\Anggota;

use App\Events\MessageSent;
use App\Models\Chat;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatRoom extends Component
{
    public $chatId;
    public $messages = [];
    public $message = '';
    public $user;
    public $chats;

    public function mount($chatId)
{
    $this->chatId = $chatId;
    $this->user = Auth::user();
    $this->loadChat();
}

public function loadChat()
{
    $this->chats = Chat::with([
        'members.member',
        'messages.sender.member'
    ])->findOrFail($this->chatId);
}

    public function fetchMessages()
    {
        $this->messages = ChatMessage::where('chat_id', $this->chatId)
            ->with('sender')
            ->latest()->take(50)->get()->reverse();
    }

    public function sendMessage()
    {
        ChatMessage::create([
            'chat_id' => $this->chatId,
            'sender_id' => $this->user->id,
            'message' => $this->message,
            'is_read' => false
        ]);

        $this->message = '';
        $this->fetchMessages(); // manual refresh
    }

    public function render()
    {
        $user = Auth::user();

    $chats = Chat::with(['members.member', 'messages' => function ($q) {
        $q->latest()->limit(1);
    }])
    ->whereHas('members', function ($q) use ($user) {
        $q->where('user_id', $user->id);
    })->get();

    return view('livewire.anggota.chat-room', [
        'chats' => $chats,
    ]);
    }
}
