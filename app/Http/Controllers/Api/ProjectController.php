<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Project::with('folder', 'tasks')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'folder_id' => 'nullable|exists:folders,id',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|in:Not Started,In Progress,Done',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);
        $data['created_by'] = Auth::check() ? Auth::id() : null;

        $project = Project::create($data);

        return response()->json($project, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Project::with('tasks', 'folder')->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $project = Project::findOrFail($id);
        $project->update($request->only(['name', 'description', 'status', 'start_date', 'end_date']));
        return response()->json($project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Project::findOrFail($id)->delete();
        return response()->json(['message' => 'Project deleted']);
    }
}
