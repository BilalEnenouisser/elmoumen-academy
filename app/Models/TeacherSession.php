<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'session_id',
        'last_activity'
    ];

    protected $casts = [
        'last_activity' => 'datetime'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
