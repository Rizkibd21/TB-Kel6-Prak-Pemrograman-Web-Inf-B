<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Eager load relationships for efficiency
        $schedules = $user->teachingSchedules()->with(['classroom', 'subject'])->get();
        $advisedClasses = $user->advisedClassrooms; // Wali Dosen

        return view('dosen.dashboard', compact('schedules', 'advisedClasses'));
    }
}
