<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    public function show(Course $course, Assignment $assignment)
    {
        $submission = $assignment->submissions()->where('user_id', Auth::id())->first();

        return view('student.assignments.show', compact('course', 'assignment', 'submission'));
    }

    public function store(Request $request, Course $course, Assignment $assignment)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx,zip|max:10240', // 10MB
        ]);

        $path = $request->file('file')->store('submissions', 'public');

        $assignment->submissions()->updateOrCreate(
            ['user_id' => Auth::id()],
            ['file_path' => $path]
        );

        return back()->with('success', 'Assignment submitted!');
    }
}
