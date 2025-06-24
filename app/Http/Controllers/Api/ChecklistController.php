<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TaskChecklist;
use Illuminate\Http\Request;

class ChecklistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($taskId) 
    {
        return TaskChecklist::where('task_id', $taskId)->get();
    }

public function store(Request $request, $taskId) {
    $data = $request->validate([
        'item' => 'required|string',
    ]);
    $data['task_id'] = $taskId;
    $data['is_checked'] = false;

    return TaskChecklist::create($data);
}

public function update(Request $request, TaskChecklist $checklist) {
    $checklist->update([
        'is_checked' => $request->boolean('is_checked'),
        'item' => $request->input('item', $checklist->item),
    ]);
    return $checklist;
}

public function destroy(TaskChecklist $checklist) {
    $checklist->delete();
    return response()->noContent();
}
}
