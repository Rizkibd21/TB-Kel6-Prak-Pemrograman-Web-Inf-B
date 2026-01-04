<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        return view('dosen.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('dosen.courses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Course::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'teacher_id' => Auth::id(),
        ]);

        return redirect()->route('dosen.courses.index')->with('success', 'Course created successfully.');
    }

    public function show(string $id)
    {
        $course = Course::where('teacher_id', Auth::id())->with('materials')->findOrFail($id);

        return view('dosen.courses.show', compact('course'));
    }

    public function edit(string $id)
    {
        $course = Course::where('teacher_id', Auth::id())->findOrFail($id);

        return view('dosen.courses.edit', compact('course'));
    }

    public function update(Request $request, string $id)
    {
        $course = Course::where('teacher_id', Auth::id())->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $course->update($validated);

        return redirect()->route('dosen.courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroy(string $id)
    {
        $course = Course::where('teacher_id', Auth::id())->findOrFail($id);
        $course->delete();

        return redirect()->route('dosen.courses.index')->with('success', 'Course deleted successfully.');
    }
}
