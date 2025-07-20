<?php

use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\CheckInController;
use App\Http\Controllers\Api\ChecklistController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\PengumumanController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\SubtaskController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\ChatMessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('projects', ProjectController::class);
    Route::apiResource('tasks', TaskController::class);
    // Subtask
    Route::apiResource('tasks.subtasks', SubtaskController::class)->shallow();

    // Checklist
    Route::apiResource('tasks.checklists', ChecklistController::class)->shallow();

    // Comment
    Route::apiResource('tasks.comments', CommentController::class)->shallow();

    // Pengumuman
    Route::get('/pengumuman', [PengumumanController::class, 'index']);
    Route::post('/pengumuman', [PengumumanController::class, 'store']);

    // Chat
    Route::get('/chats', [ChatController::class, 'index']);
    Route::get('/chats/{chat}', [ChatController::class, 'show']);
    Route::post('/chats', [ChatController::class, 'store']);
    Route::post('/chats/{chat}/message', [ChatController::class, 'sendMessage']);
    Route::get('/chats/{chat}/messages', [ChatMessageController::class, 'index']);
    Route::post('/chats/{chat}/messages', [ChatMessageController::class, 'store']);
});
