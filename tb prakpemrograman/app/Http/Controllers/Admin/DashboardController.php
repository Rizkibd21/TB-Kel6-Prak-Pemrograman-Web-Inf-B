<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Subject;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = User::where('role', 'mahasiswa')->count();
        $totalLecturers = User::where('role', 'dosen')->count();
        $totalClasses = Classroom::count();
        $totalSubjects = Subject::count();

        return view('admin.dashboard', compact('totalStudents', 'totalLecturers', 'totalClasses', 'totalSubjects'));
    }
}
