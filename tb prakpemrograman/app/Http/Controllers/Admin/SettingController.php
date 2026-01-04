<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all();

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'settings' => 'required|array',
            'settings.*' => 'required',
        ]);

        foreach ($validated['settings'] as $key => $value) {
            Setting::where('key', $key)->update(['value' => $value]);
        }

        return back()->with('success', 'Pengaturan sistem diperbarui.');
    }

    public function backup()
    {
        // Simple Database Backup via mysqldump logic
        // Only works for MySQL and if mysqldump is in PATH or known location

        $filename = 'backup-'.date('Y-m-d_H-i-s').'.sql';
        $headers = [
            'Content-Type' => 'application/x-sql',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        // Retrieve env variables
        $dbDatabase = env('DB_DATABASE');
        $dbUser = env('DB_USERNAME');
        $dbPassword = env('DB_PASSWORD');
        $dbHost = env('DB_HOST', '127.0.0.1');

        // Command for mysqldump (Windows specific adjustment might be needed if not in PATH)
        // Trying generic command first.
        // Important: Provide empty password string if none.
        $passwordCmd = $dbPassword ? "-p\"$dbPassword\"" : '';

        // Note: Using --no-tablespaces is often required for modern mariadb/mysql without specific privs
        $command = "mysqldump --user=\"$dbUser\" $passwordCmd --host=\"$dbHost\" \"$dbDatabase\"";

        // Execute
        $output = [];
        $resultCode = null;

        // We can't really stream output directly from exec easily in Laravel response stream without temp file
        // Let's use Symfony Process or just exec and capture output if small, or redirect to file then download

        // Strategy: Redirect to temp file
        $tempFile = storage_path("app/backups/$filename");
        if (! file_exists(storage_path('app/backups'))) {
            mkdir(storage_path('app/backups'), 0755, true);
        }

        // Construct command with redirection
        // Windows 'mysqldump ... > file.sql'
        $command .= " > \"$tempFile\"";

        // For safety/security, we should be careful with exec.
        // In a real production app, use Spatie Backup. Here, we try simple approach.
        // Assuming Laragon environment has mysqldump in path.

        system($command, $resultCode);

        if ($resultCode === 0 && file_exists($tempFile)) {
            return response()->download($tempFile)->deleteFileAfterSend(true);
        } else {
            return back()->with('error', "Backup gagal. Pastikan mysqldump terinstall dan dapat diakses. Code: $resultCode");
        }
    }
}
