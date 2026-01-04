@extends('layouts.dosen')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">My Courses</h2>
    <a href="{{ route('dosen.courses.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Create Course</a>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

<div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
    <table class="min-w-full leading-normal">
        <thead>
            <tr>
                <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                    Title
                </th>
                <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                    Description
                </th>
                <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                    Materials
                </th>
                <th class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr>
                <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                    <p class="text-gray-900 dark:text-gray-200 font-bold whitespace-no-wrap">{{ $course->title }}</p>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                    <p class="text-gray-600 dark:text-gray-400 whitespace-no-wrap">{{ Str::limit($course->description, 50) }}</p>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">
                        {{ $course->materials->count() }}
                    </span>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm">
                    <div class="flex space-x-2">
                        <a href="{{ route('dosen.courses.show', $course->id) }}" class="text-green-600 hover:text-green-900">Manage</a>
                        <a href="{{ route('dosen.courses.edit', $course->id) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                        <form action="{{ route('dosen.courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Delete this course?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                        </form>
                    </div>
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
