<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with(['subject', 'classroom', 'teacher'])->latest()->get();

        return view('admin.schedules.index', compact('schedules'));
    }

    public function create()
    {
        $subjects = Subject::all();
        $classrooms = Classroom::all();
        $lecturers = User::where('role', 'dosen')->get();

        return view('admin.schedules.create', compact('subjects', 'classrooms', 'lecturers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'user_id' => 'required|exists:users,id',
            'day' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required',
            'room' => 'nullable|string',
        ]);

        Schedule::create($validated);

        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal berhasil dibuat.');
    }

    public function edit(Schedule $schedule)
    {
        $subjects = Subject::all();
        $classrooms = Classroom::all();
        $lecturers = User::where('role', 'dosen')->get();

        return view('admin.schedules.edit', compact('schedule', 'subjects', 'classrooms', 'lecturers'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'user_id' => 'required|exists:users,id',
            'day' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required',
            'room' => 'nullable|string',
        ]);

        $schedule->update($validated);

        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('admin.schedules.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
