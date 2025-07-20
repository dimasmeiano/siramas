<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // GET /api/chats/{chat}/messages
    public function index($chatId)
    {
        $messages = ChatMessage::where('chat_id', intval($chatId))
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get();

        return response()->json([
            'chat_id' => intval($chatId),
            'messages' => $messages->reverse()->values(),
        ]);
    }

    // POST /api/chats/{chat}/messages
    public function store(Request $request, $chatId)
    {
        $request->validate([
            'message' => 'required|string',
            'type' => 'nullable|string', // text, image, file
            'file_url' => 'nullable|string',
        ]);

        $message = ChatMessage::create([
            'chat_id' => intval($chatId),
            'sender_id' => Auth::id(),
            'message' => $request->message,
            'type' => $request->type ?? 'text',
            'file_url' => $request->file_url,
            'meta' => [
                'is_read' => false,
                'seen_by' => [],
                'reply_to' => null,
            ],
            'created_at' => now(),
        ]);



        // Jika ingin realtime:
        broadcast(new MessageSent($message))->toOthers();

        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }
}
