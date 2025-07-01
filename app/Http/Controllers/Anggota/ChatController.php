<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\ChatMember;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Svg\Tag\Rect;

class ChatController extends Controller
{
    public function index(Request $request)
    {
    $user = Auth::user();

        // Semua chat yang user ikuti
        $chatIds = ChatMember::where('user_id', $user->id)->pluck('chat_id');

        $chats = Chat::with(['members.member']) // kalau kamu butuh member dari user
            ->whereIn('id', $chatIds)
            ->get();

    // Ambil 20 pesan terakhir + pengirim
    foreach ($chats as $chat) {
        $chat->setRelation('messages', $chat->messages()
            ->with('sender')
            ->latest()
            ->limit(20)
            ->get()
            ->reverse());
    }

        // Semua user lain untuk kontak
        $contacts = User::where('id', '!=', $user->id)->get();

        return view('anggota.chat.index', compact('user', 'chats', 'contacts'));
    }

    public function show($id)
        {
            $user = Auth::user();
            $chat = Chat::with(['messages.sender'])->findOrFail($id);

            // Tandai read
            ChatMember::where('chat_id', $id)->where('user_id', $user->id)->update([
                'last_read_at' => now()
            ]);

            return view('anggota.chat.show', compact('chat', 'user'));
        }

    public function store(Request $request)
    {
        $request->validate([
            'to_id' => 'required|exists:users,id',
            'message' => 'required|string'
        ]);

        $user = Auth::user();
        $toId = $request->to_id;

        // Cari atau buat chat personal
        $chat = Chat::where('is_group', false)
            ->whereHas('members', fn($q) => $q->where('user_id', $user->id))
            ->whereHas('members', fn($q) => $q->where('user_id', $toId))
            ->first();

        if (!$chat) {
            $chat = Chat::create([
                'is_group' => false,
                'created_by' => $user->id,
            ]);

            ChatMember::insert([
                ['chat_id' => $chat->id, 'user_id' => $user->id],
                ['chat_id' => $chat->id, 'user_id' => $toId],
            ]);
        }

        ChatMessage::create([
            'chat_id' => $chat->id,
            'sender_id' => $user->id,
            'message' => $request->message,
        ]);

        return redirect()->route('anggota.chat.show', $chat->id);
    }

    public function label($slug)
{
    $user = Auth::user();

    // Dummy filter (ganti sesuai logika label kamu)
    $chats = Chat::with(['members', 'messages'])
        ->whereHas('members', fn($q) => $q->where('user_id', $user->id))
        ->get(); // bisa difilter berdasarkan $slug

    return view('anggota.chat.index', compact('chats', 'user'));
}
}
