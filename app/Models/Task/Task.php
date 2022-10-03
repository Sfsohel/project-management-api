<?php

namespace App\Models\Task;

use App\Models\Project\Module;
use App\Models\Project\Page;
use App\Models\Project\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Task extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function task_movement()
    {
        return $this->hasMany(TaskMovement::class);
    }
    public function last_task_movement()
    {
        return $this->hasOne(TaskMovement::class)->where('user_id',Auth::user()->id)->latest();
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
