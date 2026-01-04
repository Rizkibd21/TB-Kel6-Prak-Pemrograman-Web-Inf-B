@extends('layouts.student')

@section('content')
<h2 class="text-2xl font-bold mb-6">Course Catalog</h2>

@if(session('error'))
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">{{ session('error') }}</div>
@endif
@if(session('info'))
    <div class="bg-blue-100 text-blue-700 p-3 rounded mb-4">{{ session('info') }}</div>
@endif

<div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
    <table class="min-w-full leading-normal">
        <thead>
            <tr>
                <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Course</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Teacher</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            @php
                $isEnrolled = Auth::user()->courses->contains($course->id);
            @endphp
            <tr>
                <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                    <p class="font-bold text-gray-900 dark:text-gray-200">{{ $course->title }}</p>
                    <p class="text-xs text-gray-500">{{ Str::limit($course->description, 50) }}</p>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                    <p class="text-gray-900 dark:text-gray-200">{{ $course->teacher->name }}</p>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                    @if($isEnrolled)
                        <a href="{{ route('student.courses.show', $course->id) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-1 px-3 rounded text-xs">
                            View
                        </a>
                    @else
                        <form action="{{ route('student.courses.enroll', $course->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-1 px-3 rounded text-xs">
                                Enroll
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4">
        {{ $courses->links() }}
    </div>
</div>
@endsection
