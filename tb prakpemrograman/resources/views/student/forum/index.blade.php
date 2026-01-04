@extends('layouts.student')

@section('content')
<div class="mb-6">
    <a href="{{ route('student.courses.show', $course->id) }}" class="text-indigo-600 hover:text-indigo-800">&larr; Back to Course</a>
</div>

<div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mb-6">
    <h2 class="text-2xl font-bold mb-4">Course Forum: {{ $course->title }}</h2>

    <!-- Create Topic Form -->
    <form action="{{ route('student.forum.store', $course->id) }}" method="POST" class="mb-6">
        @csrf
        <div class="mb-2">
            <textarea name="content" rows="3" class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Ask a question or start a discussion..."></textarea>
        </div>
        <button type="submit" class="bg-indigo-600 text-white font-bold py-2 px-4 rounded hover:bg-indigo-700">Post Topic</button>
    </form>

    <div class="space-y-4">
        @foreach($posts as $post)
        <div class="border rounded p-4 hover:bg-gray-50 dark:hover:bg-gray-700">
            <div class="flex justify-between items-start mb-2">
                <div>
                    <h4 class="font-bold dark:text-gray-200">{{ $post->user->name }}</h4>
                    <span class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</span>
                </div>
                <span class="text-xs bg-gray-200 px-2 py-1 rounded">{{ $post->replies->count() }} replies</span>
            </div>
            <p class="text-gray-700 dark:text-gray-300 mb-2">{{ Str::limit($post->content, 150) }}</p>
            <a href="{{ route('student.forum.show', [$course->id, $post->id]) }}" class="text-indigo-600 dark:text-indigo-400 text-sm font-bold hover:underline">View Discussion</a>
        </div>
        @endforeach
    </div>
</div>
@endsection
