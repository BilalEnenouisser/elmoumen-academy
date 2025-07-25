<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Added role attribute
        'email_verified_at',
        'remember_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Analytics relationships
    public function pageViews()
    {
        return $this->hasMany(PageView::class);
    }

    public function pdfDownloads()
    {
        return $this->hasMany(PdfDownload::class);
    }

    public function videoClicks()
    {
        return $this->hasMany(VideoClick::class);
    }

    public function sessions()
    {
        return $this->hasMany(UserSession::class);
    }

    public function teacherActivities()
    {
        return $this->hasMany(TeacherActivity::class);
    }
}
