<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $fillable = ['name', 'academic_year_id', 'advisor_id'];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function advisor()
    {
        return $this->belongsTo(User::class, 'advisor_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'classroom_user', 'classroom_id', 'user_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
