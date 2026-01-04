@extends('layouts.admin')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h2 class="text-3xl font-extrabold text-gray-800 dark:text-gray-100">Rekap Absensi Seluruh Mahasiswa</h2>
        <p class="text-gray-600 dark:text-gray-400 mt-2">Pantau dan kelola data kehadiran dari seluruh kelas.</p>
    </div>
    <a href="{{ route('admin.attendances.export') }}" class="px-6 py-3 bg-emerald-600 text-white font-extrabold rounded-xl hover:bg-emerald-700 transition shadow-lg shadow-emerald-100 flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
        Export Rekap
    </a>
</div>

<!-- Filters (Glassmorphism) -->
<div class="glass-card mb-8 p-6 bg-gradient-to-br from-white/80 to-indigo-50/50">
    <form action="{{ route('admin.attendances.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end">
        <div>
            <label class="block text-xs font-extrabold text-gray-500 uppercase tracking-widest mb-2">Filter Tanggal</label>
            <input type="date" name="date" value="{{ request('date') }}" class="w-full bg-white/60 border border-gray-200 rounded-xl px-4 py-3 font-bold text-gray-700 focus:ring-2 focus:ring-indigo-500 transition-all shadow-sm">
        </div>
        <div>
            <label class="block text-xs font-extrabold text-gray-500 uppercase tracking-widest mb-2">Filter Kelas</label>
            <select name="classroom_id" class="w-full bg-white/60 border border-gray-200 rounded-xl px-4 py-3 font-bold text-gray-700 focus:ring-2 focus:ring-indigo-500 transition-all shadow-sm">
                <option value="">Semua Kelas</option>
                @foreach($classrooms as $class)
                    <option value="{{ $class->id }}" {{ request('classroom_id') == $class->id ? 'selected' : '' }}>
                        {{ $class->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="flex-1 px-4 py-3 bg-indigo-600 text-white font-extrabold rounded-xl hover:bg-indigo-700 transition shadow-xl shadow-indigo-100">
                Terapkan Filter
            </button>
            <a href="{{ route('admin.attendances.index') }}" class="px-4 py-3 bg-white/60 text-gray-500 font-extrabold rounded-xl hover:bg-white transition border border-gray-200 shadow-sm">
                 Reset
            </a>
        </div>
    </form>
</div>

<div class="glass overflow-hidden rounded-2xl shadow-2xl border border-white/60">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200/50 table-glass">
            <thead>
                <tr class="bg-gray-50/50">
                    <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-500 uppercase tracking-widest">Waktu & Sesi</th>
                    <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-500 uppercase tracking-widest">Mahasiswa</th>
                    <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-500 uppercase tracking-widest">Kelas / MK</th>
                    <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-500 uppercase tracking-widest">Status</th>
                    <th class="px-6 py-4 text-center text-xs font-extrabold text-gray-500 uppercase tracking-widest">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100/50 bg-white/40">
                @forelse($attendances as $attendance)
                <tr class="hover:bg-white/60 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-extrabold text-gray-900">{{ \Carbon\Carbon::parse($attendance->date)->format('d/m/Y') }}</div>
                        <div class="text-[10px] font-bold text-indigo-600 uppercase tracking-widest">{{ $attendance->time_in ?? '--:--' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-extrabold text-gray-900">{{ $attendance->user->name }}</div>
                        <div class="text-[10px] font-bold text-gray-500 uppercase tracking-tighter">{{ $attendance->user->nim }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-bold text-gray-700">{{ $attendance->schedule->classroom->name }}</div>
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ $attendance->schedule->subject->name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 inline-flex text-[10px] leading-5 font-extrabold rounded-full uppercase tracking-wider 
                            {{ $attendance->status == 'hadir' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $attendance->status == 'izin' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $attendance->status == 'sakit' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $attendance->status == 'alfa' ? 'bg-red-100 text-red-800' : '' }}">
                            {{ $attendance->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <a href="{{ route('admin.attendances.edit', $attendance) }}" class="p-2 bg-indigo-100 text-indigo-700 rounded-lg hover:bg-indigo-200 transition shadow-sm inline-block">
                             <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2-2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500 font-bold italic">Tidak ada data absensi yang ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 bg-gray-50/30">
        {{ $attendances->links() }}
    </div>
</div>
@endsection
