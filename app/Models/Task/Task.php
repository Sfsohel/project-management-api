<?php

namespace App\Models\Task;

use App\Models\Project\Module;
use App\Models\Project\Page;
use App\Models\Project\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function task_movement()
    {
        return $this->hasMany(TaskMovement::class);
    }
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function module()
    {
        return $this->belongsTo(Module::class);
    }
    public function page()
    {
        return $this->belongsTo(Page::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
