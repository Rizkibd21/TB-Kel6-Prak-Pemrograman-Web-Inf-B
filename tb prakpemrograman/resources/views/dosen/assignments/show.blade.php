@extends('layouts.dosen')

@section('content')
<div class="mb-6">
    <a href="{{ route('dosen.courses.show', $course->id) }}" class="text-indigo-600 hover:text-indigo-800">&larr; Back to Course</a>
</div>

<div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mb-6">
    <h2 class="text-3xl font-bold mb-2">{{ $assignment->title }}</h2>
    <p class="text-gray-500 mb-2">Due: {{ $assignment->due_date->format('d M Y H:i') }}</p>
    <p class="text-gray-700 dark:text-gray-300">{{ $assignment->description }}</p>
</div>

<div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
    <h3 class="text-xl font-bold mb-4 border-b pb-2">Student Submissions</h3>
    
    @if($assignment->submissions->isEmpty())
        <p class="text-gray-500 italic">No submissions yet.</p>
    @else
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 bg-gray-100 dark:bg-gray-700 text-left">Student</th>
                    <th class="px-5 py-3 bg-gray-100 dark:bg-gray-700 text-left">File</th>
                    <th class="px-5 py-3 bg-gray-100 dark:bg-gray-700 text-left">Submitted At</th>
                    <th class="px-5 py-3 bg-gray-100 dark:bg-gray-700 text-left">Grade</th>
                </tr>
            </thead>
            <tbody>
                @foreach($assignment->submissions as $submission)
                <tr>
                    <td class="px-5 py-5 border-b dark:border-gray-700">
                        <p class="font-bold">{{ $submission->user->name }}</p>
                        <p class="text-xs text-gray-500">{{ $submission->user->email }}</p>
                    </td>
                    <td class="px-5 py-5 border-b dark:border-gray-700">
                        <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank" class="text-blue-600 hover:underline">Download</a>
                    </td>
                    <td class="px-5 py-5 border-b dark:border-gray-700">
                        {{ $submission->created_at->format('d M H:i') }}
                    </td>
                    <td class="px-5 py-5 border-b dark:border-gray-700">
                        <form action="{{ route('dosen.assignments.grade', [$course->id, $assignment->id, $submission->id]) }}" method="POST" class="flex items-center space-x-2">
                            @csrf
                            <input type="number" name="grade" value="{{ $submission->grade }}" class="w-16 border rounded p-1 dark:bg-gray-700 dark:text-white" min="0" max="100">
                            <input type="text" name="feedback" value="{{ $submission->feedback }}" placeholder="Feedback" class="w-32 border rounded p-1 dark:bg-gray-700 dark:text-white text-sm">
                            <button type="submit" class="bg-green-600 text-white px-2 py-1 rounded text-xs hover:bg-green-700">Save</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
