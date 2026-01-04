@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Data Kelas</h2>
    <a href="{{ route('admin.classrooms.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        + Buat Kelas
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kelas</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun Akademik</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Wali Dosen</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($classrooms as $class)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $class->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $class->academicYear->name }} ({{ $class->academicYear->semester }})</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $class->advisor->name ?? '-' }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex gap-2">
                    <a href="{{ route('admin.classrooms.edit', $class) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                    <form action="{{ route('admin.classrooms.destroy', $class) }}" method="POST" onsubmit="return confirm('Hapus kelas ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada data.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
