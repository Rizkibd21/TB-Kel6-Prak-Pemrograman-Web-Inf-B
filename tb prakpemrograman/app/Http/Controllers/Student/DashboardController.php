<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get all classrooms the student is in
        $classrooms = $user->classrooms;
        $classroomIds = $classrooms->pluck('id');

        // Get schedules for those classrooms
        $schedules = Schedule::whereIn('classroom_id', $classroomIds)
            ->with(['subject', 'teacher', 'classroom'])
            ->orderBy('day')
            ->orderBy('start_time')
            ->get();

        return view('student.dashboard', compact('schedules', 'classrooms'));
    }
}
