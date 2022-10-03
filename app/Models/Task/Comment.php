<?php

namespace App\Models\Task;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getAttachmentAttribute($files)
    {
        $files = unserialize($files);
        $newfiles=array();
        foreach ($files as $key => $file) {
            array_push($newfiles,url('/comment_files').'/'.$file);
        }
        return $newfiles;
    }
}
