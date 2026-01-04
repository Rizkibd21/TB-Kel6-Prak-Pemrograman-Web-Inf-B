@extends('layouts.dosen')

@section('page_title', 'Lecturer Terminal')

@section('content')
<div class="mb-14">
    <div class="flex flex-col xl:flex-row xl:items-end justify-between gap-8">
        <div class="max-w-3xl">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-2 h-2 bg-pink-500 rounded-full animate-ping"></div>
                <span class="text-[10px] font-black text-pink-400 uppercase tracking-[0.4em] italic">System Node: Active</span>
            </div>
            <h2 class="text-6xl font-black text-white tracking-tighter leading-[0.9] mb-6">
                Welcome, <br><span class="header-accent-text !from-pink-400 !to-rose-600">{{ Auth::user()->name }}</span>
            </h2>
            <p class="text-blue-200/40 font-bold text-lg uppercase tracking-widest flex items-center gap-3">
                <svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                Lecturer ID: {{ Auth::user()->id }} // Faculty Core Access
            </p>
        </div>
        
        <div class="hidden xl:block">
            <div class="glass-card !bg-white/[0.02] px-10 py-8 !rounded-[3rem] border-white/5 shadow-2xl relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-br from-pink-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                <div class="flex items-center gap-8 relative z-10">
                    <div class="w-16 h-16 rounded-[2rem] bg-pink-600/10 flex items-center justify-center text-pink-500 border border-pink-500/20 shadow-lg shadow-pink-500/10 group-hover:rotate-6 transition-all duration-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-white/20 uppercase tracking-[0.4em] mb-1">Current Cycle</p>
                        <p class="text-xl font-black text-white tracking-tighter">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Teaching Schedule -->
<div class="flex items-center gap-6 mb-12">
    <div class="h-10 w-1 bg-gradient-to-b from-pink-500 to-rose-600 rounded-full shadow-[0_0_20px_rgba(236,72,153,0.5)]"></div>
    <div>
        <h3 class="text-2xl font-black text-white uppercase tracking-tighter leading-none">ACTIVE SCHEDULE</h3>
        <p class="text-[9px] font-black text-pink-400/40 uppercase tracking-[0.4em] mt-1 italic">Authorized Teaching Terminal</p>
    </div>
</div>

