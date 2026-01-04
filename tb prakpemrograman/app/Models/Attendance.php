<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'schedule_id',
        'user_id',
        'date',
        'time_in',
        'status',
        'method',
        'lat',
        'long',
        'notes',
        'evidence_file',
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class); // Mahasiswa
    }
}
