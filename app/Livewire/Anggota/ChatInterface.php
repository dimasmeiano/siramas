<?php

namespace App\Livewire\Anggota;

use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;

class ChatInterface extends Component
{
    use WithFileUploads;

    public $chats;
    public $chat;
    public $message = '';
    public $file; // For file uploads
    public $user;
    public $userId;
    public $showNewMessageModal = false;
    public $selectedUserId;
    public $availableUsers = [];
    public $isCreatingGroup = false;
    public $groupName = '';
    public $groupMembers = []; // array of user_ids
    public $showManageGroupModal = false;
    public $groupMemberList = [];
    public $groupChatId;
    public $groupMemberIds = [];
    public $allUsers = [];
    public $newGroupName = '';
    
    public function getListeners()
    {
        return [
            "echo-private:chat.{$this->user->id},MessageSent" => 'refreshSidebar',
            'refreshSidebar' => 'loadChats',
            'refreshChatRoom' => 'loadChatRoom',
            'chatSelected' => 'selectChat',
            'leaveGroupRequest' => 'leaveGroup',
            'exitChat' => 'exitChat',
        ];
    }
    public function mount()
    {
        $this->userId = Auth::id();
        $this->user = Auth::user();
        $this->loadChats();
    }

    public function handleNewSidebarMessage($payload)
    {
        $this->loadChats(); // Atau logic untuk refresh sidebar
    }
    
    public function loadChats()
    {
        Log::info('loadChats dipanggil!');
        $this->chats = Chat::with(['messages' => fn($q) => $q->latest()->limit(1), 'members.member'])
            ->whereHas('members', fn($q) => $q->where('user_id', $this->user->id))
            ->get();
            
            $unreadCounts = ChatMessage::select('chat_id', DB::raw('count(*) as count'))
            ->where('is_read', false)
            ->where('sender_id', '!=', $this->user->id)
            ->whereIn('chat_id', $this->chats->pluck('id'))
            ->groupBy('chat_id')
            ->get()
            ->keyBy('chat_id');
            
        foreach ($this->chats as $chat) {
            $chat->unread_count = $unreadCounts[$chat->id]['count'] ?? 0;
        }

    }
    
    public function selectChat($chatId)
    {
        
        if (!$chatId) return;

        $chat = Chat::with(['messages.sender.member', 'members.member'])
            ->whereHas('members', fn($q) => $q->where('user_id', $this->user->id))
            ->find($chatId);

        if (!$chat) {
            $this->chat = null;
            session()->flash('error', 'Anda bukan anggota grup ini.');
            return;
        }

        $this->chat = $chat;
        $this->markAsRead($chatId);
    }
    
    public function loadChatRoom()
    {
        // Method ini sebenarnya tidak perlu jika kita langsung set $this->chat di selectChat
        // Tapi kita biarkan untuk konsistensi
        if ($this->chat) {
            $this->chat->load(['messages.sender.member', 'members.member']);
        }
    }
    
    public function sendMessage()
    {
        $this->validate([
            'message' => 'required|string',
            'file' => 'nullable|file|max:10240', // max 10MB
        ]);
        
        if (!$this->chat) {
            session()->flash('error', 'Pilih obrolan terlebih dahulu');
            return;
        }

        $filePath = null;

        if ($this->file) {
                $filePath = $this->file->store('chat-files', 'public'); // simpan di storage/app/public/chat-files
            }

        
        $msg = ChatMessage::create([
            'chat_id' => $this->chat->id,
            'sender_id' => $this->user->id,
            'message' => $this->message,
            'file_path' => $filePath,
            'is_read' => false,
        ]);
        
        broadcast(new \App\Events\MessageSent($msg))->toOthers();
        $this->file = null;
        $this->message = '';
        $this->loadChatRoom();
        $this->dispatch('refreshSidebar');
    }
    
    public function markAsRead($chatId)
    {
        ChatMessage::where('chat_id', $chatId)
            ->where('sender_id', '!=', $this->user->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);
    }

   public function openNewMessageModal()
    {
        $this->reset('selectedUserId');

        $this->availableUsers = User::where('id', '!=', Auth::id())
        ->whereNotNull('member_id')
        ->with('member')
        ->get();

        $this->showNewMessageModal = true;
    }

    public function closeNewMessageModal()
    {
        $this->showNewMessageModal = false;
    }

    public function startNewChat()
    {
        if (!$this->selectedUserId) return;

        $chat = Chat::where('is_group', false)
            ->whereHas('members', fn($q) => $q->where('user_id', Auth::id()))
            ->whereHas('members', fn($q) => $q->where('user_id', $this->selectedUserId))
            ->withCount('members')
            ->having('members_count', 2)
            ->first();

        if (!$chat) {
            $chat = Chat::create([
                'is_group' => false,
                'created_by' => Auth::id(),
            ]);
            $chat->members()->sync([$this->selectedUserId, Auth::id()]);
        }

        $this->selectChat($chat->id);
        $this->showNewMessageModal = false;

        $this->loadChats(); // <--- ini penting agar sidebar ter-update
        $this->dispatch('refreshSidebar'); // kalau sidebar di komponen lain
    }

