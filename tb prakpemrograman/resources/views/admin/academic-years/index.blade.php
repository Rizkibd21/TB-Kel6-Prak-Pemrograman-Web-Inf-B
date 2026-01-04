@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Tahun Akademik</h2>
    <a href="{{ route('admin.academic-years.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        + Buat Baru
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Semester</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($years as $year)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $year->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $year->semester }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($year->is_active)
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                    @else
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Tidak Aktif</span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex gap-2">
                    <a href="{{ route('admin.academic-years.edit', $year) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
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
