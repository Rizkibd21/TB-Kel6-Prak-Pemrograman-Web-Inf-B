@extends('layouts.student')

@section('content')
<div class="mb-6">
    <a href="{{ route('student.courses.show', $course->id) }}" class="text-indigo-600 hover:text-indigo-800">&larr; Back to Course</a>
</div>

<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-green-100 p-4 rounded-lg text-center">
        <h3 class="text-2xl font-bold text-green-700">{{ $stats['hadir'] }}</h3>
        <p class="text-green-800 text-sm">Hadir</p>
    </div>
    <div class="bg-blue-100 p-4 rounded-lg text-center">
        <h3 class="text-2xl font-bold text-blue-700">{{ $stats['izin'] }}</h3>
        <p class="text-blue-800 text-sm">Izin</p>
    </div>
    <div class="bg-yellow-100 p-4 rounded-lg text-center">
        <h3 class="text-2xl font-bold text-yellow-700">{{ $stats['sakit'] }}</h3>
        <p class="text-yellow-800 text-sm">Sakit</p>
    </div>
    <div class="bg-red-100 p-4 rounded-lg text-center">
        <h3 class="text-2xl font-bold text-red-700">{{ $stats['alfa'] }}</h3>
        <p class="text-red-800 text-sm">Alfa</p>
    </div>
</div>

<div class="container-card">
    <h3 class="text-xl font-bold mb-4">Riwayat Absensi</h3>
    
    @if($attendances->isEmpty())
        <p class="text-gray-500 italic">No attendance records found.</p>
    @else
    <table class="att-table min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 bg-gray-100 dark:bg-gray-700 text-left">Date</th>
                    <th class="px-5 py-3 bg-gray-100 dark:bg-gray-700 text-left">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendances as $attendance)
                <tr>
                    <td class="px-5 py-5 border-b dark:border-gray-700">
                        {{ $attendance->date->format('l, d M Y') }}
                    </td>
                    <td class="px-5 py-5 border-b dark:border-gray-700">
                        <span class="badge badge-{{ $attendance->status }}">{{ ucfirst($attendance->status) }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
