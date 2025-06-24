<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'tasks';

    protected $fillable = ['project_id', 'title', 'description', 'priority', 'status', 'start_date', 'due_date', 'created_by'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function subtasks()
    {
        return $this->hasMany(Subtask::class);
    }

    public function checklists()
    {
        return $this->hasMany(TaskChecklist::class);
    }

    public function assignees()
    {
        return $this->hasMany(TaskAssignee::class);
    }

    public function comments()
    {
        return $this->hasMany(TaskComment::class);
    }

    public function files()
    {
        return $this->hasMany(TaskFile::class);
    }

    public function activities()
    {
        return $this->hasMany(TaskActivity::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'task_tags');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
