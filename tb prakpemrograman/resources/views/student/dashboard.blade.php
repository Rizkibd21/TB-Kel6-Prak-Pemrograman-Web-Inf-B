@extends('layouts.student')

@section('page_title', 'Student Terminal')

@section('content')
<div class="mb-14">
    <div class="flex flex-col xl:flex-row xl:items-end justify-between gap-8">
        <div class="max-w-3xl">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-2 h-2 bg-emerald-500 rounded-full animate-ping"></div>
                <span class="text-[10px] font-black text-emerald-400 uppercase tracking-[0.4em] italic">Student Link: Authenticated</span>
            </div>
            <h2 class="text-6xl font-black text-white tracking-tighter leading-[0.9] mb-6">
                Active Session, <br><span class="header-accent-text !from-emerald-400 !to-cyan-600">{{ Auth::user()->name }}</span>
            </h2>
            <p class="text-blue-200/40 font-bold text-lg uppercase tracking-widest flex items-center gap-3">
                <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                Identity: {{ Auth::user()->id }} // Academic Grid Access
            </p>
        </div>
        
        <div class="hidden xl:block">
            <div class="glass-card !bg-white/[0.02] px-10 py-8 !rounded-[3rem] border-white/5 shadow-2xl relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                <div class="flex items-center gap-8 relative z-10">
                    <div class="w-16 h-16 rounded-[2rem] bg-emerald-600/10 flex items-center justify-center text-emerald-500 border border-emerald-500/20 shadow-lg shadow-emerald-500/10 group-hover:rotate-6 transition-all duration-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-white/20 uppercase tracking-[0.4em] mb-1">Standard Time</p>
                        <p class="text-xl font-black text-white tracking-tighter">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats / Quick Info -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
    <div class="glass-card group !bg-white/[0.02] p-8 !rounded-[3rem] border-white/5 relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-indigo-600/5 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700"></div>
        <div class="relative z-10">
            <h4 class="text-blue-200/40 text-[10px] font-black uppercase tracking-[0.4em] mb-4">Total Presence</h4>
            <div class="text-5xl font-black text-white mt-2 tracking-tighter">
                {{ auth()->user()->attendances()->where('status', 'hadir')->count() }} <span class="text-lg text-emerald-500 uppercase tracking-widest ml-2">Units</span>
            </div>
            <p class="text-[9px] font-black text-white/10 uppercase tracking-widest mt-6">Current Semester Log</p>
        </div>
    </div>
    
    <div class="glass-card group !bg-white/[0.02] p-8 !rounded-[3rem] border-white/5 relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-emerald-600/5 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700"></div>
        <div class="relative z-10">
            <h4 class="text-blue-200/40 text-[10px] font-black uppercase tracking-[0.4em] mb-4">Active Modules</h4>
            <div class="text-5xl font-black text-white mt-2 tracking-tighter">
                {{ auth()->user()->classrooms()->count() }} <span class="text-lg text-emerald-500 uppercase tracking-widest ml-2">Classes</span>
            </div>
             <p class="text-[9px] font-black text-white/10 uppercase tracking-widest mt-6">Registered Curriculum</p>
        </div>
    </div>
</div>

<div class="flex items-center gap-6 mb-12">
    <div class="h-10 w-1 bg-gradient-to-b from-emerald-500 to-cyan-600 rounded-full shadow-[0_0_20px_rgba(16,185,129,0.5)]"></div>
    <div>
        <h3 class="text-2xl font-black text-white uppercase tracking-tighter leading-none">TODAY'S PROTOCOLS</h3>
        <p class="text-[9px] font-black text-emerald-400/40 uppercase tracking-[0.4em] mt-1 italic">Active Academic Schedules</p>
    </div>
</div>

@if($schedules->count() > 0)
    <div class="space-y-6">
        @foreach($schedules as $schedule)
        <div class="glass-card group !bg-white/[0.02] p-8 !rounded-[3.5rem] border-white/5 flex flex-col md:flex-row justify-between items-center transition-all duration-700 hover:!bg-white/[0.04]">
            <div class="flex-1 w-full">
                <div class="flex items-center gap-4 mb-6">
                    <span class="px-5 py-2 rounded-2xl bg-emerald-500/10 text-emerald-400 text-[10px] font-black uppercase tracking-[0.2em] border border-emerald-500/20 italic">
                        {{ $schedule->day }}
                    </span>
                    <div class="flex items-center gap-3 px-4 py-2 bg-white/5 rounded-2xl border border-white/5">
                        <div class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></div>
                        <span class="text-[10px] font-black text-white/50 tracking-widest">
                            {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} — {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                        </span>
                    </div>
                </div>
                <h3 class="text-3xl font-black text-white mb-2 tracking-tighter group-hover:text-emerald-400 transition-colors duration-500">{{ $schedule->subject->name }}</h3>
                <div class="flex items-center gap-4">
                    <p class="text-[10px] font-black text-white/40 uppercase tracking-[0.2em] flex items-center">
                        <span class="w-4 h-px bg-white/20 mr-3"></span>
                        {{ $schedule->classroom->name }} // {{ $schedule->teacher->name }}
                    </p>
                </div>
            </div>
            
            <div class="mt-8 md:mt-0 w-full md:w-auto">
                <form action="{{ route('student.attendance.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
                    <button type="submit" class="btn-premium !rounded-[2rem] px-12 !py-5 flex items-center justify-center gap-4 !from-emerald-600 !to-teal-600 shadow-xl shadow-emerald-500/10 group/btn">
                        <span class="text-[11px] font-black uppercase tracking-[0.2em]">INITIALIZE ATTENDANCE</span>
                        <svg class="w-5 h-5 group-hover/btn:translate-x-2 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4-4m4-4H3"></path></svg>
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
@else
    <div class="glass-card !bg-white/[0.02] p-24 rounded-[4.5rem] border-white/5 border-dashed border-2 text-center max-w-3xl mx-auto">
        <div class="w-24 h-24 rounded-[2.5rem] bg-white/5 flex items-center justify-center mx-auto mb-8 border border-white/10 group animate-float shadow-xl shadow-emerald-500/5">
            <svg class="w-12 h-12 text-emerald-400/40 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
        </div>
        <h3 class="text-3xl font-black text-white mb-4 tracking-tighter uppercase">NO ACTIVE PROTOCOLS</h3>
        <p class="text-blue-200/40 font-bold uppercase tracking-widest text-sm leading-relaxed max-w-sm mx-auto italic">
            Zero academic tasks detected for this cycle. // Enjoy the free time.
        </p>
    </div>
@endif

<div class="mt-20 glass-card group !bg-white/[0.02] p-10 !rounded-[3.5rem] border-white/5 border-emerald-500/10 border-2 flex flex-col sm:flex-row items-center justify-between gap-8 relative overflow-hidden hover:!bg-white/[0.04] transition-all duration-700">
    <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/5 to-transparent"></div>
    <div class="relative z-10 text-center sm:text-left">
        <h3 class="text-2xl font-black text-white uppercase tracking-tighter">PRESENCE ANALYTICS</h3>
        <p class="text-[10px] font-black text-blue-200/40 uppercase tracking-[0.3em] mt-1">Review your full academic attendance log.</p>
    </div>
    <a href="{{ route('student.attendance.history') }}" class="relative z-10 px-8 py-4 bg-white/5 rounded-2xl border border-white/10 text-[10px] font-black text-white uppercase tracking-[0.2em] hover:bg-white/10 transition-all duration-500">Access History Data &rarr;</a>
</div>
@endsection
