@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.dashboard') }}" class="text-indigo-600 hover:text-indigo-800">&larr; Back to Dashboard</a>
</div>

<div class="bg-white shadow rounded p-6">
    <h2 class="text-2xl font-bold mb-4">Manajemen Absensi</h2>

    <form method="GET" class="flex space-x-4 mb-4">
        <select name="course_id" class="border p-2">
            <option value="">-- Semua Mata Kuliah --</option>
            @foreach($courses as $c)
                <option value="{{ $c->id }}" {{ request('course_id') == $c->id ? 'selected' : '' }}>{{ $c->title }}</option>
            @endforeach
        </select>

        <input type="date" name="date" value="{{ request('date') }}" class="border p-2">
        <button class="bg-indigo-600 text-white px-4 py-2 rounded">Filter</button>
        <a href="{{ route('admin.attendances.export', request()->all()) }}" class="ml-auto bg-green-600 text-white px-4 py-2 rounded">Export CSV</a>
    </form>

    <div class="container-card">
    <table class="att-table min-w-full">
        <thead>
            <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Course</th>
                <th class="px-4 py-2">User</th>
                <th class="px-4 py-2">Date</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Notes</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $a)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $a->id }}</td>
                <td class="px-4 py-2">{{ $a->course->title ?? '-' }}</td>
                <td class="px-4 py-2">{{ $a->user->name ?? '-' }}<br/><small>{{ $a->user->email ?? '' }}</small></td>
                <td class="px-4 py-2">{{ $a->meeting_date?->format('Y-m-d') }}</td>
                <td class="px-4 py-2">
                    <span class="badge badge-{{ $a->status }}">{{ ucfirst($a->status) }}</span>
                </td>
                <td class="px-4 py-2">{{ $a->notes }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('admin.attendances.edit', $a->id) }}" class="text-indigo-600">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>

    <div class="pagination-wrap">
        {{ $attendances->links() }}
    </div>

</div>

@endsection
