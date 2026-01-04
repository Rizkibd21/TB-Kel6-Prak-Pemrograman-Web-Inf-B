<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'nidn',
        'nim',
        'phone',
        'address',
        'gender',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Role helpers
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isDosen()
    {
        return $this->role === 'dosen';
    }

    public function isMahasiswa()
    {
        return $this->role === 'mahasiswa';
    }

    // Relationships

    // Mahasiswa: Classes they are enrolled in
    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class, 'classroom_user', 'user_id', 'classroom_id');
    }

    // Dosen: Classes they advise (Wali Dosen)
    public function advisedClassrooms()
    {
        return $this->hasMany(Classroom::class, 'advisor_id');
    }

    // Dosen: Schedules they teach
    public function teachingSchedules()
    {
        return $this->hasMany(Schedule::class, 'user_id');
    }

    // Mahasiswa: Attendances
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    // Legacy support (optional, can remove if unused)
    public function courses()
    {
        return $this->belongsToMany(Course::class)->withTimestamps();
    }
}
