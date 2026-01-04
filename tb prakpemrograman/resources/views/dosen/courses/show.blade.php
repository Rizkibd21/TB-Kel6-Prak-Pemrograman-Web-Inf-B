@extends('layouts.dosen')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <a href="{{ route('dosen.courses.index') }}" class="text-blue-600 hover:text-blue-800">&larr; Back to Courses</a>
    <div class="space-x-2">
        <a href="{{ route('dosen.forum.index', $course->id) }}" class="bg-teal-600 text-white px-4 py-2 rounded hover:bg-teal-700 font-bold">Forum</a>
        <a href="{{ route('dosen.attendance.index', $course->id) }}" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 font-bold">Manage Attendance</a>
    </div>
</div>

<div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mb-6">
    <h2 class="text-3xl font-bold mb-2">{{ $course->title }}</h2>
    <p class="text-gray-600 dark:text-gray-400">{{ $course->description }}</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Materials List -->
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
        <h3 class="text-xl font-bold mb-4 border-b pb-2">Learning Materials</h3>
        
        @if($course->materials->isEmpty())
            <p class="text-gray-500 italic">No materials uploaded yet.</p>
        @else
            <ul class="space-y-4">
                @foreach($course->materials as $material)
                <li class="flex items-center justify-between bg-gray-50 dark:bg-gray-700 p-3 rounded">
                    <div class="flex items-center">
                        <span class="mr-3 text-2xl">
                            @if($material->type == 'pdf') 📄 @elseif($material->type == 'video') 🎬 @else 🔗 @endif
                        </span>
                        <div>
                            <p class="font-bold dark:text-gray-200">{{ $material->title }}</p>
                            <span class="text-xs text-gray-500 dark:text-gray-400 uppercase">{{ $material->type }}</span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        @if($material->type == 'link')
                            <a href="{{ $material->file_path }}" target="_blank" class="text-blue-600 hover:underline text-sm">Open</a>
                        @else
                            <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank" class="text-blue-600 hover:underline text-sm">Download</a>
                        @endif
                        
                        <form action="{{ route('dosen.courses.materials.destroy', [$course->id, $material->id]) }}" method="POST" onsubmit="return confirm('Delete material?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm">✖</button>
                        </form>
                    </div>
                </li>
                @endforeach
            </ul>
        @endif
        @endif
    </div>

    <!-- Assignments List -->
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mt-6">
        <div class="flex justify-between items-center mb-4 border-b pb-2">
            <h3 class="text-xl font-bold">Assignments</h3>
            <a href="{{ route('dosen.assignments.create', $course->id) }}" class="bg-indigo-600 text-white px-3 py-1 rounded hover:bg-indigo-700 text-sm">Add Assignment</a>
        </div>

        @if($course->assignments->isEmpty())
            <p class="text-gray-500 italic">No assignments created yet.</p>
        @else
            <ul class="space-y-4">
                @foreach($course->assignments as $assignment)
                <li class="flex items-center justify-between bg-gray-50 dark:bg-gray-700 p-3 rounded">
                    <div>
                        <p class="font-bold dark:text-gray-200">{{ $assignment->title }}</p>
                        <p class="text-xs text-gray-500">Due: {{ $assignment->due_date->format('d M Y H:i') }}</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-xs bg-gray-200 dark:bg-gray-600 px-2 py-1 rounded">
                            {{ $assignment->submissions->count() }} Submissions
                        </span>
                        <a href="{{ route('dosen.assignments.show', [$course->id, $assignment->id]) }}" class="text-green-600 hover:text-green-800 text-sm font-bold">Grade</a>
                    </div>
                </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
    <!-- Upload Form (Materials) -->
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 h-fit">
        <h3 class="text-xl font-bold mb-4 border-b pb-2">Add Material</h3>
        
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-2 rounded mb-4 text-sm">{{ session('success') }}</div>
        @endif

        <form action="{{ route('dosen.courses.materials.store', $course->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label class="block text-sm font-bold mb-1 dark:text-gray-300">Title</label>
                <input type="text" name="title" class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
            </div>

            <div class="mb-3">
                <label class="block text-sm font-bold mb-1 dark:text-gray-300">Type</label>
                <select name="type" id="type-select" class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white" onchange="toggleInputs()">
                    <option value="pdf">PDF Document</option>
                    <option value="video">Video</option>
                    <option value="link">External Link</option>
                </select>
            </div>

            <div class="mb-3" id="file-input">
                <label class="block text-sm font-bold mb-1 dark:text-gray-300">File (PDF/Video)</label>
                <input type="file" name="file" class="w-full dark:text-gray-300">
            </div>

            <div class="mb-3 hidden" id="link-input">
                <label class="block text-sm font-bold mb-1 dark:text-gray-300">URL</label>
                <input type="url" name="link_url" class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="https://">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 rounded hover:bg-blue-700">Add Material</button>
        </form>

        <script>
            function toggleInputs() {
                const type = document.getElementById('type-select').value;
                if (type === 'link') {
                    document.getElementById('file-input').classList.add('hidden');
                    document.getElementById('link-input').classList.remove('hidden');
                } else {
                    document.getElementById('file-input').classList.remove('hidden');
                    document.getElementById('link-input').classList.add('hidden');
                }
            }
        </script>
    </div>
</div>
@endsection
