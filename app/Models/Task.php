<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'is_completed',
        'due_date',
    ];

    // ✅ Relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function reports()
{
    return $this->hasMany(Report::class);
}

}
