<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'level_id'];
    
    public function level()
    {
        return $this->belongsTo(Level::class);
    }
    public function materials()
    {
        return $this->hasMany(StudyMaterial::class);
    }
}
