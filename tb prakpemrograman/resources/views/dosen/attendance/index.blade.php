@extends('layouts.dosen')

@section('content')
<div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
    <div>
        <div class="flex items-center gap-3 mb-1">
             <a href="{{ route('dosen.dashboard') }}" class="p-2 bg-white/60 hover:bg-white rounded-lg transition border border-white/60 shadow-sm text-gray-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="text-3xl font-extrabold text-gray-800 dark:text-gray-100">{{ $schedule->subject->name }}</h2>
        </div>
        <p class="text-gray-600 dark:text-gray-400 font-bold ml-11">{{ $schedule->classroom->name }} • {{ \Carbon\Carbon::parse($date)->format('d F Y') }}</p>
    </div>
    
    <div class="flex items-center gap-3 w-full md:w-auto">
        <form action="{{ route('dosen.attendance.index', $schedule) }}" method="GET" class="flex-1 md:flex-none">
            <input type="date" name="date" value="{{ $date }}" class="w-full bg-white/60 border border-white/60 rounded-xl px-4 py-2 font-bold text-gray-700 shadow-sm focus:ring-2 focus:ring-pink-500 focus:outline-none transition-all" onchange="this.form.submit()">
        </form>
        <a href="{{ route('dosen.attendance.export', $schedule) }}" class="px-6 py-2 bg-green-600 text-white font-extrabold rounded-xl hover:bg-green-700 transition shadow-lg shadow-green-100 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            Export
        </a>
    </div>
</div>

<!-- Session Control -->
@if($date == \Carbon\Carbon::today()->toDateString())
<div class="glass-card p-6 mb-8 flex flex-col md:flex-row justify-between items-center bg-gradient-to-br from-indigo-500/10 to-purple-500/10 border-l-8 border-indigo-600">
    <div class="mb-4 md:mb-0 text-center md:text-left">
        <div class="flex items-center justify-center md:justify-start gap-3 mb-1">
            <div class="w-3 h-3 rounded-full {{ $isSessionOpen ? 'bg-green-500 animate-pulse' : 'bg-red-500' }}"></div>
            <h3 class="font-extrabold text-indigo-900 text-xl tracking-tight">Status Sesi: {{ $isSessionOpen ? 'DIBUKA' : 'DITUTUP' }}</h3>
        </div>
        <p class="text-sm font-bold text-indigo-600/80">Mahasiswa hanya dapat melakukan absensi mandiri saat sesi dibuka.</p>
    </div>
    
    <div class="w-full md:w-auto">
        @if($isSessionOpen)
        <form action="{{ route('dosen.attendance.close', $schedule) }}" method="POST">
            @csrf
            <button type="submit" class="w-full px-8 py-3 bg-red-600 text-white font-extrabold rounded-xl hover:bg-red-700 transition shadow-xl shadow-red-100 transform active:scale-95">
                Tutup Sesi Sekarang
            </button>
        </form>
        @else
        <form action="{{ route('dosen.attendance.open', $schedule) }}" method="POST">
            @csrf
            <button type="submit" class="w-full px-8 py-3 bg-indigo-600 text-white font-extrabold rounded-xl hover:bg-indigo-700 transition shadow-xl shadow-indigo-100 transform active:scale-95">
                Buka Sesi Absensi
            </button>
        </form>
        @endif
    </div>
</div>
@endif

<!-- Attendance List -->
<div class="glass overflow-hidden rounded-2xl shadow-2xl border border-white/60">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200/50 table-glass">
            <thead>
                <tr class="bg-gray-50/50">
                    <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-500 uppercase tracking-widest">Mahasiswa</th>
                    <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-500 uppercase tracking-widest">Waktu Masuk</th>
                    <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-500 uppercase tracking-widest">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-500 uppercase tracking-widest text-center">Validasi / Ubah</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100/50 bg-white/40">
                @foreach($students as $student)
                    @php
                        $attendance = $attendances[$student->id] ?? null;
                    @endphp
                <tr class="hover:bg-white/60 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-extrabold border-2 border-white shadow-sm mr-3">
                                {{ substr($student->name, 0, 1) }}
                            </div>
                            <div>
                                <div class="text-sm font-extrabold text-gray-900">{{ $student->name }}</div>
                                <div class="text-xs font-bold text-gray-500 uppercase tracking-tighter">{{ $student->nim }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm font-bold text-gray-600 {{ $attendance && $attendance->notes ? 'text-red-500' : '' }}">
                            {{ $attendance ? \Carbon\Carbon::parse($attendance->time_in)->format('H:i:s') : '--:--:--' }}
                        </span>
                        @if($attendance && $attendance->notes)
                            <div class="text-[10px] font-bold text-red-400 mt-1 uppercase tracking-tighter">{{ $attendance->notes }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($attendance)
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-extrabold rounded-full uppercase tracking-wider
                                {{ $attendance->status == 'hadir' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $attendance->status == 'izin' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $attendance->status == 'sakit' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $attendance->status == 'alfa' ? 'bg-red-100 text-red-800' : '' }}">
                                {{ $attendance->status }}
                            </span>
                        @else
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-extrabold rounded-full bg-gray-100/80 text-gray-400 uppercase tracking-wider italic">
                                Belum Absen
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <form action="{{ route('dosen.attendance.validate', $attendance ?? 0) }}" method="POST" class="inline-flex">
                            @csrf 
                            <select name="status" class="bg-white/80 border border-gray-200 rounded-lg text-[11px] font-extrabold py-1 px-2 focus:ring-2 focus:ring-pink-500 outline-none transition-all shadow-sm" onchange="if(this.value) this.form.submit()" {{ !$attendance ? 'disabled' : '' }}>
                                <option value="">Action...</option>
                                <option value="hadir" {{ $attendance && $attendance->status == 'hadir' ? 'selected' : '' }}>Set HADIR</option>
                                <option value="izin" {{ $attendance && $attendance->status == 'izin' ? 'selected' : '' }}>Set IZIN</option>
                                <option value="sakit" {{ $attendance && $attendance->status == 'sakit' ? 'selected' : '' }}>Set SAKIT</option>
                                <option value="alfa" {{ $attendance && $attendance->status == 'alfa' ? 'selected' : '' }}>Set ALFA</option>
                            </select>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if($students->count() == 0)
        <div class="p-12 text-center text-gray-500 font-bold italic">Tidak ada mahasiswa terdaftar di kelas ini.</div>
    @endif
</div>
@endsection
