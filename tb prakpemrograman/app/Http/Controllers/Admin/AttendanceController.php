<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Classroom;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $query = Attendance::with(['user', 'schedule.subject', 'schedule.classroom', 'schedule.teacher']);

        // Filters
        if ($request->has('date') && $request->date != '') {
            $query->where('date', $request->date);
        }

        if ($request->has('classroom_id') && $request->classroom_id != '') {
            $query->whereHas('schedule', function ($q) use ($request) {
                $q->where('classroom_id', $request->classroom_id);
            });
        }

        $attendances = $query->latest()->paginate(20);
        $classrooms = Classroom::all();

        return view('admin.attendances.index', compact('attendances', 'classrooms'));
    }

    public function edit(Attendance $attendance)
    {
        return view('admin.attendances.edit', compact('attendance'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $validated = $request->validate([
            'status' => 'required|in:hadir,izin,sakit,alfa',
            'notes' => 'nullable|string',
        ]);

        $attendance->update($validated);

        // Notify student if status changed? Maybe.

        return redirect()->route('admin.attendances.index')->with('success', 'Data absensi diperbarui.');
    }

    public function export(Request $request)
    {
        $fileName = 'rekap_absensi_'.date('Y-m-d_H-i-s').'.csv';
        $attendances = Attendance::with(['user', 'schedule.subject', 'schedule.classroom', 'schedule.teacher'])
            ->latest()
            ->get();

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$fileName",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $columns = ['Tanggal', 'Nama Mahasiswa', 'NIM', 'Kelas', 'Mata Kuliah', 'Dosen', 'Waktu Masuk', 'Status', 'Catatan'];

        $callback = function () use ($attendances, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($attendances as $row) {
                fputcsv($file, [
                    $row->date,
                    $row->user->name,
                    $row->user->nim ?? '-',
                    $row->schedule->classroom->name ?? '-',
                    $row->schedule->subject->name ?? '-',
                    $row->schedule->teacher->name ?? '-',
                    $row->time_in ?? '-',
                    strtoupper($row->status),
                    $row->notes ?? '',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
