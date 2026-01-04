@extends('layouts.admin')

@section('content')
<div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h2 class="text-4xl font-black text-white tracking-tighter">Admin Dashboard</h2>
        <p class="text-blue-200/40 font-bold uppercase tracking-[0.3em] text-[10px] mt-2 italic">Overview & System Analytics</p>
    </div>
    <div class="flex gap-2">
        <div class="glass px-4 py-2 rounded-2xl flex items-center gap-3">
            <div class="w-2 h-2 bg-emerald-500 rounded-full animate-ping"></div>
            <span class="text-[10px] font-black text-white uppercase tracking-widest">System Online</span>
        </div>
    </div>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    <div class="glass-card p-6 relative overflow-hidden group">
        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform duration-500">
            <svg class="w-16 h-16 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
        </div>
        <h4 class="text-blue-200/40 text-[10px] uppercase font-black tracking-[0.2em]">Mahasiswa</h4>
        <div class="text-4xl font-black text-white mt-2 tracking-tighter">{{ $totalStudents }}</div>
        <div class="mt-4 flex items-center gap-2">
            <span class="text-[10px] font-bold text-indigo-400 bg-indigo-400/10 px-2 py-1 rounded-lg">DATA TERDAFTAR</span>
        </div>
    </div>
    
    <div class="glass-card p-6 relative overflow-hidden group">
        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform duration-500">
            <svg class="w-16 h-16 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
        </div>
        <h4 class="text-blue-200/40 text-[10px] uppercase font-black tracking-[0.2em]">Dosen</h4>
        <div class="text-4xl font-black text-white mt-2 tracking-tighter">{{ $totalLecturers }}</div>
        <div class="mt-4 flex items-center gap-2">
            <span class="text-[10px] font-bold text-rose-400 bg-rose-400/10 px-2 py-1 rounded-lg">TENAGA PENGAJAR</span>
        </div>
    </div>
    
    <div class="glass-card p-6 relative overflow-hidden group">
        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform duration-500">
            <svg class="w-16 h-16 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
        </div>
        <h4 class="text-blue-200/40 text-[10px] uppercase font-black tracking-[0.2em]">Kurikulum</h4>
        <div class="text-4xl font-black text-white mt-2 tracking-tighter">{{ $totalSubjects }}</div>
        <div class="mt-4 flex items-center gap-2">
            <span class="text-[10px] font-bold text-cyan-400 bg-cyan-400/10 px-2 py-1 rounded-lg">MATA KULIAH AKTIF</span>
        </div>
    </div>
    
    <div class="glass-card p-6 relative overflow-hidden group">
        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform duration-500">
            <svg class="w-16 h-16 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
        </div>
        <h4 class="text-blue-200/40 text-[10px] uppercase font-black tracking-[0.2em]">Kelas</h4>
        <div class="text-4xl font-black text-white mt-2 tracking-tighter">{{ $totalClasses }}</div>
        <div class="mt-4 flex items-center gap-2">
            <span class="text-[10px] font-bold text-yellow-500 bg-yellow-500/10 px-2 py-1 rounded-lg">RUANGAN TERPAKAI</span>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Quick Access -->
    <div class="lg:col-span-2 glass-card p-8 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-600/5 rounded-full blur-3xl -z-10"></div>
        <h3 class="text-xl font-black text-white mb-8 flex items-center gap-3">
            <div class="w-1 h-6 bg-indigo-500 rounded-full"></div>
            KONTROL CEPAT
        </h3>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-6">
            <a href="{{ route('admin.users.create') }}" class="quick-action-btn group !bg-white/5 border-white/5">
                <div class="icon-box !bg-indigo-600 !text-white !mb-4 shadow-lg shadow-indigo-600/20">👤</div>
                <span class="text-[10px] font-black text-blue-200 group-hover:text-white transition-colors uppercase tracking-widest text-center">TAMBAH USER</span>
            </a>
            <a href="{{ route('admin.schedules.create') }}" class="quick-action-btn group !bg-white/5 border-white/5">
                <div class="icon-box !bg-cyan-600 !text-white !mb-4 shadow-lg shadow-cyan-600/20">📅</div>
                <span class="text-[10px] font-black text-blue-200 group-hover:text-white transition-colors uppercase tracking-widest text-center">BUAT JADWAL</span>
            </a>
            <a href="{{ route('admin.attendances.index') }}" class="quick-action-btn group !bg-white/5 border-white/5">
                <div class="icon-box !bg-rose-600 !text-white !mb-4 shadow-lg shadow-rose-600/20">📊</div>
                <span class="text-[10px] font-black text-blue-200 group-hover:text-white transition-colors uppercase tracking-widest text-center">REKAP ABSEN</span>
            </a>
             <a href="{{ route('admin.settings.index') }}" class="quick-action-btn group !bg-white/5 border-white/5">
                <div class="icon-box !bg-emerald-600 !text-white !mb-4 shadow-lg shadow-emerald-600/20">⚙️</div>
                <span class="text-[10px] font-black text-blue-200 group-hover:text-white transition-colors uppercase tracking-widest text-center">PENGATURAN</span>
            </a>
        </div>
    </div>
    
    <!-- System Status -->
    <div class="glass-card p-8">
         <h3 class="text-xl font-black text-white mb-8 flex items-center gap-3">
            <div class="w-1 h-6 bg-emerald-500 rounded-full"></div>
            SISTEM
         </h3>
         <div class="space-y-4">
            <div class="p-4 bg-white/[0.03] border border-white/5 rounded-2xl">
                <div class="text-[10px] font-black text-blue-200/40 uppercase tracking-widest mb-1">Tahun Akademik</div>
                <div class="text-sm font-black text-white uppercase">{{ \App\Models\AcademicYear::where('is_active', true)->first()->name ?? 'N/A' }}</div>
            </div>
            <div class="p-4 bg-white/[0.03] border border-white/5 rounded-2xl">
                <div class="text-[10px] font-black text-blue-200/40 uppercase tracking-widest mb-1">Toleransi Absen</div>
                <div class="text-sm font-black text-white uppercase">{{ \App\Models\Setting::get('attendance_tolerance', 15) }} MENIT</div>
            </div>
            <div class="p-4 bg-indigo-600/10 border border-indigo-500/20 rounded-2xl">
                <div class="text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-1">Auto-Backup</div>
                <div class="flex items-center justify-between">
                    <span class="text-xs font-black text-indigo-200 uppercase">Status: Aktif</span>
                    <div class="w-2 h-2 bg-indigo-500 rounded-full animate-pulse"></div>
                </div>
            </div>
         </div>
    </div>
</div>
@endsection

