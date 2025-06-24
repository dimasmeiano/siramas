<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subtask;
use Illuminate\Http\Request;

class SubtaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($taskId)
    {
        // This method should return the checklists for a specific task
        return Subtask::where('task_id', $taskId)->get();
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $taskId)
    {
        $data = $request->validate([
        'title' => 'required|string',
        'assignee_id' => 'nullable|exists:users,id',
        ]);

        $data['task_id'] = $taskId;

        return Subtask::create($data);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subtask $subtask)
    {
         $subtask->update($request->only(['title', 'assignee_id']));
        return $subtask;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subtask $subtask)
    {
        $subtask->delete();
        return response()->noContent();
    }
}
