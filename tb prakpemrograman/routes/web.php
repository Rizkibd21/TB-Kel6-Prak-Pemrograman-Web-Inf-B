<?php

use App\Http\Controllers\Admin\AcademicYearController;
use App\Http\Controllers\Admin\ClassroomController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        if ($user->role === 'dosen') {
            return redirect()->route('dosen.dashboard');
        }
        if ($user->role === 'mahasiswa') {
            return redirect()->route('student.dashboard');
        }

        return abort(403);
    })->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Notifications
    Route::get('/notifications', [\App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/mark-read', [\App\Http\Controllers\NotificationController::class, 'markAllRead'])->name('notifications.markAllRead');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::resource('academic-years', AcademicYearController::class);
    Route::resource('subjects', SubjectController::class);
    Route::resource('classrooms', ClassroomController::class);
    Route::resource('schedules', ScheduleController::class);

    // Users
    Route::post('users/import', [UserController::class, 'import'])->name('users.import');
    Route::resource('users', UserController::class);

    // Attendance
    Route::get('attendances/export', [\App\Http\Controllers\Admin\AttendanceController::class, 'export'])->name('attendances.export');
    Route::resource('attendances', \App\Http\Controllers\Admin\AttendanceController::class)->only(['index', 'edit', 'update']);

    // Settings
    Route::get('settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
    Route::get('settings/backup', [\App\Http\Controllers\Admin\SettingController::class, 'backup'])->name('settings.backup');
});

// Dosen Routes
Route::middleware(['auth', 'dosen'])->prefix('dosen')->name('dosen.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Dosen\DashboardController::class, 'index'])->name('dashboard');

    // Attendance Operations
    Route::get('/schedules/{schedule}/attendance', [\App\Http\Controllers\Dosen\AttendanceController::class, 'index'])->name('attendance.index'); // List meetings/students
    Route::post('/schedules/{schedule}/attendance/open', [\App\Http\Controllers\Dosen\AttendanceController::class, 'open'])->name('attendance.open');
    Route::post('/schedules/{schedule}/attendance/close', [\App\Http\Controllers\Dosen\AttendanceController::class, 'close'])->name('attendance.close');
    Route::get('/schedules/{schedule}/attendance/export', [\App\Http\Controllers\Dosen\AttendanceController::class, 'export'])->name('attendance.export');
    Route::post('/attendance/{attendance}/validate', [\App\Http\Controllers\Dosen\AttendanceController::class, 'validateAttendance'])->name('attendance.validate'); // Approve izin/sakit
});

// Student Routes
Route::middleware(['auth', 'mahasiswa'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Student\DashboardController::class, 'index'])->name('dashboard');

    Route::post('/attendance/checkin', [\App\Http\Controllers\Student\AttendanceController::class, 'store'])->name('attendance.store');
    Route::get('/attendance/history', [\App\Http\Controllers\Student\AttendanceController::class, 'index'])->name('attendance.history');
});
