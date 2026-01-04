<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\Classroom;
use App\Models\User;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index()
    {
        $classrooms = Classroom::with(['academicYear', 'advisor'])->latest()->get();

        return view('admin.classrooms.index', compact('classrooms'));
    }

    public function create()
    {
        $academicYears = AcademicYear::where('is_active', true)->get();
        // Assuming user with role 'dosen' can be advisor
        $lecturers = User::where('role', 'dosen')->get();

        return view('admin.classrooms.create', compact('academicYears', 'lecturers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'academic_year_id' => 'required|exists:academic_years,id',
            'advisor_id' => 'nullable|exists:users,id',
        ]);

        Classroom::create($validated);

        return redirect()->route('admin.classrooms.index')->with('success', 'Kelas berhasil dibuat.');
    }

    public function edit(Classroom $classroom)
    {
        $academicYears = AcademicYear::all();
        $lecturers = User::where('role', 'dosen')->get();

        return view('admin.classrooms.edit', compact('classroom', 'academicYears', 'lecturers'));
    }

    public function update(Request $request, Classroom $classroom)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'academic_year_id' => 'required|exists:academic_years,id',
            'advisor_id' => 'nullable|exists:users,id',
        ]);

        $classroom->update($validated);

        return redirect()->route('admin.classrooms.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy(Classroom $classroom)
    {
        $classroom->delete();

        return redirect()->route('admin.classrooms.index')->with('success', 'Kelas berhasil dihapus.');
    }
}