@if($schedules->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-20 px-1">
        @foreach($schedules as $schedule)
        <div class="glass-card group !bg-white/[0.02] !rounded-[3.5rem] p-8 border-white/5 transition-all duration-700 hover:!bg-white/[0.04]">
            <div class="flex items-center justify-between mb-10">
                <span class="px-5 py-2 rounded-2xl bg-pink-500/10 text-pink-400 text-[10px] font-black uppercase tracking-[0.2em] border border-pink-500/20 italic">{{ $schedule->day }}</span>
                <div class="flex items-center gap-3 px-4 py-2 bg-white/5 rounded-2xl border border-white/5">
                    <div class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></div>
                    <span class="text-[10px] font-black text-white/50 tracking-widest">{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}</span>
                </div>
            </div>
            
            <h3 class="text-3xl font-black text-white mb-4 tracking-tighter leading-tight group-hover:text-pink-400 transition-colors duration-500">
                {{ $schedule->subject->name }}
            </h3>
            
            <div class="space-y-4 mb-10">
                <div class="flex items-center gap-4 p-5 bg-white/[0.02] rounded-[2rem] border border-white/5 group-hover:bg-white/[0.04] transition-colors">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-600/10 flex items-center justify-center text-indigo-400 border border-indigo-400/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <div>
                        <p class="text-[9px] font-black text-white/20 uppercase tracking-[0.3em] mb-0.5">LOCATION TERMINAL</p>
                        <p class="text-sm font-black text-white uppercase tracking-widest">{{ $schedule->classroom->name }} — RUANG {{ $schedule->room ?? 'ALPHA' }}</p>
                    </div>
                </div>
            </div>
            
            <a href="{{ route('dosen.attendance.index', $schedule) }}" class="btn-premium !rounded-[2rem] !py-5 flex items-center justify-center gap-4 group/btn !from-pink-600 !to-rose-600 shadow-xl shadow-pink-500/10">
                <span class="text-[11px] font-black uppercase tracking-[0.2em]">INITIALIZE ATTENDANCE</span>
                <svg class="w-5 h-5 group-hover/btn:translate-x-2 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>
        @endforeach
    </div>
@else
    <div class="glass-card !bg-white/[0.02] p-24 rounded-[4.5rem] border-white/5 border-dashed border-2 text-center max-w-3xl mx-auto mb-20">
        <div class="w-24 h-24 rounded-[2.5rem] bg-white/5 flex items-center justify-center mx-auto mb-8 border border-white/10 group animate-float shadow-xl shadow-pink-500/5">
            <svg class="w-12 h-12 text-pink-400/40 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <h3 class="text-3xl font-black text-white mb-4 tracking-tighter uppercase">NO ACTIVE PROTOCOLS</h3>
        <p class="text-blue-200/40 font-bold uppercase tracking-widest text-sm leading-relaxed max-w-sm mx-auto italic">
            All teaching tasks for this cycle are completed. // Terminal standby.
        </p>
    </div>
@endif

@if($advisedClasses->count() > 0)
<div class="pb-20">
    <div class="flex items-center gap-6 mb-12">
        <div class="h-10 w-1 bg-gradient-to-b from-indigo-500 to-violet-600 rounded-full shadow-[0_0_20px_rgba(99,102,241,0.5)]"></div>
        <div>
            <h3 class="text-2xl font-black text-white uppercase tracking-tighter leading-none">ADVISORY GROUPS</h3>
            <p class="text-[9px] font-black text-indigo-400/40 uppercase tracking-[0.4em] mt-1 italic">Student Core Management</p>
        </div>
    </div>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        @foreach($advisedClasses as $class)
        <div class="glass-card group !bg-white/[0.02] !rounded-[3.5rem] p-8 border-white/5 hover:!bg-white/[0.04] transition-all duration-700 overflow-hidden relative">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-indigo-600/5 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700"></div>
            
            <div class="w-20 h-20 rounded-[2rem] bg-indigo-600/10 flex items-center justify-center text-indigo-400 border border-indigo-400/20 mb-8 shadow-lg shadow-indigo-500/5 group-hover:rotate-6 transition-all duration-500">
                 <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            
            <p class="text-[10px] font-black text-white/20 uppercase tracking-[0.4em] mb-2 leading-none">SECTOR CLASS</p>
            <h4 class="text-4xl font-black text-white uppercase tracking-tighter mb-10 group-hover:text-indigo-400 transition-colors">{{ $class->name }}</h4>
            
            <div class="bg-white/5 rounded-[2.5rem] p-6 border-white/5 border backdrop-blur-3xl">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex flex-col">
                        <span class="text-[11px] font-black text-white tracking-widest uppercase">{{ $class->students()->count() }} UNITS</span>
                        <span class="text-[8px] font-black text-white/20 uppercase tracking-[0.3em]">ACTIVE STUDENTS</span>
                    </div>
                    <div class="flex items-center gap-2 bg-emerald-500/10 px-3 py-1.5 rounded-2xl border border-emerald-500/20">
                        <div class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></div>
                        <span class="text-[9px] font-black text-emerald-400 uppercase tracking-tighter">SECURE</span>
                    </div>
                </div>
                
                <div class="flex -space-x-3">
                    @php $displayCount = min($class->students()->count(), 4); @endphp
                    @for($i = 0; $i < $displayCount; $i++)
                        <div class="w-10 h-10 rounded-2xl border-4 border-slate-900 bg-white/5 flex items-center justify-center text-white/40 shadow-xl overflow-hidden backdrop-blur-md">
                            <img src="https://ui-avatars.com/api/?name=User&background=1e293b&color=475569" class="w-full h-full object-cover">
                        </div>
                    @endfor
                    @if($class->students()->count() > 4)
                        <div class="w-10 h-10 rounded-2xl border-4 border-slate-900 bg-indigo-600 flex items-center justify-center text-[10px] font-black text-white shadow-xl shadow-indigo-600/20">
                            +{{ $class->students()->count() - 4 }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

@endsection
