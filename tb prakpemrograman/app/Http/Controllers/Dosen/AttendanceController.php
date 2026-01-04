<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Schedule;
// Student
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AttendanceController extends Controller
{
    public function index(Schedule $schedule, Request $request)
    {
        // View attendance for a specific date (default today)
        $date = $request->query('date', Carbon::today()->toDateString());

        $attendances = Attendance::where('schedule_id', $schedule->id)
            ->where('date', $date)
            ->with('user')
            ->get()
            ->keyBy('user_id');

        // Get all students in this class
        $students = $schedule->classroom->students;

        // Check session status
        $cacheKey = "attendance_session_{$schedule->id}_{$date}";
        $isSessionOpen = Cache::has($cacheKey);

        return view('dosen.attendance.index', compact('schedule', 'students', 'attendances', 'date', 'isSessionOpen'));
    }

    public function open(Schedule $schedule)
    {
        $date = Carbon::today()->toDateString();
        $cacheKey = "attendance_session_{$schedule->id}_{$date}";

        // Open for 2 hours (or until manually closed)
        Cache::put($cacheKey, true, now()->addHours(2));

        return back()->with('success', 'Sesi absensi dibuka. Mahasiswa dapat melakukan absen sekarang.');
    }

    public function close(Schedule $schedule)
    {
        $date = Carbon::today()->toDateString();
        $cacheKey = "attendance_session_{$schedule->id}_{$date}";

        Cache::forget($cacheKey);

        return back()->with('success', 'Sesi absensi ditutup.');
    }

    public function validateAttendance(Attendance $attendance, Request $request)
    {
        $request->validate([
            'status' => 'required|in:hadir,izin,sakit,alfa',
        ]);

        $attendance->update(['status' => $request->status]);

        // Notification
        $attendance->user->notify(new \App\Notifications\AttendanceStatusUpdated($attendance));

        return back()->with('success', 'Status absensi diperbarui.');
    }

    public function export(Schedule $schedule)
    {
        $attendances = Attendance::where('schedule_id', $schedule->id)
            ->with('user')
            ->orderBy('date', 'desc')
            ->get();

        $filename = "rekap_absen_{$schedule->subject->name}_{$schedule->classroom->name}_".date('Y-m-d').'.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($attendances) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Tanggal', 'NIM', 'Nama Mahasiswa', 'Jam Masuk', 'Status', 'Catatan']);

            foreach ($attendances as $row) {
                fputcsv($file, [
                    $row->date,
                    $row->user->nim,
                    $row->user->name,
                    $row->time_in ?? '-',
                    ucfirst($row->status),
                    $row->notes ?? '-',
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
