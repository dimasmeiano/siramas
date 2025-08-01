<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskChecklist extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'task_checklists';

    protected $fillable = ['task_id', 'item', 'is_checked'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
