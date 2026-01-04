@extends('layouts.student')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <a href="{{ route('student.dashboard') }}" class="text-indigo-600 hover:text-indigo-800">&larr; Back to Dashboard</a>
    <div class="space-x-2">
        <a href="{{ route('student.forum.index', $course->id) }}" class="bg-teal-600 text-white px-4 py-2 rounded hover:bg-teal-700 font-bold">Forum</a>
        <a href="{{ route('student.attendance.index', $course->id) }}" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 font-bold">View Attendance</a>
    </div>
</div>

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
@endif

<div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mb-6">
    <h1 class="text-3xl font-bold mb-2">{{ $course->title }}</h1>
    <p class="text-sm text-gray-500 mb-4">Instructor: {{ $course->teacher->name }}</p>
    <p class="text-gray-700 dark:text-gray-300">{{ $course->description }}</p>
</div>

<div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
    <h3 class="text-xl font-bold mb-4 border-b pb-2">Course Materials</h3>
    
    @if($course->materials->isEmpty())
        <p class="text-gray-500 italic">No materials available yet.</p>
    @else
        <ul class="space-y-4">
            @foreach($course->materials as $material)
            <li class="flex items-center justify-between bg-gray-50 dark:bg-gray-700 p-4 rounded hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                <div class="flex items-center">
                    <span class="mr-4 text-3xl">
                        @if($material->type == 'pdf') 📄 @elseif($material->type == 'video') 🎬 @else 🔗 @endif
                    </span>
                    <div>
                        <p class="font-bold text-lg dark:text-gray-200">{{ $material->title }}</p>
                        <span class="text-xs text-gray-500 uppercase">{{ $material->type }}</span>
                    </div>
                </div>
                <div>
                    @if($material->type == 'link')
                        <a href="{{ $material->file_path }}" target="_blank" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 text-sm">
                            Open Link
                        </a>
                    @else
                        <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 text-sm">
                            Download
                        </a>
                    @endif
                </div>
            </li>
            @endforeach
        </ul>
    @endif
    @endif
</div>

<div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mt-6">
    <h3 class="text-xl font-bold mb-4 border-b pb-2">Assignments</h3>
    
    @if($course->assignments->isEmpty())
        <p class="text-gray-500 italic">No assignments for this course.</p>
    @else
        <ul class="space-y-4">
            @foreach($course->assignments as $assignment)
            @php
                $mySubmission = $assignment->submissions->where('user_id', Auth::id())->first();
            @endphp
            <li class="flex items-center justify-between bg-gray-50 dark:bg-gray-700 p-4 rounded hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                <div>
                    <h4 class="font-bold text-lg dark:text-gray-200">{{ $assignment->title }}</h4>
                    <p class="text-xs text-gray-500">Due: {{ $assignment->due_date->format('d M Y H:i') }}</p>
                </div>
                <div class="flex items-center space-x-3">
                    @if($mySubmission)
                        <span class="px-2 py-1 rounded text-xs {{ $mySubmission->grade ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $mySubmission->grade ? 'Graded: ' . $mySubmission->grade : 'Submitted' }}
                        </span>
                    @else
                        <span class="px-2 py-1 rounded text-xs bg-red-100 text-red-800">Pending</span>
                    @endif
                    <a href="{{ route('student.assignments.show', [$course->id, $assignment->id]) }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 text-sm">
                        {{ $mySubmission ? 'View / Resubmit' : 'Submit' }}
                    </a>
                </div>
            </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
