<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
