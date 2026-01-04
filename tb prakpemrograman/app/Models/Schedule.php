<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'subject_id',
        'classroom_id',
        'user_id',
        'day',
        'start_time',
        'end_time',
        'room',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
