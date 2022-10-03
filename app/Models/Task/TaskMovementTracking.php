<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskMovementTracking extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['total_time'];

    public function getTotalTimeAttribute()
    {
        $date1 = date_create($this->start_time);
        $date2 = date_create($this->end_time);
        $diff = date_diff($date1,$date2);
        $seconds = strtotime($this->end_time) - strtotime($this->start_time);
        return ["hour"=>$diff->h,"min"=>$diff->i , 'total_hour'=>($seconds / 60 /  60)];
    }
}