    public function createGroup()
    {
        $this->validate([
            'groupName' => 'required|string|max:255',
            'groupMembers' => 'required|array|min:1',
        ]);

        $chat = Chat::create([
            'is_group' => true,
            'group_name' => $this->groupName,
            'created_by' => Auth::id(),
        ]);

        $memberIds = array_merge($this->groupMembers, [Auth::id()]);
        $chat->members()->sync($memberIds);

        $this->reset(['groupName', 'groupMembers', 'isCreatingGroup']);
        $this->loadChats();
        $this->selectChat($chat->id);
        $this->dispatch('chatSelected', $chat->id);
    }

    public function openCreateGroupModal()
    {
        $this->groupName = '';
        $this->groupMembers = [];
        $this->availableUsers = User::where('id', '!=', Auth::id())->with('member')->get();
        $this->isCreatingGroup = true;
    }

    public function openManageGroupMembersModal()
    {
        if (!$this->chat || !$this->chat->is_group || $this->chat->created_by !== Auth::id()) {
            return;
        }

        $this->groupChatId = $this->chat->id;
        $this->groupMemberList = $this->chat->members->pluck('id')->toArray();
        $this->availableUsers = User::where('id', '!=', Auth::id())->with('member')->get();
        $this->showManageGroupModal = true;
    }

    public function saveGroupMembers()
    {
        $chat = Chat::find($this->groupChatId);

        if (!$chat || !$chat->is_group || $chat->created_by !== Auth::id()) {
            session()->flash('error', 'Akses ditolak');
            return;
        }

        $chat->members()->sync(array_unique(array_merge($this->groupMemberList, [$chat->created_by])));

        $this->showManageGroupModal = false;
        $this->loadChatRoom();
        $this->loadChats();
    }

    public function openManageGroupModal()
    {
        if (!$this->chat || !$this->chat->is_group) return;

        $this->newGroupName = $this->chat->group_name; // penting!
        $this->groupMemberIds = $this->chat->members->pluck('user_id')->toArray();

        $this->allUsers = User::where('id', '!=', $this->user->id)
            ->whereNotNull('member_id')
            ->with('member')
            ->get();

        $this->showManageGroupModal = true;
    }

    public function updateGroupMembers()
    {
        if (!$this->chat || !$this->chat->is_group) return;

        // Wajib tambahkan Auth::id() biar tidak mengeluarkan diri sendiri
        if (!in_array(Auth::id(), $this->groupMemberIds)) {
            $this->groupMemberIds[] = Auth::id();
        }

        $this->chat->members()->sync($this->groupMemberIds);

        session()->flash('success', 'Anggota grup diperbarui.');
        $this->showManageGroupModal = false;
        $this->loadChatRoom();
        $this->loadChats();
    }

    public function updateGroupName()
    {
        $this->validate([
            'newGroupName' => 'required|string|max:100',
        ]);

        if (!$this->chat || !$this->chat->is_group) return;

        // Hanya update nama grup, tanpa mengubah anggota
        Chat::where('id', $this->chat->id)->update([
            'group_name' => $this->newGroupName,
        ]);

        // Reload chat & sidebar agar perubahan nama langsung terlihat
        $this->selectChat($this->chat->id); // pastikan ini memuat ulang $this->chat
        $this->loadChats();

        $this->showManageGroupModal = false;
        $this->dispatch('showSuccess', 'Nama grup berhasil diperbarui.');
    }

    public function deleteGroup()
    {
        if (!$this->chat || $this->chat->created_by !== $this->user->id) return;

        $chatId = $this->chat->id;
        $this->chat->delete();

        $this->chat = null;
        $this->showManageGroupModal = false;
        $this->loadChats();

        session()->flash('success', "Grup #{$chatId} berhasil dihapus.");
    }

    public function leaveGroup()
    {
        if (!$this->chat || !$this->chat->is_group) return;

        if ($this->chat->created_by === $this->user->id) {
            session()->flash('error', 'Pembuat grup tidak bisa keluar dari grup. Silakan hapus grup.');
            return;
        }

        $this->chat->members()->detach($this->user->id);
        $this->chat = null;
        $this->showManageGroupModal = false;
        $this->loadChats();

        session()->flash('success', "Berhasil keluar dari grup.");
    }

    public function exitChat()
    {
        $this->chat = null;
    }

    public function render()
    {
        return view('livewire.anggota.chat-interface')->layout('layouts.anggota.master');
    }
}
