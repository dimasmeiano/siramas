<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\ChatMember;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Chat::with('members.user', 'messages')->whereHas('members', function ($q) {
            $q->where('user_id', Auth::id());
        })->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'is_group' => 'required|boolean',
            'group_name' => 'nullable|string',
            'member_ids' => 'required|array',
        ]);

        $chat = Chat::create([
            'is_group' => $request->is_group,
            'group_name' => $request->group_name,
            'created_by' => Auth::id(),
        ]);

        // Tambahkan anggota termasuk user saat ini
        $member_ids = array_unique(array_merge($request->member_ids, [Auth::id()]));
        foreach ($member_ids as $id) {
            ChatMember::create([
                'chat_id' => $chat->id,
                'user_id' => $id,
            ]);
        }

        return response()->json($chat, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Chat $chat)
    {
        $this->authorizeChat($chat);
        return $chat->load('messages.sender', 'members.user');
    }

    /**
     * Update the specified resource in storage.
     */
    public function sendMessage(Request $request, Chat $chat)
    {
        $this->authorizeChat($chat);

        $request->validate([
            'message' => 'required_without:file|string',
            'type' => 'required|string',
            'file_path' => 'nullable|string',
        ]);

        $message = ChatMessage::create([
            'chat_id' => $chat->id,
            'sender_id' => Auth::id(),
            'message' => $request->message,
            'type' => $request->type,
            'file_path' => $request->file_path,
        ]);

        return response()->json($message, 201);
    }

    private function authorizeChat(Chat $chat)
    {
        if (!$chat->members()->where('user_id', Auth::id())->exists()) {
            abort(403, 'You are not a member of this chat.');
        }
    }
}
