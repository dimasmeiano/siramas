<?php

namespace App\Livewire;

use App\Models\Chat;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NotificationBell extends Component
{
    public $unreadCount = 0;

    public function mount()
    {
        $this->checkUnread();
    }

    public function checkUnread()
    {
        if (!Auth::check()) return;

        $userId = Auth::id();

        $this->unreadCount = Chat::whereHas('members', fn($q) => $q->where('user_id', $userId))
            ->withCount(['messages as unread_messages_count' => function ($q) use ($userId) {
                $q->where('is_read', false)->where('sender_id', '!=', $userId);
            }])
            ->get()
            ->sum('unread_messages_count');
    }

    public function render()
    {
        return view('livewire.notification-bell');
    }
}
