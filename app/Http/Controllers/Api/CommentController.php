<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TaskComment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($taskId) 
    {
        return TaskComment::with('user', 'replies.user')
            ->where('task_id', $taskId)
            ->whereNull('parent_id')
            ->get();
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $taskId) 
    {
    $data = $request->validate([
        'content' => 'required|string',
        'parent_id' => 'nullable|exists:task_comments,id'
    ]);

    $data['task_id'] = $taskId;
    $user = \Illuminate\Support\Facades\Auth::user();
    if (!$user) {
        abort(401, 'Unauthorized');
    }
    $data['user_id'] = $user->id;

    return TaskComment::create($data);
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskComment $comment) {
    $user = \Illuminate\Support\Facades\Auth::user();
    if (!$user || $comment->user_id !== $user->id) {
        abort(403, 'Forbidden');
    }

    $comment->delete();
    return response()->noContent();
}
}
