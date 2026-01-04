@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Pengaturan Sistem</h2>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Form Pengaturan -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-bold text-gray-700 mb-4">Konfigurasi Umum</h3>
        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            
             <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Kampus / Aplikasi</label>
                <input type="text" name="settings[school_name]" value="{{ \App\Models\Setting::get('school_name', 'SIAkad') }}" class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Toleransi Keterlambatan Absensi (Menit)</label>
                <input type="number" name="settings[attendance_tolerance]" value="{{ \App\Models\Setting::get('attendance_tolerance', 15) }}" class="w-full border rounded px-3 py-2">
                <p class="text-xs text-gray-500 mt-1">Jika mahasiswa absen lewat dari waktu mulai jadwal + toleransi, akan ditandai di catatan.</p>
            </div>
            
            <div class="flex justify-end">
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Simpan Pengaturan</button>
            </div>
        </form>
    </div>

    <!-- Backup & Maintenance -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-bold text-gray-700 mb-4">Backup & Maintenance</h3>
        <p class="text-gray-600 mb-4">Unduh backup database (SQL Dump) untuk keamanan data.</p>
        
        <div class="border-t pt-4">
            <a href="{{ route('admin.settings.backup') }}" class="flex items-center justify-center w-full px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-900 transition">
                <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Download Database Backup
            </a>
            <p class="text-xs text-gray-500 mt-2 text-center">Pastikan 'mysqldump' terinstall di server (Laragon default enabled).</p>
        </div>
    </div>
</div>
@endsection
