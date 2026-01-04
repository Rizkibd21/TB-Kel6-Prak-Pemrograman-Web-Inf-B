<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AttendanceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $attendances = $user->attendances()->with(['schedule.subject', 'schedule.classroom'])->latest()->paginate(10);

        return view('student.attendance.history', compact('attendances'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'lat' => 'nullable|string',
            'long' => 'nullable|string',
        ]);

        $user = Auth::user();
        $date = Carbon::today()->toDateString();
        $schedule = Schedule::findOrFail($request->schedule_id);

        // 1. Check if user is enrolled in this class
        if (! $user->classrooms->contains($schedule->classroom_id)) {
            return back()->with('error', 'Anda tidak terdaftar di kelas ini.');
        }

        // 2. Check if Session is Open
        $cacheKey = "attendance_session_{$schedule->id}_{$date}";
        if (! Cache::has($cacheKey)) {
            // Fallback: Check strictly by time if session management isn't used?
            // For this requirements, let's enforce "Dosen must open session" OR "Current Time is within Schedule"
            // Let's allow strictly time-based if cache is missing, for robustness.
            $now = Carbon::now();
            $startTime = Carbon::parse($schedule->start_time);
            $endTime = Carbon::parse($schedule->end_time);

            // Check Day (in English)
            // Simple mapping or assuming DB stores 'Monday' etc.
            return back()->with('error', 'Sesi absensi belum dibuka oleh Dosen.');
        }

        // 3. Check for existing attendance
        $exists = Attendance::where('schedule_id', $schedule->id)
            ->where('user_id', $user->id)
            ->where('date', $date)
            ->exists();

        if ($exists) {
            return back()->with('info', 'Anda sudah melakukan absensi hari ini.');
        }

        // Calculate Status based on Tolerance
        $startTime = Carbon::parse($schedule->start_time);
        $tolerance = \App\Models\Setting::get('attendance_tolerance', 15);
        $maxTime = $startTime->copy()->addMinutes((int) $tolerance);
        $status = Carbon::now()->gt($maxTime) ? 'alfa' : 'hadir'; // If late > tolerance, mark as alfa or maybe 'terlambat' (but requirement only says hadir/izin/sakit/alfa). Let's mark as 'hadir' but maybe add note? Or if strictly late > tolerance = Alfa?
        // Usually, Late = Hadir but flagged.
        // Requirements say: Status (hadir, izin, sakit, alfa).
        // Let's implement: If time > Start Time + Tolerance, then Status = 'alfa' (considered absent because too late) OR prompt user they are late.
        // For 'SIAkad', usually late check-in is either rejected or marked 'hadir' with note.
        // Let's strictly follow: If > Tolerance, reject or mark Alfa.
        // User prompt says "System Settings (Attendance Time, Tolerance)".
        // Interpretation: If outside tolerance, maybe cannot attend?
        // Let's permit it but mark as 'hadir' and add note "Terlambat".
        // Wait, if status must be enum..
        // Let's keep it simple: 'hadir'.
        // Actually, if > Tolerance, usually it means Session Closed? No, Session Open/Close is manual by Dosen.
        // Let's stick to: Always 'hadir' if session is open. Tolerance might just be for display or strictness IF Dosen sets auto-close.
        // But the previous request mentioned "Tolerance".
        // Let's add a logic: If now > start_time + tolerance, append Note "Terlambat".

        $notes = null;
        if (Carbon::now()->gt($maxTime)) {
            $notes = "Terlambat (Lewat toleransi {$tolerance} menit)";
        }

        // 4. Record Attendance
        $attendance = Attendance::create([
            'schedule_id' => $schedule->id,
            'user_id' => $user->id,
            'date' => $date,
            'time_in' => Carbon::now()->toTimeString(),
            'status' => 'hadir', // Default status is always Hadir if they check in.
            'method' => 'manual',
            'lat' => $request->lat,
            'long' => $request->long,
            'notes' => $notes,
        ]);

        // Notification
        $user->notify(new \App\Notifications\AttendanceStatusUpdated($attendance, 'Absensi berhasil direkam! Selamat belajar.'));

        return back()->with('success', 'Absensi berhasil! Selamat belajar.');
    }
}
