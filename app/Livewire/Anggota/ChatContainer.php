<?php

namespace App\Livewire\Anggota;

use App\Models\Chat;
use App\Models\ChatMember;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatContainer extends Component
{
    public $selectedChatId = null;

    protected $listeners = ['openChat'];

    public function openChat($chatId)
    {
        $this->selectedChatId = $chatId;
    }

    public function render()
    {
        $user = auth()->user();
        $chats = Chat::with('members')->whereHas('members', fn($q) => $q->where('user_id', $user->id))->get();

        return view('livewire.anggota.chat-container', compact('chats', 'user'));
    }
}
