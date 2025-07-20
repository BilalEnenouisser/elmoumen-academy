<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Level extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function years()
    {
        return $this->hasMany(\App\Models\Year::class);
    }

    public function fields()
    {
        return $this->hasMany(Field::class);
    }

    public function materials()
    {
        return $this->hasMany(StudyMaterial::class);
    }

    protected static function booted()
{
    static::creating(function ($level) {
        $level->slug = Str::slug($level->name);
    });

    static::updating(function ($level) {
        $level->slug = Str::slug($level->name);
    });
}
    public function getRouteKeyName()
{
    return 'slug';
}
}
