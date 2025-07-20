<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'read'
    ];

    // Add this scope
    public function scopeUnread($query)
    {
        return $query->where('read', false);
    }
}
