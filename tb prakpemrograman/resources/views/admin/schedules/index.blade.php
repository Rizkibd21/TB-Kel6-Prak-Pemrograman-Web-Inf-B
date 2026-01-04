@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Jadwal Perkuliahan</h2>
    <a href="{{ route('admin.schedules.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        + Buat Jadwal
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hari/Waktu</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Kuliah</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dosen</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ruang</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($schedules as $schedule)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <span class="font-bold">{{ $schedule->day }}</span><br>
                    {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                    {{ $schedule->subject->name }}
                    <span class="text-xs text-gray-400 block">{{ $schedule->subject->code }}</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $schedule->classroom->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $schedule->teacher->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $schedule->room ?? '-' }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex gap-2">
                    <a href="{{ route('admin.schedules.edit', $schedule) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                    <form action="{{ route('admin.schedules.destroy', $schedule) }}" method="POST" onsubmit="return confirm('Hapus jadwal ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada data.</td>
            </tr>
            @endforelse
        </tbody>
        </table>
    </div>
</div>
@endsection
