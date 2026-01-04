<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Course;
use App\Models\Submission;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function create(Course $course)
    {
        return view('dosen.assignments.create', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
        ]);

        $course->assignments()->create($validated);

        return redirect()->route('dosen.courses.show', $course->id)->with('success', 'Assignment created successfully.');
    }

    public function show(Course $course, Assignment $assignment)
    {
        $assignment->load('submissions.user');

        return view('dosen.assignments.show', compact('course', 'assignment'));
    }

    public function grade(Request $request, Course $course, Assignment $assignment, Submission $submission)
    {
        $validated = $request->validate([
            'grade' => 'required|integer|min:0|max:100',
            'feedback' => 'nullable|string',
        ]);

        $submission->update($validated);

        return back()->with('success', 'Grade saved.');
    }
}
