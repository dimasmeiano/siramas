<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Task::with('project', 'assignees.user')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'priority' => 'in:Low,Medium,High',
            'status' => 'in:Not Started,In Progress,Done',
            'start_date' => 'nullable|date',
            'due_date' => 'nullable|date',
        ]);
        $data['created_by'] = Auth::check() ? Auth::id() : null;

        $task = Task::create($data);

        return response()->json($task, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Task::with(['assignees.user', 'checklists', 'subtasks', 'comments.user', 'files'])->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Task::findOrFail($id);
        $task->update($request->only(['title', 'description', 'status', 'priority', 'start_date', 'due_date']));
        return response()->json($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         Task::findOrFail($id)->delete();
        return response()->json(['message' => 'Task deleted']);
    }
}
