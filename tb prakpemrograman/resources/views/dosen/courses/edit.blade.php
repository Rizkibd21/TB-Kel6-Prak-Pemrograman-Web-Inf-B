@extends('layouts.dosen')

@section('content')
<div class="max-w-md mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6">Edit Course</h2>

    <form action="{{ route('dosen.courses.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label for="title" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Course Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $course->title) }}" class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
            @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label for="description" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Description</label>
            <textarea name="description" id="description" rows="4" class="w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('description', $course->description) }}</textarea>
            @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Update Course
            </button>
            <a href="{{ route('dosen.courses.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-800">Cancel</a>
        </div>
    </form>
</div>
@endsection
