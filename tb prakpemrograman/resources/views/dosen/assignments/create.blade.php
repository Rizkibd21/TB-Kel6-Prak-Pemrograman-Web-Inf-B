@extends('layouts.dosen')

@section('content')
<div class="max-w-md mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6">Create Assignment</h2>
    <p class="text-gray-500 mb-4">For Course: {{ $course->title }}</p>

    <form action="{{ route('dosen.assignments.store', $course->id) }}" method="POST">
        @csrf
        
        <div class="mb-4">
            <label for="title" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Title</label>
            <input type="text" name="title" class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Description</label>
            <textarea name="description" rows="4" class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white"></textarea>
        </div>

        <div class="mb-6">
            <label for="due_date" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Due Date</label>
            <input type="datetime-local" name="due_date" class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
        </div>

        <button type="submit" class="bg-indigo-600 text-white font-bold py-2 px-4 rounded hover:bg-indigo-700">Create Assignment</button>
    </form>
</div>
@endsection
