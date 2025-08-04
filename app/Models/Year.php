<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Year extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'level_id', 'image'];
    

    protected static function booted()
{
    static::creating(function ($year) {
        $year->slug = Str::slug($year->name . '-' . uniqid());
    });

    static::updating(function ($year) {
        $year->slug = Str::slug($year->name . '-' . uniqid());
    });
}
    public function level()
    {
        return $this->belongsTo(\App\Models\Level::class);
    }
    public function materials()
    {
        return $this->hasMany(StudyMaterial::class);
    }
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }
    public function getRouteKeyName()
{
    return 'slug';
}
}
