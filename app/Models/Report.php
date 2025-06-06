<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    /** @use HasFactory<\Database\Factories\ReportFactory> */
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'task_id',
        'content',
        'admin_reply',
        'status',
    ];  

    public function user()
{
    return $this->belongsTo(User::class, 'user_id', 'id');
}

public function task()
{
    return $this->belongsTo(Task::class);
}
}
