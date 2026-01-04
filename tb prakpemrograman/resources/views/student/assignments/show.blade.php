@extends('layouts.student')

@section('content')
<div class="mb-6">
    <a href="{{ route('student.courses.show', $course->id) }}" class="text-indigo-600 hover:text-indigo-800">&larr; Back to Course</a>
</div>

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
@endif

<div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mb-6">
    <h2 class="text-3xl font-bold mb-2">{{ $assignment->title }}</h2>
    <div class="flex justify-between items-center text-sm text-gray-500 mb-4">
        <span>Due: {{ $assignment->due_date->format('l, d M Y H:i') }}</span>
        <span>Points: 100</span>
    </div>
    <div class="prose dark:prose-invert max-w-none">
        <p>{{ $assignment->description }}</p>
    </div>
</div>

<div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
    <h3 class="text-xl font-bold mb-4 border-b pb-2">Your Submission</h3>

    @if($submission)
        <div class="mb-4">
            <div class="flex items-center mb-2">
                <span class="text-green-600 font-bold mr-2">✓ Submitted</span>
                <span class="text-sm text-gray-500">{{ $submission->created_at->format('d M Y H:i') }}</span>
            </div>
            <p>File: <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank" class="text-blue-600 hover:underline">Download your file</a></p>
            
            @if($submission->grade !== null)
                <div class="mt-4 p-4 bg-gray-50 dark:bg-gray-700 rounded">
                    <p class="font-bold text-lg">Grade: {{ $submission->grade }} / 100</p>
                    @if($submission->feedback)
                        <p class="mt-2 text-gray-600 dark:text-gray-300">Feedback: {{ $submission->feedback }}</p>
                    @endif
                </div>
            @else
                <p class="mt-2 text-yellow-600">Not graded yet.</p>
            @endif
        </div>
        
        <hr class="my-4">
        <p class="text-sm text-gray-500">Resubmit work:</p>
    @endif

    <form action="{{ route('student.assignments.store', [$course->id, $assignment->id]) }}" method="POST" enctype="multipart/form-data" class="mt-4">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Upload File (PDF/Docs)</label>
            <input type="file" name="file" class="w-full text-gray-700 dark:text-gray-300" required>
        </div>
        <button type="submit" class="bg-indigo-600 text-white font-bold py-2 px-4 rounded hover:bg-indigo-700">
            {{ $submission ? 'Resubmit Assignment' : 'Submit Assignment' }}
        </button>
    </form>
</div>
@endsection
