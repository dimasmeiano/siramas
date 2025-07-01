<?php

namespace App\Livewire\Anggota;

use App\Models\ChatMessage;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatNotification extends Component
{
    public $unreadCount = 0;

    protected $listeners = ['newMessageReceived' => 'updateUnread'];

    public function mount()
    {
        $this->updateUnread();
    }

    public function updateUnread()
    {
        $this->unreadCount = ChatMessage::where('is_read', false)
            ->where('sender_id', '!=', Auth::id())
            ->whereHas('chat.members', function ($q) {
                $q->where('user_id', Auth::id());
            })->count();
    }

    public function render()
    {
        return view('livewire.anggota.chat-notification');
    }
}
