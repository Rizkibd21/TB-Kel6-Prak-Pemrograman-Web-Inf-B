@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.attendances.index') }}" class="text-indigo-600 hover:text-indigo-800">&larr; Back to Absences</a>
</div>

<div class="bg-white shadow rounded p-6 max-w-xl">
    <h2 class="text-2xl font-bold mb-4">Edit Absensi #{{ $attendance->id }}</h2>

    <form method="POST" action="{{ route('admin.attendances.update', $attendance->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-bold mb-2">Date</label>
            <input type="date" name="meeting_date" value="{{ old('meeting_date', $attendance->meeting_date?->format('Y-m-d')) }}" class="border p-2 w-full">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-bold mb-2">Status</label>
            <select name="status" class="border p-2 w-full">
                @foreach(\App\Models\Attendance::STATUS_VALUES as $s)
                    <option value="{{ $s }}" {{ old('status', $attendance->status) == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-bold mb-2">Notes</label>
            <textarea name="notes" class="border p-2 w-full">{{ old('notes', $attendance->notes) }}</textarea>
        </div>

        <div>
            <button class="bg-indigo-600 text-white px-4 py-2 rounded">Save</button>
        </div>
    </form>
</div>

@endsection
