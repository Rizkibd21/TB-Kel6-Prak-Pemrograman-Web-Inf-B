@extends('layouts.student')

@section('content')
<div class="mb-6">
    <a href="{{ route('student.forum.index', $course->id) }}" class="text-indigo-600 hover:text-indigo-800">&larr; Back to Forum</a>
</div>

<div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mb-6">
    <div class="flex items-center mb-4">
        <div class="bg-indigo-100 rounded-full h-10 w-10 flex items-center justify-center text-indigo-800 font-bold mr-3">
            {{ substr($post->user->name, 0, 1) }}
        </div>
        <div>
            <h3 class="font-bold text-lg dark:text-gray-200">{{ $post->user->name }}</h3>
            <span class="text-xs text-gray-500">{{ $post->created_at->format('d M Y H:i') }}</span>
        </div>
    </div>
    <div class="prose dark:prose-invert max-w-none text-gray-800 dark:text-gray-200">
        <p>{{ $post->content }}</p>
    </div>
</div>

<div class="ml-8 space-y-4">
    @foreach($post->replies as $reply)
    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 border border-gray-200 dark:border-gray-600">
        <div class="flex items-center mb-2">
            <span class="font-bold text-sm mr-2 dark:text-gray-200">{{ $reply->user->name }}</span>
            <span class="text-xs text-gray-500">{{ $reply->created_at->diffForHumans() }}</span>
        </div>
        <p class="text-gray-700 dark:text-gray-300 text-sm">{{ $reply->content }}</p>
    </div>
    @endforeach

    <!-- Reply Form -->
    <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm mt-4">
        <form action="{{ route('student.forum.store', $course->id) }}" method="POST">
            @csrf
            <input type="hidden" name="parent_id" value="{{ $post->id }}">
            <textarea name="content" rows="2" class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Write a reply..."></textarea>
            <div class="mt-2 text-right">
                <button type="submit" class="bg-indigo-600 text-white font-bold py-1 px-3 rounded hover:bg-indigo-700 text-sm">Reply</button>
            </div>
        </form>
    </div>
</div>
@endsection
