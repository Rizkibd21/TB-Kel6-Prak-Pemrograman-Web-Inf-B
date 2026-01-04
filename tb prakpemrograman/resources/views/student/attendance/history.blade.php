@extends('layouts.student')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Riwayat Absensi</h2>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Kuliah</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jam Masuk</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($attendances as $attendance)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ \Carbon\Carbon::parse($attendance->date)->format('d F Y') }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ $attendance->schedule->subject->name }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ $attendance->time_in }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                   <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                        {{ $attendance->status == 'hadir' ? 'bg-green-100 text-green-800' : '' }}
                        {{ $attendance->status == 'izin' ? 'bg-yellow-100 text-yellow-800' : '' }}
                        {{ $attendance->status == 'sakit' ? 'bg-blue-100 text-blue-800' : '' }}
                        {{ $attendance->status == 'alfa' ? 'bg-red-100 text-red-800' : '' }}">
                        {{ ucfirst($attendance->status) }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada riwayat absensi.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-6 py-4">
        {{ $attendances->links() }}
    </div>
</div>
@endsection
