<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Field extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'level_id'];
    
    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function materials()
    {
        return $this->hasMany(StudyMaterial::class);
    }

    protected static function booted()
    {
        static::creating(function ($field) {
            $field->slug = Str::slug($field->name . '-' . uniqid());
        });

        static::updating(function ($field) {
            $field->slug = Str::slug($field->name . '-' . uniqid());
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
