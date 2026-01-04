<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('teacher')->paginate(10);

        return view('student.courses.index', compact('courses'));
    }

    public function enroll(Course $course)
    {
        if (! Auth::user()->courses->contains($course->id)) {
            Auth::user()->courses()->attach($course->id);

            return redirect()->route('student.courses.show', $course->id)->with('success', 'Enrolled successfully!');
        }

        return back()->with('info', 'Already enrolled.');
    }

    public function show(Course $course)
    {
        if (! Auth::user()->courses->contains($course->id)) {
            return redirect()->route('student.courses.index')->with('error', 'You must enroll first.');
        }

        $course->load('materials', 'teacher');

        return view('student.courses.show', compact('course'));
    }
}
